@if (request()->segment(1) != null)
    <style>
        #topnav .navigation-menu>li.active>a,
        #topnav .navigation-menu>li:hover>a {
            color: #129d89 !important;
        }

        #topnav .has-submenu.active.active .menu-arrow {
            border-color: #129d89;
        }

        #topnav .has-submenu.active .submenu li.active>a {
            color: #129d89 !important;
        }

        #topnav .navigation-menu>li.active>a,
        #topnav .navigation-menu>li:hover>a {
            color: #129d89 !important;
        }

        #topnav .has-submenu.active.active .menu-arrow {
            border-color: #129d89;
        }

        #topnav .has-submenu.active .submenu li.active>a {
            color: #129d89 !important;
        }

        #topnav .navigation-menu .has-submenu .menu-arrow {
            padding: 3px;
        }

        #topnav .navigation-menu.nav-light>li>a {
            color: black;
        }

        @media only screen and (min-width: 768px) {
            #topnav {
                /* background-color: #222222 */
                /* background-color: #006a39 */
                background-color: #ffffff
            }

            #topnav .navigation-menu>li>a {
                color: white;
            }
        }
    </style>
@endif

<style>
    .bg-overlay {
        background-color: rgba(22, 92, 125, 0.4);
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
    }

    .nav-pills {
        /* --bs-nav-pills-link-active-bg: #222222; */
        /* --bs-nav-pills-link-active-bg: #006a39; */
        --bs-nav-pills-link-active-bg: #ffffff;
    }

    .bg-primary {
        /* background-color: #222222 !important; */
        /* background-color: #006a39 !important; */
        background-color: #ffffff !important;
    }

    #topnav .navigation-menu.nav-light>li.active>a {
        color: #05559e !important;
    }

    @media only screen and (min-width: 768px) {
        #navigation .navigation-menu>li>a {
            padding: 25px 10px !important;
        }
    }

    /* Add class `btn-light` styles for laptop mode */
    @media (min-width: 1024px) {
        .login {
            background-color: #f8f9fa;
            /* Light background (btn-light equivalent) */
            color: #000;
            /* Text color for light button */
        }

        .txtheader {
            color: white;
        }

        /* Pastikan parent jadi acuan posisi */
        #topnav .parent-menu-item {
            position: relative;
        }

        /* Geser dropdown ke kiri (nempel ke kanan parent) */
        #topnav .submenu {
            left: auto !important;
            right: 0;
            min-width: 200px;
        }
    }

    /* Add `text-white` and custom background for mobile mode */
    @media (max-width: 1023px) {
        .login {
            background-color: #222222;
            color: white;
        }

        .txtheader {
            color: black;
        }
    }
</style>

<header id="topnav" class="defaultscroll sticky">
    <div class="container-fluid px-5">
        <!-- Logo container-->
        <a class="logo" href="{{ env('APP_URL') }}">
            <span class="logo-light-mode">
                <img src="{{ asset('storage/' . $set_logo) }}" alt="" style="width: 160px; object-fit: cover;" />
            </span>
        </a>

        <!-- End Logo container-->
        <div class="menu-extras">
            <div class="menu-item">
                <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
            </div>
        </div>

        <!--Login button Start-->
        @if (!auth()->user())
            <ul class="buy-button list-inline mb-0">
                <li class="list-inline-item mb-0">
                    <a href="javascript:void(0)" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                        aria-controls="offcanvasRight">
                        <a href="{{ route('login') }}" class="btn border-dark login">Gabung</a>
                    </a>
                </li>
            </ul>
        @endif
        <!--Login button End-->

        <div id="navigation">
            <ul class="navigation-menu nav-light nav-right">
                <li>
                    <a href="{{ route('home') }}" class="sub-menu-item">
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="{{ route('kontak') }}" class="sub-menu-item">
                        Kontak
                    </a>
                </li>
                <li>
                    <a href="{{ route('lihatgaleri') }}" class="sub-menu-item">
                        Galeri
                    </a>
                </li>
                <li>
                    <a href="{{ route('shop') }}" class="sub-menu-item">
                        Marketplace
                    </a>
                </li>
                <li>
                    <a href="{{ route('pelatihan') }}" class="sub-menu-item">
                        Pelatihan
                    </a>
                </li>
                <li>
                    <a href="{{ route('forum') }}" class="sub-menu-item">
                        Forum
                    </a>
                </li>
                @if (auth()->user())
                    <li class="has-submenu parent-menu-item">
                        <a href="javascript:void(0)">
                            <u>
                                {{ Str::limit(Auth::user()->name, 5, '...') }}
                            </u>
                        </a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            @if (auth()->user()->hasRole('user'))
                                <li>
                                    <a href="{{ route('tokoku.create') }}" class="sub-menu-item">
                                        Jual Produk
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('shop.user', auth()->user()->slug) }}" class="sub-menu-item">
                                        Etalaseku
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('ternak') }}" class="sub-menu-item">
                                        Daftar Ternak
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('userprofile.edit') }}" class="sub-menu-item">
                                        Akun
                                    </a>
                                </li>
                                <hr>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item pb-3 text-center" type="submit">
                                            Log Out
                                        </button>
                                    </form>
                                </li>
                            @endif
                            @if (auth()->user()->hasRole('admin'))
                                <li>
                                    <a href="{{ route('dashboard') }}" class="sub-menu-item">
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('profile.edit') }}" class="sub-menu-item">
                                        Akun
                                    </a>
                                </li>
                                <hr>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item pb-3 text-center" type="submit">Log Out</button>
                                    </form>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</header>
