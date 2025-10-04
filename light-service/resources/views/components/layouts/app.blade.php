<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>
    <link rel="stylesheet" href="{{ vAsset('assets/share/css/style.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ vAsset('assets/share/img/web-icon.png') }}">


    @livewireStyles
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

    {{ $slot }}

    @livewireScripts
</body>

</html>
