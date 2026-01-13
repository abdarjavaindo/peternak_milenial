<x-layouts.home>
    <!-- Start -->
    <section class="section mt-60">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Progress Indicator -->
                    @php
                        $totalMateri = $pelatihan->bagian->sum(fn($b) => $b->materi->count());
                        $completedMateri = collect($materi_progress)->where('status', 'selesai')->count();
                        $progressPercent = $totalMateri > 0 ? round(($completedMateri / $totalMateri) * 100) : 0;
                    @endphp
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-body py-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="text-muted small">
                                    <i class="uil uil-book-reader me-1"></i>
                                    Progress: <strong>{{ $completedMateri }}/{{ $totalMateri }}</strong> materi selesai
                                </span>
                                <span class="badge {{ $progressPercent == 100 ? 'bg-success' : 'bg-primary' }}">
                                    {{ $progressPercent }}%
                                </span>
                            </div>
                            <div class="progress mt-2" style="height: 6px;">
                                <div class="progress-bar {{ $progressPercent == 100 ? 'bg-success' : 'bg-primary' }}"
                                    role="progressbar" style="width: {{ $progressPercent }}%"
                                    aria-valuenow="{{ $progressPercent }}" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between mb-1">
                        <div>
                            @if (isset($materiSebelumnya))
                                <a href="{{ route('pelatihan.materi', $materiSebelumnya->id) }}"
                                    class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-skip-backward-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M.5 3.5A.5.5 0 0 0 0 4v8a.5.5 0 0 0 1 0V8.753l6.267 3.636c.54.313 1.233-.066 1.233-.697v-2.94l6.267 3.636c.54.314 1.233-.065 1.233-.696V4.308c0-.63-.693-1.01-1.233-.696L8.5 7.248v-2.94c0-.63-.692-1.01-1.233-.696L1 7.248V4a.5.5 0 0 0-.5-.5" />
                                    </svg>
                                    Prev
                                </a>
                            @endif
                            <a href="{{ route('pelatihan.detail', $kursus_materi->bagian->kursus->slug) }}"
                                class="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                                    <path
                                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                                </svg>
                                Home
                            </a>
                        </div>

                        @if (isset($materiSelanjutnya))
                            @if ($materiProgress->materi->jenis != 'postest')
                                <a id="btnNext1" href="{{ route('pelatihan.next', $materiSelanjutnya->id) }}"
                                    class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-skip-forward-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M15.5 3.5a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V8.753l-6.267 3.636c-.54.313-1.233-.066-1.233-.697v-2.94L1.733 12.39C1.193 12.703.5 12.324.5 11.693V4.308c0-.63.693-1.01 1.233-.696L8 7.248v-2.94c0-.63.692-1.01 1.233-.696L15 7.248V4a.5.5 0 0 1 .5-.5" />
                                    </svg>
                                    Next
                                </a>
                            @else
                                @if ($pendaftaran->user_postest?->status == 'lulus')
                                    <a id="btnNext1" href="{{ route('pelatihan.next', $materiSelanjutnya->id) }}"
                                        class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-skip-forward-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M15.5 3.5a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V8.753l-6.267 3.636c-.54.313-1.233-.066-1.233-.697v-2.94L1.733 12.39C1.193 12.703.5 12.324.5 11.693V4.308c0-.63.693-1.01 1.233-.696L8 7.248v-2.94c0-.63.692-1.01 1.233-.696L15 7.248V4a.5.5 0 0 1 .5-.5" />
                                        </svg>
                                        Next
                                    </a>
                                @endif
                            @endif
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-lg-3 mt-4 mt-lg-0 pt-2 pt-lg-0">
                            <div class="card border-0 sidebar sticky-bar rounded shadow bg-light p-2">
                                <div class="row">
                                    @foreach ($pelatihan->bagian->sortBy('urutan') as $bagi)
                                        <div class="col-md-12 mt-4 pt-2">
                                            <h5 class="mb-0">{{ $bagi->judul }}</h5>
                                            <div class="table-responsive bg-white shadow rounded mt-4">
                                                <table class="table mb-0 table-center">
                                                    <tbody>
                                                        @foreach ($bagi->materi as $mat)
                                                            <tr>
                                                                <th class="p-3">
                                                                    <div class="align-items-center">
                                                                        <i class="uil uil-notes h6"></i>
                                                                        <p class="mb-0 d-inline fw-normal h6 ms-1">
                                                                            <a href="{{ route('pelatihan.materi', $mat->id) }}"
                                                                                class="text-muted">
                                                                                {{ $mat->judul }}
                                                                            </a>
                                                                        </p>
                                                                    </div>
                                                                </th>
                                                                <td class="p-3 text-end">
                                                                    @php
                                                                        $progress = $materi_progress[$mat->id] ?? null;
                                                                    @endphp
                                                                    @if ($progress)
                                                                        @if ($progress->status == 'progres')
                                                                            <span class="badge bg-soft-warning">
                                                                                Lanjutkan
                                                                            </span>
                                                                        @elseif ($progress->status == 'selesai')
                                                                            <span class="badge bg-soft-primary">
                                                                                Selesai
                                                                            </span>
                                                                        @endif
                                                                    @else
                                                                        <i class="uil uil-lock"></i>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 mt-4 mt-lg-0 pt-2 pt-lg-0">
                            <div class="card rounded shadow p-4 border-0">
                                <h4 class="title mb-4">{{ $kursus_materi->judul }}</h4>
                                @if ($kursus_materi->jenis === 'postest')
                                    @php
                                        // Get the latest attempt (completed or in-progress)
                                        $latestAttempt = \App\Models\User_postest::where('user_id', auth()->id())
                                            ->where('postest_id', $kursus_materi->id)
                                            ->orderBy('id', 'desc')
                                            ->first();

                                        // Only consider completed attempts for displaying results
                                        $existingAttempt =
                                            $latestAttempt && $latestAttempt->selesai_pada ? $latestAttempt : null;

                                        // Check if user has an in-progress attempt
                                        $inProgressAttempt =
                                            $latestAttempt && !$latestAttempt->selesai_pada ? $latestAttempt : null;
                                    @endphp
                                    <div class="text-center py-5">
                                        <div class="mb-4">
                                            <i class="uil uil-file-question-alt text-primary"
                                                style="font-size: 80px;"></i>
                                        </div>
                                        <h5 class="mb-3">Post-Test</h5>
                                        <p class="text-muted mb-4">
                                            Selesaikan post-test untuk melanjutkan ke materi berikutnya.<br>
                                            @if ($kursus_materi->durasi_postest)
                                                <strong>Durasi:</strong> {{ $kursus_materi->durasi_postest }} menit |
                                            @endif
                                            @if ($kursus_materi->nilai_lulus_postest)
                                                <strong>Nilai Minimal:</strong>
                                                {{ $kursus_materi->nilai_lulus_postest }}
                                            @endif
                                        </p>

                                        @if ($existingAttempt && $existingAttempt->status === 'lulus')
                                            {{-- User already passed --}}
                                            <div class="alert alert-success">
                                                <i class="uil uil-check-circle me-1"></i>
                                                <strong>Selamat!</strong> Anda sudah lulus postest ini dengan nilai
                                                <strong>{{ $existingAttempt->nilai }}</strong>
                                            </div>
                                            <a href="{{ route('postest.hasil', $existingAttempt) }}"
                                                class="btn btn-outline-success btn-lg">
                                                <i class="uil uil-eye me-1"></i> Lihat Hasil
                                            </a>
                                        @elseif($existingAttempt && $existingAttempt->status === 'tidak_lulus')
                                            {{-- User failed, can retry --}}
                                            <div class="alert alert-warning">
                                                <i class="uil uil-exclamation-triangle me-1"></i>
                                                Anda belum lulus postest ini. Nilai terakhir:
                                                <strong>{{ $existingAttempt->nilai }}</strong>
                                            </div>
                                            <a href="{{ route('postest.mulai', $kursus_materi) }}"
                                                class="btn btn-warning btn-lg">
                                                <i class="uil uil-redo me-1"></i> Ulangi Postest
                                            </a>
                                            <a href="{{ route('postest.hasil', $existingAttempt) }}"
                                                class="btn btn-outline-secondary">
                                                Lihat Hasil Sebelumnya
                                            </a>
                                        @elseif($inProgressAttempt)
                                            {{-- User has in-progress attempt --}}
                                            <div class="alert alert-info">
                                                <i class="uil uil-clock me-1"></i>
                                                Anda memiliki postest yang belum selesai. Lanjutkan untuk
                                                menyelesaikannya.
                                            </div>
                                            <a href="{{ route('postest.soal', [$inProgressAttempt, 1]) }}"
                                                class="btn btn-info btn-lg">
                                                <i class="uil uil-arrow-right me-1"></i> Lanjutkan Postest
                                            </a>
                                        @else
                                            {{-- First time taking postest --}}
                                            <a href="{{ route('postest.mulai', $kursus_materi) }}"
                                                class="btn btn-primary btn-lg">
                                                <i class="uil uil-play me-1"></i> Mulai Ujian
                                            </a>
                                        @endif
                                    </div>
                                @else
                                    {!! $kursus_materi->konten !!}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-1">
                        <div>
                            @if (isset($materiSebelumnya))
                                <a href="{{ route('pelatihan.materi', $materiSebelumnya->id) }}"
                                    class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-skip-backward-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M.5 3.5A.5.5 0 0 0 0 4v8a.5.5 0 0 0 1 0V8.753l6.267 3.636c.54.313 1.233-.066 1.233-.697v-2.94l6.267 3.636c.54.314 1.233-.065 1.233-.696V4.308c0-.63-.693-1.01-1.233-.696L8.5 7.248v-2.94c0-.63-.692-1.01-1.233-.696L1 7.248V4a.5.5 0 0 0-.5-.5" />
                                    </svg>
                                    Prev
                                </a>
                            @endif
                        </div>

                        @if (isset($materiSelanjutnya))
                            @if ($materiProgress->materi->jenis != 'postest')
                                <a id="btnNext2" href="{{ route('pelatihan.next', $materiSelanjutnya->id) }}"
                                    class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-skip-forward-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M15.5 3.5a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V8.753l-6.267 3.636c-.54.313-1.233-.066-1.233-.697v-2.94L1.733 12.39C1.193 12.703.5 12.324.5 11.693V4.308c0-.63.693-1.01 1.233-.696L8 7.248v-2.94c0-.63.692-1.01 1.233-.696L15 7.248V4a.5.5 0 0 1 .5-.5" />
                                    </svg>
                                    Next
                                </a>
                            @else
                                @if ($pendaftaran->user_postest?->status == 'lulus')
                                    <a id="btnNext2" href="{{ route('pelatihan.next', $materiSelanjutnya->id) }}"
                                        class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-skip-forward-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M15.5 3.5a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V8.753l-6.267 3.636c-.54.313-1.233-.066-1.233-.697v-2.94L1.733 12.39C1.193 12.703.5 12.324.5 11.693V4.308c0-.63.693-1.01 1.233-.696L8 7.248v-2.94c0-.63.692-1.01 1.233-.696L15 7.248V4a.5.5 0 0 1 .5-.5" />
                                        </svg>
                                        Next
                                    </a>
                                @endif
                            @endif
                        @else
                            @if ($materiProgress->materi->jenis != 'postest')
                                <form
                                    action="{{ route('pelatihan.selesai', ['slug' => $kursus_materi->bagian->kursus->slug, 'kursus_materi' => $kursus_materi->id]) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        Selesai
                                    </button>
                                </form>
                            @else
                                @if ($pendaftaran->user_postest?->status == 'lulus')
                                    <form
                                        action="{{ route('pelatihan.selesai', ['slug' => $kursus_materi->bagian->kursus->slug, 'kursus_materi' => $kursus_materi->id]) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            Selesai
                                        </button>
                                    </form>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.home>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Skip countdown timer for:
        // 1. Postest pages
        @if ($kursus_materi->jenis === 'postest')
            return;
        @endif

        // 2. Completed materials (status 'selesai')
        @if ($materiProgress && $materiProgress->status === 'selesai')
            return;
        @endif

        // 3. Completed training (all materials done)
        @if ($user_progress && $user_progress->status === 'selesai')
            return;
        @endif

        // daftar ID tombol
        const buttons = [
            document.getElementById('btnNext1'),
            document.getElementById('btnNext2')
        ].filter(btn => btn !== null);

        // Jika tidak ada tombol Next, skip
        if (buttons.length === 0) return;

        let countdown = 30; // 30 detik

        // Fungsi disable semua tombol
        function disableButtons() {
            buttons.forEach(btn => {
                btn.classList.remove('btn-primary');
                btn.classList.add('btn-secondary');
                btn.style.pointerEvents = 'none';
            });
        }

        // Fungsi enable kembali
        function enableButtons() {
            buttons.forEach(btn => {
                btn.classList.remove('btn-secondary');
                btn.classList.add('btn-primary');
                btn.style.pointerEvents = 'auto';
                btn.textContent = "Next";
            });
        }

        // Jalankan countdown
        function startCountdown() {
            disableButtons();

            const interval = setInterval(() => {
                countdown--;
                buttons.forEach(btn => btn.textContent = "Tunggu " + countdown + " detik");

                if (countdown <= 0) {
                    clearInterval(interval);
                    enableButtons();
                }
            }, 1000);
        }

        // Mulai hitungan
        startCountdown();
    });
</script>
