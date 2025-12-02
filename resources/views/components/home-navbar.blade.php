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
        --bs-nav-pills-link-active-bg: #222222;
    }

    .bg-primary {
        background-color: #222222 !important;
    }

    @media only screen and (min-width: 768px) {
        #topnav {
            background-color: #222222
        }

        #topnav .navigation-menu>li>a {
            color: white;
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
    <div class="container px-5">
        <!-- Logo container-->
        <a class="logo" href="{{ env('APP_URL') }}">
            <span class="logo-light-mode">
                {{-- <img src="{{ asset('assets') }}/images/logo-dark.png" class="l-dark" height="60" alt="">
                <img src="{{ asset('assets') }}/images/logo-light.png" class="l-light" height="60" alt=""> --}}
                <img src="{{ asset('assets') }}/mobirise/images/channels4-profile-137x137.jpg"
                    alt="Mobirise Website Builder" height="60" />
            </span>
            <small class="txtheader">
                PETERNAK MILENIAL
            </small>
            {{-- <img src="{{ asset('assets') }}/images/logo-light.png" height="60" class="logo-dark-mode" alt=""> --}}
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
                        <a href="{{ route('login') }}" class="btn border-dark login">Login</a>
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
                        Hubungi Kami
                    </a>
                </li>
                <li>
                    <a href="{{ route('shop') }}" class="sub-menu-item">
                        Produk
                    </a>
                </li>
                <li>
                    <a href="{{ route('pelatihan') }}" class="sub-menu-item">
                        Pelatihan
                    </a>
                </li>
                @if (auth()->user())
                    <li class="has-submenu parent-menu-item">
                        <a href="javascript:void(0)">
                            <u>
                                {{ Str::limit(Auth::user()->name, 15, '...') }}
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
                                        Tokoku
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
