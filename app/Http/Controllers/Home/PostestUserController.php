<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\KursusBagian;
use App\Models\KursusMateri;
use App\Models\KursusProgres;
use App\Models\UserKursusProgres;
use App\Models\Postest_pertanyaan;
use App\Models\Postest_pilihan_jawaban;
use App\Models\User_postest;
use App\Models\User_postest_jawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostestUserController extends Controller
{
    /**
     * Start postest - create attempt with shuffled question order
     */
    public function mulai(KursusMateri $materi)
    {
        $user = auth()->user();

        // Validation: must be postest type
        if (!$materi->isPostest()) {
            return redirect()->back()->with('gagal', 'Ini bukan postest');
        }

        // Check existing attempt (get latest one)
        $existing = User_postest::where('user_id', $user->id)
            ->where('postest_id', $materi->id)
            ->orderBy('id', 'desc')
            ->first();

        if ($existing && $existing->selesai_pada) {
            // If user passed, show result (no retry allowed)
            if ($existing->status === 'lulus') {
                return redirect()->route('postest.hasil', $existing);
            }
            // If user failed, allow retry by deleting old attempt
            $existing->jawabans()->delete();
            $existing->delete();
            $existing = null; // Clear reference so subsequent checks create new attempt
        }

        if ($existing && !$existing->isExpired()) {
            return redirect()->route('postest.soal', [$existing, 1]);
        }

        // If expired without submit, auto-submit it
        if ($existing && $existing->isExpired()) {
            $this->submitAttemptInternal($existing);
            return redirect()->route('postest.hasil', $existing);
        }

        // Get all question IDs and shuffle
        $pertanyaanIds = $materi->pertanyaans()->pluck('id')->shuffle()->toArray();

        // Get user's course enrollment for FK relationship
        $kursusId = $materi->bagian->kursus_id;
        $userKursusProgres = UserKursusProgres::where('user_id', $user->id)
            ->where('kursus_id', $kursusId)
            ->first();

        // Calculate effective duration based on remaining training time
        // Training deadline is the SINGLE SOURCE OF TRUTH - postest duration must adjust
        $effectiveDuration = null;

        if ($userKursusProgres && $userKursusProgres->harus_selesai_tgl) {
            $trainingDeadline = \Carbon\Carbon::parse($userKursusProgres->harus_selesai_tgl);

            // CHECK 1: Training sudah expired?
            if (now()->greaterThanOrEqualTo($trainingDeadline)) {
                return redirect()->back()->with('gagal', 'Waktu pelatihan sudah habis. Postest tidak dapat dimulai.');
            }

            // CHECK 2: Hitung sisa waktu training dalam menit
            $remainingTrainingMinutes = (int) now()->diffInMinutes($trainingDeadline, false);
            $postestDuration = (int) $materi->durasi_postest;

            // RULE: Postest duration TIDAK BOLEH melebihi sisa waktu training
            if ($postestDuration > 0) {
                if ($remainingTrainingMinutes < $postestDuration) {
                    // Truncate duration to remaining training time (minimum 1 minute)
                    $effectiveDuration = max(1, $remainingTrainingMinutes);
                } else {
                    $effectiveDuration = $postestDuration;
                }
            }
        } else {
            // No training deadline set - use default postest duration
            $effectiveDuration = (int) $materi->durasi_postest ?: null;
        }

        // Create new attempt with effective duration
        $attempt = User_postest::create([
            'user_id' => $user->id,
            'postest_id' => $materi->id,
            'user_kursus_progres_id' => $userKursusProgres?->id,
            'mulai_pada' => now(),
            'urutan_soal' => json_encode($pertanyaanIds),
            'effective_duration' => $effectiveDuration,
        ]);

        return redirect()->route('postest.soal', [$attempt, 1]);
    }

    /**
     * Display question by number
     */
    public function soal(User_postest $attempt, int $nomor = 1)
    {
        // Auth check
        if ($attempt->user_id !== auth()->id()) {
            abort(403);
        }

        // Time check - auto submit if expired
        if ($attempt->isExpired() && !$attempt->selesai_pada) {
            $this->submitAttemptInternal($attempt);
            return redirect()->route('postest.hasil', $attempt)
                ->with('info', 'Waktu habis, ujian otomatis dikumpulkan');
        }

        // Already submitted
        if ($attempt->selesai_pada) {
            return redirect()->route('postest.hasil', $attempt);
        }

        // Get questions in shuffled order
        $questions = $this->getShuffledQuestions($attempt);
        $totalSoal = count($questions);

        if ($totalSoal === 0) {
            return redirect()->back()->with('gagal', 'Tidak ada soal dalam postest ini');
        }

        // Bounds check
        $nomor = max(1, min($nomor, $totalSoal));
        $currentQuestion = $questions[$nomor - 1] ?? null;

        if (!$currentQuestion) {
            return redirect()->back()->with('gagal', 'Soal tidak ditemukan');
        }

        // Get answered question IDs
        $answeredIds = $attempt->jawabans()->pluck('pertanyaan_id')->toArray();

        // Get current answer for this question
        $currentAnswer = $attempt->jawabans()
            ->where('pertanyaan_id', $currentQuestion->id)
            ->first();

        // Shuffle options for display (seeded for consistency within session)
        $shuffledOptions = $currentQuestion->pilihans
            ->shuffle(crc32($attempt->id . $currentQuestion->id));

        return view('pages.home.kursus.postest', [
            'attempt' => $attempt,
            'materi' => $attempt->materi,
            'questions' => $questions,
            'currentQuestion' => $currentQuestion,
            'shuffledOptions' => $shuffledOptions,
            'nomor' => $nomor,
            'totalSoal' => $totalSoal,
            'answeredIds' => $answeredIds,
            'currentAnswer' => $currentAnswer,
            'remainingSeconds' => $attempt->getRemainingSeconds(),
        ]);
    }

    /**
     * Save answer via AJAX
     */
    public function simpanJawaban(Request $request, User_postest $attempt)
    {
        if ($attempt->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($attempt->isExpired() || $attempt->selesai_pada) {
            return response()->json(['error' => 'Waktu habis atau sudah selesai'], 400);
        }

        $request->validate([
            'pertanyaan_id' => 'required|integer',
            'jawaban_id' => 'required|integer',
        ]);

        // Validate ownership - question belongs to this postest
        $pertanyaan = Postest_pertanyaan::find($request->pertanyaan_id);
        if (!$pertanyaan || $pertanyaan->kursus_materi_id !== $attempt->postest_id) {
            return response()->json(['error' => 'Pertanyaan tidak valid'], 400);
        }

        // Validate jawaban belongs to pertanyaan
        $jawaban = Postest_pilihan_jawaban::find($request->jawaban_id);
        if (!$jawaban || $jawaban->postest_pertanyaan_id !== $request->pertanyaan_id) {
            return response()->json(['error' => 'Jawaban tidak valid'], 400);
        }

        // Upsert answer
        // DB::transaction(
        //     function () use ($attempt, $request, $jawaban) {
        //         User_postest_jawaban::updateOrCreate(
        //             [
        //                 'user_postest_id' => $attempt->id,
        //                 'pertanyaan_id' => $request->pertanyaan_id,
        //             ],
        //             [
        //                 'jawaban_id' => $request->jawaban_id,
        //                 'is_correct' => $jawaban->is_correct,
        //             ]
        //         );
        //     }
        // );
        DB::transaction(function () use ($attempt, $request, $jawaban) {
            // 1. Hapus jawaban lama (jika ada)
            User_postest_jawaban::where('user_postest_id', $attempt->id)
                ->where('pertanyaan_id', $request->pertanyaan_id)
                ->delete();
            // 2. Simpan jawaban baru
            User_postest_jawaban::create([
                'user_postest_id' => $attempt->id,
                'pertanyaan_id'   => $request->pertanyaan_id,
                'jawaban_id'      => $request->jawaban_id,
                'is_correct'      => $jawaban->is_correct,
            ]);
        });


        return response()->json(['success' => true]);
    }

    /**
     * Submit postest
     */
    public function submit(Request $request, User_postest $attempt)
    {
        if ($attempt->user_id !== auth()->id()) {
            abort(403);
        }

        if ($attempt->selesai_pada) {
            return redirect()->route('postest.hasil', $attempt);
        }

        $this->submitAttemptInternal($attempt);

        return redirect()->route('postest.hasil', $attempt)
            ->with('sukses', 'Ujian berhasil dikumpulkan');
    }

    /**
     * Show result
     */
    public function hasil(User_postest $attempt)
    {
        if ($attempt->user_id !== auth()->id()) {
            abort(403);
        }

        if (!$attempt->selesai_pada) {
            return redirect()->route('postest.soal', [$attempt, 1]);
        }

        $totalSoal = $attempt->materi->pertanyaans()->count();
        $benar = $attempt->jawabans()->where('is_correct', '1')->count();
        $kkm = (int) ($attempt->materi->nilai_lulus_postest ?? 70);

        // Find next material for navigation (only if passed)
        $nextMateri = null;
        if ($attempt->status === 'lulus') {
            $materi = $attempt->materi;
            $kursus = $materi->bagian->kursus;
            $nextMateri = $this->findNextMateri($materi, $kursus);
        }

        return view('pages.home.kursus.postest_hasil', [
            'attempt' => $attempt,
            'materi' => $attempt->materi,
            'totalSoal' => $totalSoal,
            'benar' => $benar,
            'kkm' => $kkm,
            'nextMateri' => $nextMateri,
        ]);
    }

    /**
     * Get questions in shuffled order from stored order
     */
    protected function getShuffledQuestions(User_postest $attempt): array
    {
        $order = json_decode($attempt->urutan_soal, true) ?? [];

        if (empty($order)) {
            return $attempt->materi->pertanyaans->all();
        }

        // Fetch in stored order
        $questions = Postest_pertanyaan::whereIn('id', $order)->get()->keyBy('id');

        return collect($order)
            ->map(fn($id) => $questions[$id] ?? null)
            ->filter()
            ->values()
            ->all();
    }

    /**
     * Internal method to submit and calculate score
     */
    protected function submitAttemptInternal(User_postest $attempt): void
    {
        DB::transaction(function () use ($attempt) {
            $totalQuestions = $attempt->materi->pertanyaans()->count();
            $correctAnswers = $attempt->jawabans()->where('is_correct', '1')->count();

            $nilai = $totalQuestions > 0
                ? round(($correctAnswers / $totalQuestions) * 100)
                : 0;

            $kkm = (int) ($attempt->materi->nilai_lulus_postest ?? 70);
            $status = $nilai >= $kkm ? 'lulus' : 'tidak_lulus';

            $attempt->update([
                'nilai' => $nilai,
                'status' => $status,
                'selesai_pada' => now(),
            ]);

            // Update KursusProgres and handle next material if lulus
            if ($status === 'lulus') {
                $materi = $attempt->materi;
                $kursus = $materi->bagian->kursus;
                $userId = $attempt->user_id;

                // Mark current postest material as 'selesai'
                KursusProgres::where('user_id', $userId)
                    ->where('materi_id', $attempt->postest_id)
                    ->update(['status' => 'selesai']);

                // Get user's course enrollment
                $pendaftaran = UserKursusProgres::where([
                    'user_id' => $userId,
                    'kursus_id' => $kursus->id,
                ])->first();

                if ($pendaftaran) {
                    // Find the next material
                    $materiSelanjutnya = $this->findNextMateri($materi, $kursus);

                    if ($materiSelanjutnya) {
                        // Check if progress for next material already exists
                        $existingProgress = KursusProgres::where([
                            'user_id' => $userId,
                            'kursus_id' => $kursus->id,
                            'materi_id' => $materiSelanjutnya->id,
                        ])->first();

                        if (!$existingProgress) {
                            // Create progress for the next material
                            KursusProgres::create([
                                'user_id' => $userId,
                                'kursus_id' => $kursus->id,
                                'materi_id' => $materiSelanjutnya->id,
                                'user_kursus_progres_id' => $pendaftaran->id,
                            ]);
                        }
                    } else {
                        // This was the last material - mark course as complete
                        $jumlahMateri = KursusMateri::whereIn('kursus_bagian_id', function ($q) use ($kursus) {
                            $q->select('id')
                                ->from('kursus_bagians')
                                ->where('kursus_id', $kursus->id);
                        })->count();

                        $jumlahProgressSelesai = KursusProgres::where([
                            'user_id' => $userId,
                            'kursus_id' => $kursus->id,
                            'status' => 'selesai',
                        ])->count();

                        if ($jumlahMateri == $jumlahProgressSelesai) {
                            $pendaftaran->update(['status' => 'selesai']);
                        }
                    }
                }
            }
        });
    }

    /**
     * Find the next material in the course
     */
    protected function findNextMateri(KursusMateri $currentMateri, $kursus): ?KursusMateri
    {
        // Try to find next material in the same bagian
        $materiSelanjutnya = KursusMateri::where('kursus_bagian_id', $currentMateri->kursus_bagian_id)
            ->where('id', '>', $currentMateri->id)
            ->orderBy('id', 'asc')
            ->first();

        if (!$materiSelanjutnya) {
            // Find next bagian
            $bagianSelanjutnya = KursusBagian::where('kursus_id', $kursus->id)
                ->where('id', '>', $currentMateri->bagian->id)
                ->orderBy('id', 'asc')
                ->first();

            if ($bagianSelanjutnya) {
                // Get first material from next bagian
                $materiSelanjutnya = KursusMateri::where('kursus_bagian_id', $bagianSelanjutnya->id)
                    ->orderBy('id', 'asc')
                    ->first();
            }
        }

        return $materiSelanjutnya;
    }
}
