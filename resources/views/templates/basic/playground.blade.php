<!-- layouts home -->
<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> {{ $general->sitename(__($pageTitle)) }}</title>
  @include('partials.seo')
  <!-- bootstrap 5  -->
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/lib/bootstrap.min.css')}}">
  <!-- fontawesome 5  -->
  <link rel="stylesheet" href="{{asset('assets/global/css/all.min.css')}}">
  <!-- lineawesome font -->
  <link rel="stylesheet" href="{{asset('assets/global/css/line-awesome.min.css')}}">
  <!-- slick slider css -->
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/lib/slick.css')}}">
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/lightcase.css')}}">
  <!-- main css -->
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/main.css')}}">

  <link rel="stylesheet" href="{{ asset($activeTemplateTrue. 'css/color.php?color='.$general->base_color.'&secondColor='.$general->secondary_color) }}">
  @stack('style-lib')

  @stack('style')
  @yield('style')
</head>

<body>
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

  @include($activeTemplate.'partials.header')
  @if(Route::currentRouteName() == 'consultation' || Route::currentRouteName() == 'home')

  @else
  @include($activeTemplate.'partials.breadcrumb')
  @endif

  <div class="main-wrapper">
    @yield('content')
  </div>

  @include($activeTemplate.'partials.footer')

  <script src="{{asset('assets/global/js/jquery-3.6.0.min.js')}}"></script>
  <!-- bootstrap js -->
  <script src="{{asset($activeTemplateTrue.'js/lib/bootstrap.bundle.min.js')}}"></script>
  <!-- slick slider js -->
  <script src="{{asset($activeTemplateTrue.'js/lib/slick.min.js')}}"></script>
  <!-- scroll animation -->
  <script src="{{asset($activeTemplateTrue.'js/lib/wow.min.js')}}"></script>
  <script src="{{asset($activeTemplateTrue.'js/lib/lightcase.js')}}"></script>
  <!-- lightcase js -->
  <script src="{{asset($activeTemplateTrue.'js/app.js')}}"></script>
  @stack('script-lib')

  @stack('script')

  @include('partials.plugins')

  @include('partials.notify')

  <script>
    (function($) {
      "use strict";
      $(".langSel").on("change", function() {
        window.location.href = "{{route('home')}}/change/" + $(this).val();
      });
    })(jQuery);
  </script>
</body>

</html>

<!-- layouts auth -->
<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> {{ $general->sitename(__($pageTitle)) }}</title>
  @include('partials.seo')
  <!-- bootstrap 5  -->
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/lib/bootstrap.min.css')}}">
  <!-- fontawesome 5  -->
  <link rel="stylesheet" href="{{asset('assets/global/css/all.min.css')}}">
  <!-- lineawesome font -->
  <link rel="stylesheet" href="{{asset('assets/global/css/line-awesome.min.css')}}">
  <!--  -->

  <!-- slick slider css -->
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/lib/slick.css')}}">

  <!-- main css -->
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/main.css')}}">
  <link rel="stylesheet" href="{{ asset($activeTemplateTrue. 'css/color.php?color='.$general->base_color.'&secondColor='.$general->secondary_color) }}">
  @stack('style-lib')

  @stack('style')
</head>

<body>
  @stack('fbComment')
  <div class="preloader">
    <div class="preloader-container">
      <span class="animated-preloader"></span>
    </div>
  </div>

  <div class="main-wrapper">
    @yield('content')
  </div>


  <script src="{{asset('assets/global/js/jquery-3.6.0.min.js')}}"></script>
  <!-- bootstrap js -->
  <script src="{{asset($activeTemplateTrue.'js/lib/bootstrap.bundle.min.js')}}"></script>
  <!-- slick slider js -->
  <script src="{{asset($activeTemplateTrue.'js/lib/slick.min.js')}}"></script>
  <!-- scroll animation -->
  <script src="{{asset($activeTemplateTrue.'js/lib/wow.min.js')}}"></script>
  <!-- lightcase js -->

  <!-- main js -->
  <script src="{{asset($activeTemplateTrue.'js/app.js')}}"></script>
  @stack('script-lib')

  @stack('script')

  @include('partials.plugins')

  @include('partials.notify')

  <script>
    (function($) {
      "use strict";
      $(".langSel").on("change", function() {
        window.location.href = "{{route('home')}}/change/" + $(this).val();
      });
    })(jQuery);
  </script>
</body>

</html>
<!-- enrolled users-->{{$course->author->totalEnrolled()->count()}}