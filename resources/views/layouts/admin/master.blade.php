<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
    <head>
        <meta charset="utf-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ config('app.name') }} | @yield('title', 'Dashboard')</title>
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{ asset('admin/css/font-awesome.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('admin/css/adminlte.min.css') }}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">
        <!-- bootstrap rtl -->
        <link rel="stylesheet" href="{{ asset('admin/css/bootstrap-rtl.min.css') }}">
        <!-- template rtl version -->
        <link rel="stylesheet" href="{{ asset('admin/css/custom-style.css') }}">
        @yield('style')
    </head>
    <body class="hold-transition sidebar-mini">

        <div class="wrapper">
            @include('layouts.admin.__navbar')

            @include('layouts.admin.__sidebar')

            <div id="app" class="content-wrapper"> 
                @include('layouts.admin.__breadcrumbs')
                <section class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </section>        
            </div> 

        </div>
        <!-- ========================================================== -->
        <script>
            const baseData = {
                url: "{{ url('/') }}",
                lang: '{{ LaravelLocalization::getCurrentLocale() }}',
            }
        </script>
        <script src="{{ asset('admin/app.js') }}"></script>
        <script src="{{ asset('admin/js/sweatalert.min.js') }}"></script>
        @yield('script')
        <script src="{{ asset('admin/js/custom.js') }}"></script>
    </body>
</html>