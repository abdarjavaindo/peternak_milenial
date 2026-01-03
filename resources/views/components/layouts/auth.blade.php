<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    {!! ReCaptcha::htmlScriptTagJsApi() !!}
</head>
{{ $slot }}

</html>
