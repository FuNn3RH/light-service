<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>
    <link rel="stylesheet" href="{{ vAsset('assets/hoosh/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ vAsset('assets/hoosh/css/style.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ vAsset('assets/hoosh/img/web-icon.png') }}">
    <link rel="manifest" href="<?php echo asset('manifest.json'); ?>">


    @livewireStyles
</head>

<body class="bg-light min-vh-100 d-flex align-items-center justify-content-center">

    {{ $slot }}

    @livewireScripts

    <button id="pwa-btn" class="d-none">نصب برنامه</button>

    <script src="{{ vAsset('assets/hoosh/js/bootstrap.js') }}"></script>
    <script src="{{ vAsset('assets/hoosh/js/app.js') }}"></script>
    <script src="{{ vAsset('assets/hoosh/js/script.js') }}"></script>
</body>

</html>
