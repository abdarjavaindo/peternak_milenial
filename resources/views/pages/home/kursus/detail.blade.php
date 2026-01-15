<x-layouts.home>
    <section class="section mt-600 mt-60">
        <div class="container">
            <div class="row">
                <div class="card m-2 p-2">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <x-flash-message></x-flash-message>
                            <h4 class="title mb-4">{{ $pelatihan->judul }}</h4>
                            <ul class="list-unstyled mt-4 mb-0">
                                @php
                                    $color =
                                        ['pemula' => 'text-success', 'menengah' => 'text-warning'][$pelatihan->level] ??
                                        'text-danger';
                                @endphp
                                <li class="align-items-center justify-content-center list-inline-item mx-2">
                                    <i class="uil uil-signal fs-5 {{ $color }} title-dark align-middle"></i>
                                    <span class="{{ $color }} ms-1">Level
                                        {{ Str::ucfirst($pelatihan->level) }}</span>
                                </li>

                                @if ($pelatihan->kategori_kursus_id == 1)
                                    <li class="align-items-center justify-content-center list-inline-item mx-2">
                                        <i class="uil uil-clock fs-5 text-dark title-dark align-middle"></i>
                                        <span class="text-dark-50 ms-1">Waktu pengerjaan {{ $pelatihan->hari }}
                                            Hari</span>
                                    </li>
                                @endif

                                <li class="align-items-center justify-content-center list-inline-item mx-2">
                                    <i class="uil uil-book-reader fs-5 text-dark title-dark align-middle"></i>
                                    <span class="text-dark-50 ms-1">Di ikuti oleh {{ $jumlahpeserta }} peserta</span>
                                </li>

                                <li class="align-items-center justify-content-center list-inline-item mx-2">
                                    <i class="uil uil-book fs-5 text-dark title-dark align-middle"></i>
                                    <span
                                        class="text-dark-50 ms-1">{{ $pelatihan->kategori_kursus_id == 1 ? 'Pelatihan Online' : 'Pelatihan Offline' }}</span>
                                </li>
                            </ul>

                            @if ($pelatihan->kategori_kursus_id == 1)
                                @if (isset($user_progress) && $user_progress->status == 'progres')
                                    <p>
                                        Waktu anda tinggal: <span id="timer">Menghitung...</span>
                                    </p>
                                @endif
                            @endif

                            @if (!auth()->check())
                                {{-- User belum login --}}
                                <a class="btn btn-dark btn-daftar-pelatihan"
                                    href="{{ route('pelatihan.daftar', $pelatihan->slug) }}">
                                    Belajar Sekarang
                                </a>
                            @elseif (!$user_progress)
                                {{-- User login tetapi belum mendaftar kursus --}}
                                <a class="btn btn-dark btn-daftar-pelatihan"
                                    href="{{ route('pelatihan.daftar', $pelatihan->slug) }}">
                                    Belajar Sekarang
                                </a>
                            @else
                                @if ($pelatihan->kategori_kursus_id == 1)
                                    {{-- User sudah mulai kursus --}}
                                    @if ($user_progress->status == 'do')
                                        <a class="btn btn-danger btn-reset-pelatihan"
                                            href="{{ route('pelatihan.reset', $pelatihan->slug) }}">
                                            Anda sudah dinyatakan 'DO', mulai lagi?
                                        </a>
                                    @elseif ($next_materi)
                                        <a class="btn btn-success"
                                            href="{{ route('pelatihan.materi', $next_materi->id) }}">
                                            Lanjutkan Materi: {{ $next_materi->judul }}
                                        </a>
                                    @else
                                        <span class="badge bg-soft-success text-success fs-6 py-2 px-3 me-2">
                                            <i class="uil uil-check-circle me-1"></i> Semua materi telah selesai
                                        </span>
                                        @php
                                            $materiPertama = $pelatihan->bagian
                                                ->sortBy('urutan')
                                                ->first()
                                                ?->materi->sortBy('urutan')
                                                ->first();
                                        @endphp
                                        @if ($materiPertama)
                                            <a class="btn btn-outline-success"
                                                href="{{ route('pelatihan.materi', $materiPertama->id) }}">
                                                <i class="uil uil-book-open me-1"></i> Review Materi
                                            </a>
                                        @endif
                                        <a class="btn btn-outline-primary ms-2" href="{{ route('pelatihan') }}">
                                            Lihat Pelatihan Lainnya
                                        </a>
                                    @endif
                                @else
                                    @if ($user_progress->status == 'do')
                                        <button class="btn btn-danger" href="#" disabled>
                                            Pelatihan selesai, anda dinyatakan tidak lulus
                                        </button>
                                    @elseif ($user_progress->status == 'progres')
                                        <button class="btn btn-warning" href="#" disabled>
                                            Anda sudah terdaftar
                                        </button>
                                    @else
                                        <span class="badge bg-soft-success text-success fs-6 py-2 px-3 me-2">
                                            <i class="uil uil-check-circle me-1"></i> Pelatihan telah selesai
                                        </span>
                                        <a class="btn btn-outline-primary ms-2" href="{{ route('pelatihan') }}">
                                            Lihat Pelatihan Lainnya
                                        </a>
                                    @endif
                                @endif
                            @endif

                            <hr>
                            {!! $pelatihan->deskripsi !!}
                        </div>

                        <div class="row">
                            {{-- <div class="col-md-6 mt-4 pt-2">
                                <img src="{{ asset('storage/' . $pelatihan->gambar) }}" class="img-fluid rounded shadow"
                                    alt="">
                            </div> --}}

                            <div class="col-md-12 mt-4 pt-2">
                                @php
                                    preg_match(
                                        '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|shorts)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/',
                                        $pelatihan->youtube,
                                        $matches,
                                    );
                                    $videoId = $matches[1] ?? null;
                                @endphp

                                @if ($videoId)
                                    <div class="ratio ratio-16x9 w-100 h-100">
                                        <iframe src="https://www.youtube.com/embed/{{ $videoId }}"
                                            title="YouTube video player" allowfullscreen class="rounded shadow">
                                        </iframe>
                                    </div>
                                @else
                                    <p class="text-danger">Link YouTube tidak valid.</p>
                                @endif
                            </div>
                        </div>

                        <div class="section-title mt-4 pt-2">

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

                        {{-- <div class="section-title mt-4 pt-2">
                            <h4 class="title mb-0">Instruktur</h4>

                            <div class="d-md-flex align-items-center mt-4 pt-2">
                                <img src="{{ asset('storage/' . $pelatihan->pengajar->gambar) }}"
                                    class="avatar avatar-medium rounded-pill" alt="">

                                <div class="ms-md-3 mt-4 mt-sm-0">
                                    <a href="javascript:void(0)" class="text-dark h5">{{ $pelatihan->pengajar->nama
                                        }}</a>
                                    <p class="text-muted mb-0 mt-2">{{ $pelatihan->pengajar->title }}</p>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.home>

@if (isset($user_progress))
    <script>
        // ini buat timer
        document.addEventListener("DOMContentLoaded", function() {
            // Tentukan durasi berdasarkan status
            const waktuPelunasan = new Date("{{ $user_progress->harus_selesai_tgl }}");

            function updateTimer() {
                const now = new Date();
                const timeRemaining = waktuPelunasan - now;

                if (timeRemaining <= 0) {
                    clearInterval(timerInterval);
                    document.getElementById("timer").textContent = "Waktu Habis";
                    return;
                }

                const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

                document.getElementById("timer").textContent =
                    `${days} hari ${hours} jam ${minutes} menit ${seconds} detik`;
            }

            // Update timer setiap detik
            const timerInterval = setInterval(updateTimer, 1000);
            updateTimer(); // Panggil langsung agar tampil segera
        });
    </script>
@endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Daftar Pelatihan confirmation
        document.querySelectorAll('.btn-daftar-pelatihan').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var href = this.getAttribute('href');
                Swal.fire({
                    title: 'Daftar Pelatihan?',
                    html: '<p>Apakah anda yakin ingin mengikuti pelatihan ini?</p>',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Daftar!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        });

        // Reset Pelatihan (DO) confirmation
        document.querySelectorAll('.btn-reset-pelatihan').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var href = this.getAttribute('href');
                Swal.fire({
                    title: 'Mulai Ulang Pelatihan?',
                    html: '<p>Apakah anda yakin ingin memulai kembali pelatihan ini?</p>' +
                        '<p class="text-warning"><strong>⚠️ Perhatian:</strong> Progress sebelumnya akan direset.</p>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Mulai Ulang!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        });
    });
</script>
