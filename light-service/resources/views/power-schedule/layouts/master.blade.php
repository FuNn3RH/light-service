<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>برنامه خاموشی</title>

    @yield('head-tags')
</head>

<body dir="rtl">
    @yield('inner_content')

    @yield('scripts')
</body>

</html>
