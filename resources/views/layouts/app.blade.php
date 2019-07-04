<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('storage/misc/wedding-icon.png')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Fonts  -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Icon  -->
    <link href="{{ asset('font/iconsmind/style.css') }}" rel="stylesheet">
    <link href="{{ asset('font/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/vendor/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vendor/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vendor/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vendor/bootstrap-stars.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    

    @yield('style')

</head>
<body id="app-container" class="menu-default show-spinner">

    @yield('content')
    
    <!-- Script -->
    <script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/vendor/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/vendor/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/vendor/progressbar.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('js/dore.script.js') }}"></script>

    @yield('script')

</body>
</html>
