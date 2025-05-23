<!-- NEW IMPLEMENTATION -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $general->sitename(__($pageTitle)) }}</title>
    @include('partials.seo')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com"> -->
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- slick slider css -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/lib/slick.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/lightcase.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body {
            font-family: 'AtypDisplay', 'Inter', 'sans-serif';
            background-color: white !important;
        }

        /* Navbar Styles */
        .navbar {
            padding: 1rem 2rem;
            background-color: white;
        }

        .nav-link {
            color: #333;
            font-size: 14px;
            font-weight: 500;
            padding: 0.5rem 1.5rem;
        }

        .navbar-nav {
            align-items: center;
        }

        .btn-signup {
            background-color: #00BFA5;
            color: white;
            border-radius: 8px;
            padding: 0.5rem 1.5rem;
        }

        .btn-signup-first {
            width: 129px;
            height: 43px;
            border-radius: 20px;
            background-color: yellow;
        }

        .btn-signup-second {
            width: 152px;
            height: 43px;
            border-radius: 20px;
            background-color: red;
        }

        .btn-signup,
        .btn-get-started {
            background: linear-gradient(to right, #00E8DB 0%, #095450 100%);
            border-radius: 20px;
            border: none;
            /* width: 129px;
            height: 43px; */
            justify-content: center;
            filter: drop-shadow(0, 4, 55, 0#0000001F);
            /* background-color: #04847c; */
        }

        .profile-button {
            background-color: #E6F7F5;
            border-radius: 50px;
            padding: 1rem 1rem;
            border: none;
            white-space: nowrap;
            text-decoration: none;
        }

        .profile-image {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-right: 8px;
        }

        /* Mobile navbar styles */
        @media (max-width: 991px) {
            .navbar-collapse {
                background-color: white;
                padding: 1rem;
                border-radius: 8px;
                margin-top: 1rem;
            }

            .nav-link {
                padding: 0.75rem 1rem;
            }

            .profile-button {
                /* margin-top: 1rem; */
                width: 126px;
                height: 43px;
                border: 1.37 solid #0000000D;
                border-radius: 162px;
                justify-content: center;
                /* display: flex; */
                align-items: center;
            }
        }

        /* Search Section Styles */
        .search-section {
            margin: 2rem auto;
            max-width: 1200px;
        }

        .search-container {
            position: relative;
            margin-bottom: 2rem;
        }

        .search-input {
            border: 1px solid #E0E0E0;
            border-radius: 50px;
            padding: 1rem 1rem 1rem 3rem;
            width: 100%;
            font-size: 14px;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }

        .filter-button {
            background-color: #E6F7F5;
            border: none;
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            color: #059B93;
            font-size: 17.94px;
            font-weight: 500;
        }

        /* Course Card Styles */
        .course-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 2rem;
            height: 100%;
        }

        .course-icon {
            height: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .course-icon i {
            font-size: 48px;
            color: white;
        }

        .card-body {
            background-color: white;
            padding: 1.5rem;
        }

        .course-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .course-stats {
            font-size: 12px;
            color: #666;
            margin-bottom: 1rem;
        }

        .course-rating {
            color: #FFB800;
            font-size: 12px;
            margin-bottom: 1rem;
        }

        .view-course-btn {
            background-color: #00A896;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-size: 12px;
            color: white;
        }

        .nav-link.active {
            font-weight: 600;
            /* Makes current page link bold */
        }

        .view-course-btn {
            float: right;
            /* Aligns button to the right */
            width: 103px;
            height: 29.14;
            font-size: 10.16px;
            border-radius: 13.55px;
            background: linear-gradient(180deg, #00E8DB 0%, #095450 100%);
        }

        .rate {
            color: #302F35;
            font-size: 9px;
            font-weight: bolder
        }

        ::placeholder {
            color: #2C2A31;
            font-size: 18px;
            font-weight: 400;
            opacity: 30%;
            width: 235px;
            height: 13px;
        }

        .profile-span {
            width: 64px;
            height: 18px;
            font-size: 13.74px;
            size: 6.39px;
            color: #2C2A31;
            text-wrap: wrap;
            line-height: 20px !important;
        }

        .profile-i {
            font-size: 6.39px;
            font-weight: 400;
            line-height: 7.99px;
        }

        .profile-text {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .student-label {
            font-size: 12px;
            color: #666;
        }

        span.foot-text {
            font-size: 16px;
            font-weight: lighter;
            margin-left: 45px;
            height: 0px !important;
            line-height: 0px !important;
        }
    </style>
    @stack('style-lib')

    @stack('style')
    @yield('style')
</head>

<body>
    <style>
        .marquee-wrapper {
            background: linear-gradient(to right, #f8f9fa, #f1f3f5);
            /* Light grey blend for white bg */
            overflow: hidden;
            position: relative;
            border: 2px solid #dee2e6;
            padding: 10px 0;
        }

        .marquee-content {
            display: inline-block;
            white-space: nowrap;
            animation: scroll-left 15s linear infinite;
            font-size: 1.5rem;
            font-weight: bolder;
            color: #0d6efd;
            /* Bootstrap primary color */
        }

        @keyframes scroll-left {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(-100%);
            }
        }
    </style>
    {{-- <div class="marquee-wrapper rounded shadow-sm">
    <div class="marquee-content">
      🚀 Big Announcement: Registration for new classes begins 15th May 2025!
      &nbsp;&nbsp;&nbsp; 💡 Sign up now so you can receive an email reminder!
    </div>
  </div> --}}


    @stack('fbComment')
    <div class="preloader">
        <div class="preloader-container">
            <span class="animated-preloader"></span>
        </div>
    </div>

    <!-- scroll-to-top start -->
    <div class="scroll-to-top">
        <span class="scroll-icon">
            <i class="las la-arrow-up"></i>
        </span>
    </div>
    <!-- scroll-to-top end -->

    @include($activeTemplate . 'partials.header')
    @if (Route::currentRouteName() == 'consultation' || Route::currentRouteName() == 'home')
    @else
        @include($activeTemplate . 'partials.breadcrumb')
    @endif

    <div class="main-wrapper">
        @yield('content')
    </div>
    <!-- scroll animation -->
    <script src="{{ asset($activeTemplateTrue . 'js/lib/wow.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/lib/lightcase.js') }}"></script>
    @include($activeTemplate . 'partials.footer')

    @stack('script-lib')

    @stack('script')

    @include('partials.plugins')

    @include('partials.notify')

    <script>
        (function($) {
            "use strict";
            $(".langSel").on("change", function() {
                window.location.href = "{{ route('home') }}/change/" + $(this).val();
            });
        })(jQuery);
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
