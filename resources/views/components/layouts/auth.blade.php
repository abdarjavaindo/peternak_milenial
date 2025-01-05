<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="PT Abdar Java Indo">
    <meta name="author" content="PT Abdar Java Indo">
    <link rel="shortcut icon" href="favicon.ico">

    <title>{{ config('app.name', 'Laravel Starter Kit') }}</title>

    <!-- FontAwesome JS-->
    <script defer src="{{ asset('assets') }}/plugins/fontawesome/js/all.min.js"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="{{ asset('assets') }}/css/portal.css">

    {!! ReCaptcha::htmlScriptTagJsApi() !!}
</head>
{{ $slot }}

</html>
