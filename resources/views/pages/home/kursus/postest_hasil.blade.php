<x-layouts.home>
    <!-- Result Section -->
    <section class="section mt-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <!-- Result Card -->
                    <div class="card rounded shadow border-0">
                        <div class="card-body p-5 text-center">
                            <!-- Status Icon -->
                            @if ($attempt->status === 'lulus')
                                <div class="mb-4">
                                    <div class="avatar avatar-xl-large bg-soft-success rounded-circle mx-auto d-flex align-items-center justify-content-center"
                                        style="width: 120px; height: 120px;">
                                        <i class="uil uil-check-circle text-success" style="font-size: 60px;"></i>
                                    </div>
                                </div>
                                <h2 class="text-success mb-3">Selamat, Anda Lulus!</h2>
                            @else
                                <div class="mb-4">
                                    <div class="avatar avatar-xl-large bg-soft-danger rounded-circle mx-auto d-flex align-items-center justify-content-center"
                                        style="width: 120px; height: 120px;">
                                        <i class="uil uil-times-circle text-danger" style="font-size: 60px;"></i>
                                    </div>
                                </div>
                                <h2 class="text-danger mb-3">Maaf, Anda Belum Lulus</h2>
                            @endif

                            <!-- Score Display -->
                            <div class="row mt-4">
                                <div class="col-md-4 mb-3">
                                    <div class="card bg-light border-0">
                                        <div class="card-body">
                                            <h4 class="text-primary mb-0">{{ $attempt->nilai }}</h4>
                                            <small class="text-muted">Nilai Anda</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card bg-light border-0">
                                        <div class="card-body">
                                            <h4 class="text-dark mb-0">{{ $kkm }}</h4>
                                            <small class="text-muted">Nilai KKM</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card bg-light border-0">
                                        <div class="card-body">
                                            <h4 class="text-success mb-0">{{ $benar }}/{{ $totalSoal }}</h4>
                                            <small class="text-muted">Jawaban Benar</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Details -->
                            <div class="mt-4 p-4 bg-light rounded">
                                <div class="row text-start">
                                    <div class="col-6 mb-2">
                                        <small class="text-muted">Materi:</small>
                                        <p class="mb-0 fw-bold">{{ $materi->judul }}</p>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <small class="text-muted">Status:</small>
                                        <p class="mb-0">
                                            @if ($attempt->status === 'lulus')
                                                <span class="badge bg-success">LULUS</span>
                                            @else
                                                <span class="badge bg-danger">TIDAK LULUS</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <small class="text-muted">Waktu Mulai:</small>
                                        <p class="mb-0">{{ $attempt->mulai_pada->format('d M Y H:i') }}</p>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <small class="text-muted">Waktu Selesai:</small>
                                        <p class="mb-0">{{ $attempt->selesai_pada->format('d M Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="mt-4">
                                @if ($attempt->status === 'lulus' && isset($nextMateri))
                                    {{-- User passed and there's next material --}}
                                    <a href="{{ route('pelatihan.materi', $nextMateri->id) }}"
                                        class="btn btn-success btn-lg">
                                        <i class="uil uil-arrow-right me-1"></i> Lanjutkan ke Materi Berikutnya
                                    </a>
                                    <br><br>
                                    <a href="{{ route('pelatihan.detail', $materi->bagian->kursus->slug) }}"
                                        class="btn btn-outline-secondary">
                                        <i class="uil uil-list-ul me-1"></i> Lihat Daftar Materi
                                    </a>
                                @elseif($attempt->status === 'lulus' && !isset($nextMateri))
                                    {{-- User passed and course is complete --}}
                                    <div class="alert alert-success mb-3">
                                        <i class="uil uil-trophy me-1"></i>
                                        <strong>Selamat!</strong> Anda telah menyelesaikan semua materi dalam pelatihan
                                        ini!
                                    </div>
                                    <a href="{{ route('pelatihan.detail', $materi->bagian->kursus->slug) }}"
                                        class="btn btn-success btn-lg">
                                        <i class="uil uil-check-circle me-1"></i> Lihat Ringkasan Pelatihan
                                    </a>
                                    <a href="{{ route('pelatihan') }}" class="btn btn-outline-primary">
                                        <i class="uil uil-book-open me-1"></i> Lihat Pelatihan Lainnya
                                    </a>
                                @else
                                    {{-- User failed --}}
                                    <a href="{{ route('pelatihan.detail', $materi->bagian->kursus->slug) }}"
                                        class="btn btn-primary">
                                        <i class="uil uil-arrow-left me-1"></i> Kembali ke Kursus
                                    </a>
                                @endif
                            </div>

                            @if ($attempt->status !== 'lulus')
                                <div class="mt-3">
                                    <a href="{{ route('postest.mulai', $materi) }}" class="btn btn-warning">
                                        <i class="uil uil-redo me-1"></i> Ulangi Post-test
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.home>
<script>
    (function() {
        history.pushState(null, null, location.href);
        window.addEventListener('popstate', function() {
            location.replace("{{ route('postest.hasil', $attempt->id) }}");
        });
    })();
</script>
