<nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
    <ul class="app-menu list-unstyled accordion" id="menu-accordion">

        @if (auth()->user()->hasRole('admin'))
            <li class="nav-item">
                <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                <a class="nav-link {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">
                    <span class="nav-icon">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" />
                            <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                        </svg>
                    </span>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(1) == 'pembelajaran' ? 'active' : '' }}"
                    href="{{ route('pembelajaran') }}">
                    <span class="nav-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-journal" viewBox="0 0 16 16">
                            <path
                                d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                            <path
                                d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
                        </svg>
                    </span>
                    <span class="nav-link-text">Pelatihan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(1) == 'produk' ? 'active' : '' }}"
                    href="{{ route('produk') }}">
                    <span class="nav-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-bag" viewBox="0 0 16 16">
                            <path
                                d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                        </svg>
                    </span>
                    <span class="nav-link-text">Marketplace</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(1) == 'user' ? 'active' : '' }}" href="{{ route('user') }}">
                    <span class="nav-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-people" viewBox="0 0 16 16">
                            <path
                                d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                        </svg>
                    </span>
                    <span class="nav-link-text">Peternak (User)</span>
                </a>
            </li>
        @endif


        @if (auth()->user()->hasRole('admin'))
            <li class="nav-item has-submenu">
                <a class="nav-link submenu-toggle {{ in_array(request()->segment(1), ['kategori-kursus', 'kategori-produk', 'hewan', 'galeri', 'pengaturan', 'pengaturan-kontak', 'testimoni', 'fitur']) ? 'active' : '' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#submenu-1" aria-expanded="false"
                    aria-controls="submenu-1">
                    <span class="nav-icon">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.828 4a3 3 0 0 1-2.12-.879l-.83-.828A1 1 0 0 0 6.173 2H2.5a1 1 0 0 0-1 .981L1.546 4h-1L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3v1z" />
                            <path fill-rule="evenodd"
                                d="M13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4zM2.19 3A2 2 0 0 0 .198 5.181l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H2.19z" />
                        </svg>
                    </span>
                    <span class="nav-link-text">Data Master</span>
                    <span class="submenu-arrow">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </span>
                </a>
                <div id="submenu-1"
                    class="collapse submenu submenu-1 {{ in_array(request()->segment(1), ['kategori-kursus', 'kategori-produk', 'hewan', 'galeri', 'pengaturan', 'pengaturan-kontak', 'testimoni', 'fitur']) ? 'show' : '' }}"
                    data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        <li class="submenu-item">
                            <a class="submenu-link {{ request()->segment(1) == 'kategori-kursus' ? 'active' : '' }}"
                                href="{{ route('kategori-kursus') }}">
                                Kategori Kursus
                            </a>
                        </li>
                        <li class="submenu-item">
                            <a class="submenu-link {{ request()->segment(1) == 'hewan' ? 'active' : '' }}"
                                href="{{ route('hewan') }}">
                                Hewan
                            </a>
                        </li>
                        <li class="submenu-item">
                            <a class="submenu-link {{ request()->segment(1) == 'kategori-produk' ? 'active' : '' }}"
                                href="{{ route('kategori-produk') }}">
                                Komuditas yang Dijual
                            </a>
                        </li>
                        <li class="submenu-item">
                            <a class="submenu-link {{ request()->segment(1) == 'galeri' ? 'active' : '' }}"
                                href="{{ route('galeri') }}">
                                Galeri
                            </a>
                        </li>
                        <li class="submenu-item">
                            <a class="submenu-link {{ request()->segment(1) == 'pengaturan' ? 'active' : '' }}"
                                href="{{ route('pengaturan.edit', 1) }}">
                                Pengaturan Website
                            </a>
                        </li>
                        <li class="submenu-item">
                            <a class="submenu-link {{ request()->segment(1) == 'pengaturan-kontak' ? 'active' : '' }}"
                                href="{{ route('pengaturan.kontak_edit', 1) }}">
                                Social Media dan Kontak
                            </a>
                        </li>
                        <li class="submenu-item">
                            <a class="submenu-link {{ request()->segment(1) == 'testimoni' ? 'active' : '' }}"
                                href="{{ route('testimoni') }}">
                                Testimoni (Home)
                            </a>
                        </li>
                        <li class="submenu-item">
                            <a class="submenu-link {{ request()->segment(1) == 'fitur' ? 'active' : '' }}"
                                href="{{ route('fitur') }}">
                                Fitur (Home)
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif

    </ul>
</nav>

<div class="app-sidepanel-footer">
    <nav class="app-nav app-nav-footer">
        <ul class="app-menu footer-menu list-unstyled">

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(1) == 'profile' ? 'active' : '' }}"
                    href="{{ route('profile.edit') }}">
                    <span class="nav-icon">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z" />
                            <path fill-rule="evenodd"
                                d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z" />
                        </svg>
                    </span>
                    <span class="nav-link-text">Pengaturan Akun</span>
                </a>
            </li>

            <li class="nav-item">
                <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                <a class="nav-link" href="{{ url('/license') }}">
                    <span class="nav-icon">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-person"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12 1H4a1 1 0 0 0-1 1v10.755S4 11 8 11s5 1.755 5 1.755V2a1 1 0 0 0-1-1zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z" />
                            <path fill-rule="evenodd" d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                        </svg>
                    </span>
                    <span class="nav-link-text">License</span>
                </a>
            </li>

        </ul>
    </nav>
</div>
