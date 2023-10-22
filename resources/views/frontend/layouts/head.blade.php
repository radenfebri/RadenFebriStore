<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Maxa - Multipurpose HTML5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- @vite([]) --}}

    <!-- ========== Page Title ========== -->
    <title>@yield('title')</title>

    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="{{ asset('front') }}/img/favicon.png" type="image/x-icon">

    <!-- ========== Start Stylesheet ========== -->
    <link href="{{ asset('front') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('front') }}/css/font-awesome.min.css" rel="stylesheet" />
    <link href="{{ asset('front') }}/css/themify-icons.css" rel="stylesheet" />
    <link href="{{ asset('front') }}/css/flaticon-set.css" rel="stylesheet" />
    <link href="{{ asset('front') }}/css/elegant-icons.css" rel="stylesheet" />
    <link href="{{ asset('front') }}/css/magnific-popup.css" rel="stylesheet" />
    <link href="{{ asset('front') }}/css/owl.carousel.min.css" rel="stylesheet" />
    <link href="{{ asset('front') }}/css/owl.theme.default.min.css" rel="stylesheet" />
    <link href="{{ asset('front') }}/css/animate.css" rel="stylesheet" />
    <link href="{{ asset('front') }}/css/bootsnav.css" rel="stylesheet" />
    <link href="{{ asset('front') }}/css/style.css" rel="stylesheet">
    <link href="{{ asset('front') }}/css/responsive.css" rel="stylesheet" />
    <!-- ========== End Stylesheet ========== -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">


</head>