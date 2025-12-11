<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />

    <title>{{ config('app.name', 'Laravel Starter Kit') }}</title>
    <link rel="stylesheet" href="{{ asset('assets') }}/mobirise/web/assets/mobirise-icons2/mobirise2.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/mobirise/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/mobirise/bootstrap/css/bootstrap-grid.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/mobirise/bootstrap/css/bootstrap-reboot.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/mobirise/dropdown/css/style.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/mobirise/socicon/css/styles.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/mobirise/theme/css/style.css" />
    <link rel="preload"
        href="https://fonts.googleapis.com/css?family=Inter+Tight:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'" />
    <noscript>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Inter+Tight:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap" />
    </noscript>
    <link rel="preload" as="style"
        href="{{ asset('assets') }}/mobirise/mobirise/css/mbr-additional.css?v=8MtH0c" />
    <link rel="stylesheet" href="{{ asset('assets') }}/mobirise/mobirise/css/mbr-additional.css?v=8MtH0c"
        type="text/css" />
</head>

<body>
    <section data-bs-version="5.1" class="menu menu5 cid-v3Eb2giOPw" once="menu" id="menu05-0">
        <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
            <div class="container">
                <div class="navbar-brand">
                    <span class="navbar-logo">
                        <a href="{{ env('APP_URL') }}">
                            <img src="{{ asset('assets') }}/mobirise/images/channels4-profile-137x137.jpg"
                                alt="Mobirise Website Builder" style="height: 4.3rem" />
                        </a>
                    </span>
                    <span class="navbar-caption-wrap"><a class="navbar-caption text-black display-4"
                            href="{{ url('/') }}">PETERNAK MILENIAL</a></span>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse"
                    data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                        <li class="nav-item">
                            <a class="nav-link link text-black text-primary display-4" href="{{ route('home') }}">
                                Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-black text-primary display-4" href="{{ route('kontak') }}">
                                Kontak
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-black display-4" href="{{ route('shop') }}">
                                Produk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-black display-4" href="{{ route('pelatihan') }}">
                                Pelatihan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-black display-4" href="{{ route('forum') }}">
                                Forum
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-buttons mbr-section-btn">
                        @if (auth()->user())
                            <a class="btn btn-primary display-4" href="{{ route('userprofile.edit') }}">
                                Menuju Profil
                            </a>
                        @else
                            <a class="btn btn-primary display-4" href="{{ route('login') }}">
                                Ayo Rekk ... Gabung!
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    </section>

    {{ $slot }}

    <section data-bs-version="5.1" class="footer3 cid-v3EdMQTQxG" once="footers" id="footer03-7">
        <div class="container">
            <div class="row">
                <div class="row-links">
                    <ul class="header-menu">
                        <li class="header-menu-item mbr-fonts-style display-5">
                            <a href="{{ route('shop') }}" class="text-primary">Marketplace</a>
                        </li>
                        <li class="header-menu-item mbr-fonts-style display-5">
                            <a href="{{ route('pelatihan') }}" class="text-primary">Pelatihan</a>
                        </li>
                        <li class="header-menu-item mbr-fonts-style display-5">
                            <a href="{{ route('forum') }}" class="text-primary">Forum</a>
                        </li>
                    </ul>
                </div>

                <div class="col-12 mt-4">
                    <div class="social-row">
                        <div class="soc-item">
                            <a href="https://mobiri.se/" target="_blank">
                                <span class="mbr-iconfont socicon socicon-facebook display-7"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="https://mobiri.se/" target="_blank">
                                <span class="mbr-iconfont socicon-twitter socicon"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="https://mobiri.se/" target="_blank">
                                <span class="mbr-iconfont socicon-instagram socicon"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="https://mobiri.se/" target="_blank">
                                <span class="mbr-iconfont socicon-youtube socicon"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="https://mobiri.se/" target="_blank">
                                <span class="mbr-iconfont socicon socicon-tiktok"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-5">
                    <p class="mbr-fonts-style copyright display-7">
                        © Copyright 2025 Dinas Peternakan Provinsi Jawa Timur
                    </p>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets') }}/mobirise/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/mobirise/smoothscroll/smooth-scroll.js"></script>
    <script src="{{ asset('assets') }}/mobirise/ytplayer/index.js"></script>
    <script src="{{ asset('assets') }}/mobirise/dropdown/js/navbar-dropdown.js"></script>
    <script src="{{ asset('assets') }}/mobirise/masonry/masonry.pkgd.min.js"></script>
    <script src="{{ asset('assets') }}/mobirise/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('assets') }}/mobirise/theme/js/script.js"></script>
</body>

</html>
