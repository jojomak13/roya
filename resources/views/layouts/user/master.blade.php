<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="{{ __('user.info.description') }}">
    <title>@yield('title',  __('user.title.home') )  - {{ config('app.name') }}</title>
    <link rel="favicon" href="{{ asset('./favicon.icon') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
    <link rel="stylesheet" href="{{ asset('user/css/main.css') }}">
</head>

<body>
    @include('layouts.user._header')
    @include('layouts.user._navbar')

    @yield('content')

    @include('layouts.user._footer')

    <!-- ============================= -->
    <script src="{{ asset('user/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('user/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('user/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('user/js/custom.js') }}"></script>
</body>

</html>