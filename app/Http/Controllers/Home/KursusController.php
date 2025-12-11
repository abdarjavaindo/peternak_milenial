<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Kategori_kursus;
use App\Models\Kursus;
use App\Models\KursusBagian;
use App\Models\KursusMateri;
use App\Models\KursusProgres;
use App\Models\UserKursusProgres;
use App\Models\UserTernak;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KursusController extends Controller
{
    public function index()
    {
        $data['kategori'] = Kategori_kursus::get();
        $data['pelatihan'] = Kursus::when(auth()->check(), function ($q) {
            $q->with('user_status'); // load progress user login
        })->where('is_published', 1)->get();
        if ($data['pelatihan']->count() < 1) {
            return view('pages.home.kursus.kursus-kosong', $data);
        }
        return view('pages.home.kursus.index', $data);
    }

    public function detail($slug)
    {
        $pelatihan = Kursus::with([
            'pengajar',
            'bagian',
            'bagian.materi'
        ])
        ->where(['is_published' => 1, 'slug' => $slug])
        ->firstOrFail();

        $user_progress = null;
        $materi_progress = [];
        $next_materi = null;
        $jumlahpeserta = UserKursusProgres::where('kursus_id', $pelatihan->id)->count();

        if (auth()->check()) {

            // Ambil progres utama
            $user_progress = UserKursusProgres::where([
                'user_id'   => auth()->id(),
                'kursus_id' => $pelatihan->id,
            ])->first();

            // Ambil progres per materi
            $materi_progress = KursusProgres::where('user_id', auth()->id())
            ->where('kursus_id', $pelatihan->id)
            ->get()
            ->keyBy('materi_id');

            // CARI MATERI YANG BELUM SELESAI ATAU SEDANG PROGRES
            foreach ($pelatihan->bagian->sortBy('urutan') as $bagian) {
                foreach ($bagian->materi as $materi) {
                    $progress = $materi_progress[$materi->id] ?? null;
                    // Jika belum ada progres → itu materi berikutnya
                    if (!$progress) {
                        $next_materi = $materi;
                        break 2;
                    }
                    // Jika progres masih berjalan
                    if ($progress->status == 'progres') {
                        $next_materi = $materi;
                        break 2;
                    }
                }
            }
        }

        return view('pages.home.kursus.detail', compact(
            'pelatihan',
            'user_progress',
            'materi_progress',
            'next_materi',
            'jumlahpeserta'
        ));
    }

    public function daftar($slug)
    {
        if (!auth()->user()) {
            return redirect()->route('login');
        }

        if (UserTernak::where('user_id', auth()->user()->id)->count() < 1) {
            return redirect()->route('ternak');
        }

        $kursus = Kursus::with(['pengajar', 'bagian'])
            ->where(['is_published' => 1, 'slug' => $slug])
            ->firstOrFail();

        $userLevel  = auth()->user()->level;
        $courseLevel = $kursus->level;
        // Urutkan level sesuai hierarchy
        $hierarchy = [
            'pemula'   => 1,
            'menengah' => 2,
            'ahli'     => 3,
        ];
        // Jika level user < level kursus → tidak boleh akses
        if ($hierarchy[$userLevel] < $hierarchy[$courseLevel]) {
            return redirect()->back()->with('gagal', 'Level anda belum cukup untuk mengakses kursus ini');
        }

        $ceksudahdaftar = UserKursusProgres::where(['user_id' => auth()->user()->id, 'kursus_id' => $kursus->id])->first();
        if ($ceksudahdaftar) {
            return redirect()->back()->with('gagal', 'Anda sudah terdaftar pada kursus ini, tidak perlu mendaftar lagi');
        }

        $user_kursus_progres = UserKursusProgres::create([
            'user_id' => auth()->user()->id,
            'kursus_id' => $kursus->id,
            'harus_selesai_tgl' => Carbon::now()->addDays($kursus->hari),
        ]);

        $materiPertamaId = $kursus
            ->bagian()
            ->orderBy('id', 'asc')
            ->first()
            ?->materi()
            ->orderBy('id', 'asc')
            ->value('id');

        KursusProgres::create([
            'user_id' => auth()->user()->id,
            'kursus_id' => $kursus->id,
            'materi_id' => $materiPertamaId,
            'user_kursus_progres_id' => $user_kursus_progres->id,
        ]);
        return redirect()->route('pelatihan.materi', $materiPertamaId);
    }

    public function materi(KursusMateri $kursus_materi)
    {
        $user = auth()->user();
        $kursus = $kursus_materi->bagian->kursus;

        // 1. CEK USER SUDAH LOGIN
        if (!$user) {
            return redirect()->route('login');
        }

        // 2. CEK APAKAH USER SUDAH MENDAFTAR KURSUS INI
        $pendaftaran = UserKursusProgres::where([
            'user_id'   => $user->id,
            'kursus_id' => $kursus->id
        ])->first();
        if (!$pendaftaran) {
            return redirect()->route('pelatihan.detail', $kursus->slug);
        }

        // 3. CEK STATUS "do" (misal: sedang ongoing atau belum diperbolehkan)
        if ($pendaftaran->status === 'do') {
            return redirect()->route('pelatihan.detail', $kursus->slug);
        }

        // -----------------------------------------
        // 4. CEK MATERI SUDAH TERBUKA ATAU BELUM
        //    Ambil progres dari tabel kursus_progres
        // -----------------------------------------
        $materiProgress = KursusProgres::where([
            'user_id' => $user->id,
            'kursus_id' => $kursus->id,
            'materi_id' => $kursus_materi->id
        ])->first();
        if (!$materiProgress) {
            return redirect()->route('pelatihan.detail', $kursus->slug)->with(
                'gagal',
                'Materi ini belum terbuka. Selesaikan materi sebelumnya terlebih dahulu.'
            );
        }

        // -----------------------------------------
        // 5. AMBIL MATERI SEBELUM & SESUDAH dari tabel kursus_materis
        // -----------------------------------------
        // materi dalam bagian yang sama
        $materiSebelumnya = KursusMateri::where('kursus_bagian_id', $kursus_materi->kursus_bagian_id)
            ->where('id', '<', $kursus_materi->id)
            ->orderBy('id', 'desc')
            ->first();
        // jika tidak ada, cari bagian sebelumnya
        if (!$materiSebelumnya) {
            // cari bagian sebelumnya
            $bagianSebelumnya = KursusBagian::where('kursus_id', $kursus->id)
                ->where('id', '<', $kursus_materi->bagian->id)
                ->orderBy('id', 'desc')
                ->first();
            if ($bagianSebelumnya) {
                // ambil materi terakhir dari bagian sebelumnya
                $materiSebelumnya = KursusMateri::where('kursus_bagian_id', $bagianSebelumnya->id)
                    ->orderBy('id', 'desc')
                    ->first();
            }
        }

        $materiSelanjutnya = KursusMateri::where('kursus_bagian_id', $kursus_materi->kursus_bagian_id)
            ->where('id', '>', $kursus_materi->id)
            ->orderBy('id', 'asc')
            ->first();
        // jika tidak ada materi berikutnya di bagian ini
        if (!$materiSelanjutnya) {
            // cari bagian sesudahnya
            $bagianSelanjutnya = KursusBagian::where('kursus_id', $kursus->id)
                ->where('id', '>', $kursus_materi->bagian->id)
                ->orderBy('id', 'asc')
                ->first();
            if ($bagianSelanjutnya) {
                // ambil materi pertama dari bagian berikutnya
                $materiSelanjutnya = KursusMateri::where('kursus_bagian_id', $bagianSelanjutnya->id)
                    ->orderBy('id', 'asc')
                    ->first();
            }
        }

        return view('pages.home.kursus.materi', [
            'kursus_materi'   => $kursus_materi,
            'materiSebelumnya' => $materiSebelumnya,
            'materiSelanjutnya' => $materiSelanjutnya,
            'materiProgress' => $materiProgress, // jika view butuh
        ]);
    }

    public function next(KursusMateri $kursus_materi)
    {
        $user = auth()->user();
        $kursus = $kursus_materi->bagian->kursus;

        // 1. CEK USER SUDAH LOGIN
        if (!$user) {
            return redirect()->route('login');
        }

        // 2. CEK APAKAH USER SUDAH MENDAFTAR KURSUS INI
        $pendaftaran = UserKursusProgres::where([
            'user_id'   => $user->id,
            'kursus_id' => $kursus->id
        ])->first();
        if (!$pendaftaran) {
            return redirect()->route('pelatihan.detail', $kursus->slug);
        }

        // 3. CEK STATUS "do" (misal: sedang ongoing atau belum diperbolehkan)
        if ($pendaftaran->status === 'do') {
            return redirect()->route('pelatihan.detail', $kursus->slug);
        }

        // -----------------------------------------
        // 4. AMBIL MATERI SEBELUM
        // -----------------------------------------
        // materi dalam bagian yang sama
        $materiSebelumnya = KursusMateri::where('kursus_bagian_id', $kursus_materi->kursus_bagian_id)
            ->where('id', '<', $kursus_materi->id)
            ->orderBy('id', 'desc')
            ->first();
        // jika tidak ada, cari bagian sebelumnya
        if (!$materiSebelumnya) {
            // cari bagian sebelumnya
            $bagianSebelumnya = KursusBagian::where('kursus_id', $kursus->id)
                ->where('id', '<', $kursus_materi->bagian->id)
                ->orderBy('id', 'desc')
                ->first();
            if ($bagianSebelumnya) {
                // ambil materi terakhir dari bagian sebelumnya
                $materiSebelumnya = KursusMateri::where('kursus_bagian_id', $bagianSebelumnya->id)
                    ->orderBy('id', 'desc')
                    ->first();
            }
        }

        if ($materiSebelumnya) {
            $cekmaterisebelumnya = KursusProgres::where([
                'user_id' => auth()->user()->id,
                'kursus_id' => $kursus->id,
                'materi_id' => $materiSebelumnya->id,
            ])->first();
            if (isset($cekmaterisebelumnya) && $cekmaterisebelumnya->status == 'progres') {
                $cekmaterisebelumnya->status = 'selesai';
                $cekmaterisebelumnya->save();

                KursusProgres::create([
                    'user_id' => auth()->user()->id,
                    'kursus_id' => $kursus->id,
                    'materi_id' => $kursus_materi->id,
                    'user_kursus_progres_id' => $pendaftaran->id,
                ]);

                return redirect()->route('pelatihan.materi', $kursus_materi->id);
            } elseif (isset($cekmaterisebelumnya) && $cekmaterisebelumnya->status == 'selesai') {
                return redirect()->route('pelatihan.materi', $kursus_materi->id);
            } else {
                return redirect()->route('pelatihan.detail', $kursus->slug)->with(
                    'gagal',
                    'Materi ini belum terbuka. Selesaikan materi sebelumnya terlebih dahulu.'
                );
            }
        }else {
            return redirect()->route('pelatihan.detail', $kursus->slug);
        }
    }

    public function selesai($slug, KursusMateri $kursus_materi)
    {
        if (!auth()->user()) {
            return redirect()->route('login');
        }
        $kursus = Kursus::where(['is_published' => 1, 'slug' => $slug])
            ->firstOrFail();

        // 2. CEK APAKAH USER SUDAH MENDAFTAR KURSUS INI
        $pendaftaran = UserKursusProgres::where([
            'user_id'   => auth()->user()->id,
            'kursus_id' => $kursus->id
        ])->first();
        if (!$pendaftaran) {
            return redirect()->route('pelatihan.detail', $kursus->slug);
        }

        // 3. CEK STATUS "do" (misal: sedang ongoing atau belum diperbolehkan)
        if ($pendaftaran->status === 'do') {
            return redirect()->route('pelatihan.detail', $kursus->slug);
        }

        $jumlahMateri = KursusMateri::whereIn('kursus_bagian_id', function ($q) use ($kursus) {
            $q->select('id')
                ->from('kursus_bagians')
                ->where('kursus_id', $kursus->id);
        })->count();

        $jumlahProgressUser = KursusProgres::where([
            'user_id' => auth()->user()->id,
            'kursus_id' => $kursus->id,
            'status' => 'selesai',
        ])->count() + 1;

        if ($jumlahMateri == $jumlahProgressUser) {
            KursusProgres::where([
                'user_id' => auth()->user()->id,
                'kursus_id' => $kursus->id,
                'materi_id' => $kursus_materi->id,
            ])->update(['status' => 'selesai']);

            UserKursusProgres::where([
                'user_id' => auth()->user()->id,
                'kursus_id' => $kursus->id,
            ])->update(['status' => 'selesai']);

            return redirect()->route('pelatihan.detail', $kursus->slug)->with(
                'sukses',
                'Selamat anda berhasil menyelesaikan kursus ini'
            );
        }else {
            return redirect()->route('pelatihan.detail', $kursus->slug)->with(
                'gagal',
                'Terdapat kesalahan'
            );
        }
    }
}
