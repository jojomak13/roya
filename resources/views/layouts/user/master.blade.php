<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#1976D2">
    <meta name="description" content="{{ __('app.description') }}">
    <meta name="tags" content="{{ __('app.tags') }}">
    <title>@yield('title',  __('user.title.home') ) - @lang('app.name')</title>
    <link rel="favicon" href="{{ asset('./favicon.ico') }}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    @if(LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    @else
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,400i,600" rel="stylesheet">
    @endif
    <link rel="stylesheet" href="{{ asset('user/css/main.css') }}">
    @if(LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
    <link rel="stylesheet" href="{{ asset('user/css/rtl.css') }}">
    @endif
</head>

<body>
    @include('layouts.user._header')
    @include('layouts.user._navbar')
    
    @yield('content')
    
    @include('layouts.user._footer')
    
    <!-- ============================= -->
    <script>
        const baseData = {
            url: '{{ url('/') }}',
            lang: '{{ LaravelLocalization::getCurrentLocale() }}',
            currency: '@lang("user.currency")',
        }
    </script>
    <script src="{{ asset('user/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('user/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('user/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('user/js/sweetalert.min.js') }}"></script>
    @yield('script')
    <script src="{{ asset('user/js/custom.js') }}"></script>
    @include('layouts.user._messages')
</body>

</html>