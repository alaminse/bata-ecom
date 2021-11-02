<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Place favicon.png in the root directory -->
    <link rel="shortcut icon" href="{{ asset('public/frontend/img/favicon.png')}}" type="image/x-icon" />
    <!-- Font Icons css -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/font-icons.css')}}">
    <!-- plugins css -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/plugins.css')}}">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/style.css')}}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/responsive.css')}}">
</head>

<body>
 

    <div class="body-wrapper">
        @include('n_frontend.inc.header')
        @yield('content')
        @include('n_frontend.inc.footer')
    </div>
    <!-- Body main wrapper end -->
    
        <!-- preloader area start -->
        <div class="preloader d-none" id="preloader">
            <div class="preloader-inner">
                <div class="spinner">
                    <div class="dot1"></div>
                    <div class="dot2"></div>
                </div>
            </div>
        </div>
        <!-- preloader area end -->
    
    <!-- All JS Plugins -->
    <script src="{{ asset('public/backend/js/plugins.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('public/backend/js/main.js') }}"></script>
</body>
</html>

