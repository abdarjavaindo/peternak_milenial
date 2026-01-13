<x-layouts.home>
    <section class="section mt-60">
        <div class="container">

            <div class="row mb-4">
                <div class="col-lg-12">
                    <ul class="nav nav-pills nav-justified flex-column flex-sm-row rounded">
                        <li class="nav-item">
                            <a class="nav-link rounded border border-1 border-dark bg-white"
                                href="{{ route('userprofile.edit') }}">
                                <div class="text-center py-2">
                                    <h6 class="mb-0">Profil Peternak</h6>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link rounded border border-1 border-dark bg-white"
                                href="{{ route('ternak') }}">
                                <div class="text-center py-2">
                                    <h6 class="mb-0">Ternak yang Dimiliki</h6>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link rounded border border-1 border-dark bg-dark"
                                href="{{ route('riwayat.pelatihan') }}">
                                <div class="text-center py-2">
                                    <h6 class="mb-0 text-white">Riwayat Pelatihan</h6>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <h3 class="mb-4">Riwayat Pelatihan Saya</h3>

                    @if($riwayat->isEmpty())
                        <div class="alert alert-info">
                            <i class="uil uil-info-circle me-2"></i>
                            Anda belum mengikuti pelatihan apapun.
                            <a href="{{ route('pelatihan') }}" class="alert-link">Lihat pelatihan yang tersedia</a>
                        </div>
                    @else
                        @foreach($riwayat as $item)
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <h5 class="card-title mb-2">
                                                <a href="{{ route('pelatihan.detail', $item->kursus->slug) }}"
                                                    class="text-dark">
                                                    {{ $item->kursus->judul }}
                                                </a>
                                            </h5>
                                            <p class="text-muted mb-2">
                                                <i class="uil uil-clock me-1"></i>
                                                Durasi: {{ $item->kursus->hari }} hari
                                                <span class="mx-2">|</span>
                                                <i class="uil uil-book-open me-1"></i>
                                                Progress: {{ $item->progresMateri->where('status', 'selesai')->count() }} materi
                                                selesai
                                            </p>
                                            <small class="text-muted">
                                                <i class="uil uil-calendar-alt me-1"></i>
                                                Terdaftar: {{ $item->created_at->format('d M Y') }}
                                                @if($item->harus_selesai_tgl)
                                                    <span class="mx-2">|</span>
                                                    <i class="uil uil-clock-three me-1"></i>
                                                    Deadline:
                                                    {{ \Carbon\Carbon::parse($item->harus_selesai_tgl)->format('d M Y H:i') }}
                                                @endif
                                            </small>
                                        </div>
                                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                            @if($item->status === 'selesai')
                                                <span class="badge bg-success px-3 py-2 mb-2">
                                                    <i class="uil uil-check-circle me-1"></i> Selesai
                                                </span>
                                            @elseif($item->status === 'do')
                                                <span class="badge bg-danger px-3 py-2 mb-2">
                                                    <i class="uil uil-times-circle me-1"></i> Drop Out
                                                </span>
                                            @else
                                                <span class="badge bg-warning text-dark px-3 py-2 mb-2">
                                                    <i class="uil uil-spinner me-1"></i> Dalam Progress
                                                </span>
                                            @endif
                                            <br>
                                            <a href="{{ route('pelatihan.detail', $item->kursus->slug) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="uil uil-eye me-1"></i> Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-center mt-4">
                            {{ $riwayat->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </section>
</x-layouts.home>