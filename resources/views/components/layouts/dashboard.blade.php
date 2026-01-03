<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="author" content="{{ $set_instansi }}">
    <meta name="description" content="{{ $set_deskripsi }}">
    <meta name="keywords" content="{{ $set_keyword }}">
    <link rel="shortcut icon" href="{{ asset('storage/' . $set_ikon) }}">

    <title>{{ $set_judul }}</title>

    <!-- FontAwesome JS-->
    <script defer src="{{ asset('assets') }}/plugins/fontawesome/js/all.min.js"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="{{ asset('assets') }}/css/portal.css">

</head>

<body class="app">
    <header class="app-header fixed-top">
        <div class="app-header-inner">
            <div class="container-fluid py-2">
                <div class="app-header-content">
                    <div class="row justify-content-between align-items-center">
                        <x-navbar-item></x-navbar-item>
                    </div>
                </div>
            </div>
        </div>

        <div id="app-sidepanel" class="app-sidepanel">
            <div id="sidepanel-drop" class="sidepanel-drop"></div>
            <div class="sidepanel-inner d-flex flex-column">
                <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
                <div class="app-branding">
                    <a class="app-logo" href="{{ env('APP_URL') }}">
                        <img style="width: 130px; object-fit: cover;"
                            src="{{ asset('assets') }}/mobirise/images/logo-trans.png" alt="logo">
                        {{-- <span class="logo-text">PETERNAK MILENIAL</span> --}}
                    </a>
                </div>
                <x-sidebar></x-sidebar>
            </div>
        </div>
    </header>

    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                {{ $slot }}
            </div>
        </div>

        {{-- <footer class="app-footer" style="position:absolute; bottom:0;">
            <x-footer></x-footer>
        </footer> --}}
    </div>

    <!-- Javascript -->
    <script src="{{ asset('assets') }}/plugins/popper.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Page Specific JS -->
    <script src="{{ asset('assets') }}/js/app.js"></script>

</body>

</html>
