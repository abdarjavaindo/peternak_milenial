<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <meta name="author" content="{{ env('AUTHOR') }}" />
    <meta name="keywords" content="{{ env('KEYWORDS') }}" />
    <meta name="description" content="{{ env('DESCRIPTION') }}" />
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/favicon2.png" /> --}}

    <title>{{ config('app.name', 'Laravel Starter Kit') }}</title>

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets') }}/landrick/css/bootstrap.min.css" id="bootstrap-style" class="theme-opt"
        rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets') }}/landrick/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets') }}/landrick/libs/@iconscout/unicons/css/line.css" type="text/css" rel="stylesheet" />
    <!-- Style Css-->
    <link href="{{ asset('assets') }}/landrick/libs/tiny-slider/tiny-slider.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/landrick/css/style.min.css" id="color-opt" class="theme-opt" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets') }}/landrick/libs/tobii/css/tobii.min.css" rel="stylesheet">

    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<style>
    html,
    body {
        height: 100%;
        margin: 0;
        /* background: #edefea; */
        background: #eeeeee;
        font-family: 'Inter', 'Inter Fallback', system-ui, -apple-system,
            BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif !important;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    footer {
        margin-top: auto;
    }
</style>

<body>
    <!-- Navbar Start -->
    <x-home-navbar></x-home-navbar>
    <!--end header-->
    <!-- Navbar End -->

    {{ $slot }}

    <!-- Footer Start -->
    @if (request()->segment(1) != 'login-new')
        <x-home-footer></x-home-footer>
    @endif
    <!--end footer-->
    <!-- Footer End -->

    <!-- Back to top -->
    <a href="#" onclick="topFunction()" id="back-to-top" class="back-to-top fs-5 bg-warning"><i
            data-feather="arrow-up" class="fea icon-sm icons align-middle"></i></a>
    <!-- Back to top -->

    <!-- javascript -->
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets') }}/landrick/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/landrick/libs/tobii/js/tobii.min.js"></script>
    <!-- SLIDER -->
    <script src="{{ asset('assets') }}/landrick/libs/tiny-slider/min/tiny-slider.js"></script>
    <script src="{{ asset('assets') }}/landrick/js/easy_background.js"></script>
    <!-- Main Js -->
    <script src="{{ asset('assets') }}/landrick/libs/feather-icons/feather.min.js"></script>
    <script src="{{ asset('assets') }}/landrick/js/plugins.init.js"></script>
    <!--Note: All init js like tiny slider, counter, countdown, maintenance, lightbox, gallery, swiper slider, aos animation etc.-->
    <script src="{{ asset('assets') }}/landrick/js/app.js"></script>
    <!--Note: All important javascript like page loader, menu, sticky menu, menu-toggler, one page menu etc. -->
</body>

</html>
