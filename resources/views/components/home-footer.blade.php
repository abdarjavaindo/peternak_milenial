<footer class="footer" style="background: #05559e;">
    @if (request()->segment(1) == null)
        <section class="section pb-0 mt-60">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="features-absolute">
                            <div class="row">
                                <div class="col-md-4">
                                    <div
                                        class="card border-0 text-center features feature-primary feature-clean course-feature p-4 overflow-hidden shadow">
                                        <div class="icons text-center mx-auto">
                                            <i class="uil uil-user-check d-block rounded h3 mb-0"></i>
                                        </div>
                                        <div class="card-body p-0 mt-4">
                                            <a href="javascript:void(0)" class="title h5 text-dark">
                                                {{ number_format($set_inaugurasi, 0, ',', '.') }}
                                            </a>
                                            <p class="text-muted mt-2">
                                                Inaugurasi Peternak
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-4 pt-2 mt-sm-0 pt-sm-0">
                                    <div
                                        class="card border-0 text-center features feature-primary feature-clean course-feature p-4 overflow-hidden shadow">
                                        <div class="icons text-center mx-auto">
                                            <i class="uil uil-users-alt d-block rounded h3 mb-0"></i>
                                        </div>
                                        <div class="card-body p-0 mt-4">
                                            <a href="javascript:void(0)" class="title h5 text-dark">
                                                {{ number_format($set_aktif, 0, ',', '.') }}
                                            </a>
                                            <p class="text-muted mt-2">
                                                Peternak Aktif
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-4 pt-2 mt-sm-0 pt-sm-0">
                                    <div
                                        class="card border-0 text-center features feature-primary feature-clean course-feature p-4 overflow-hidden shadow">
                                        <div class="icons text-center mx-auto">
                                            <i class="uil uil-chart-line d-block rounded h3 mb-0"></i>
                                        </div>
                                        <div class="card-body p-0 mt-4">
                                            <a href="javascript:void(0)" class="title h5 text-dark">
                                                {{ $set_komuditas }}
                                            </a>
                                            <p class="text-muted mt-2">
                                                Komuditas Peternak
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <div class="container" style="background: #05559e">
        <div class="row">
            <div class="col-12">
                <div class="footer-py-60">
                    <div class="row">
                        <div class="col-lg-6 col-12 mb-0 mb-md-4 pb-0 pb-md-2">
                            <a href="{{ url('/') }}" class="logo-footer">
                                <img src="{{ asset('storage/' . $set_logo) }}" alt=""
                                    style="width: 260px; object-fit: cover;" />
                            </a>
                            <p class="mt-4" style="color:white">{{ $set_deskripsi }}</p>
                        </div>

                        <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                            <h5 class="footer-head">Link Terkait</h5>
                            <ul class="list-unstyled footer-list mt-4">
                                <li>
                                    <a href="{{ route('lihatgaleri') }}" class="text-foot">
                                        <i class="uil uil-angle-right-b me-1"></i> Galeri
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('kontak') }}" class="text-foot">
                                        <i class="uil uil-angle-right-b me-1"></i> Kontak
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('shop') }}" class="text-foot">
                                        <i class="uil uil-angle-right-b me-1"></i> Marketplace
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('pelatihan') }}" class="text-foot">
                                        <i class="uil uil-angle-right-b me-1"></i> Pelatihan
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('forum') }}" class="text-foot">
                                        <i class="uil uil-angle-right-b me-1"></i> Forum
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                            <h5 class="footer-head">Social Media</h5>
                            <ul class="list-unstyled social-icon foot-social-icon mb-0 mt-4">
                                <li class="list-inline-item">
                                    <a href="{{ 'mailto:' . @$set_email }}" target="_blank" class="rounded">
                                        <i data-feather="mail" class="fea icon-sm fea-social"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{ 'tel:' . @$set_no_telp }}" target="_blank" class="rounded">
                                        <i data-feather="phone" class="fea icon-sm fea-social"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{ url($set_fb) }}" class="rounded" target="_blank">
                                        <i data-feather="facebook" class="fea icon-sm fea-social"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{ @$set_twitter }}" class="rounded" target="_blank">
                                        <i data-feather="twitter" class="fea icon-sm fea-social"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{ @$set_youtube }}" target="_blank" class="rounded">
                                        <i data-feather="youtube" class="fea icon-sm fea-social"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{ @$set_ig }}" class="rounded" target="_blank">
                                        <i data-feather="instagram" class="fea icon-sm fea-social"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{ @$set_tiktok }}" target="_blank" class="rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                                            <path
                                                d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z" />
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-py-30 footer-bar" style="background: #0078d7">
        <div class="container text-center">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="text-sm-start" style="color:white">
                        <p class="mb-0">©
                            <script>
                                document.write(new Date().getFullYear())
                            </script> {{ $set_instansi }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
