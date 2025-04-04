<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> {{ $general->sitename(__($pageTitle)) }}</title>
  @include('partials.seo')
      <!-- OWL CAROUSEL -->
      <link rel="stylesheet" href="{{asset('assets/global/css/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/global/css/owl.theme.default.min.css')}}">
  <!-- OWL CAROUSEL -->
  <!-- bootstrap 5  -->
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/lib/bootstrap.min.css')}}">
  <!-- fontawesome 5  -->
  <link rel="stylesheet" href="{{asset('assets/global/css/all.min.css')}}"> 
  <!-- lineawesome font -->
  <link rel="stylesheet" href="{{asset('assets/global/css/line-awesome.min.css')}}"> 
  <!--  -->
  <link href="{{ asset('assets/global/css/select2.min.css') }}" rel="stylesheet" />
  <!-- slick slider css -->


  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/lib/slick.css')}}">
  
  <!-- main css -->
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/main.css')}}">
  <link rel="stylesheet" href="{{ asset($activeTemplateTrue. 'css/color.php?color='.$general->base_color.'&secondColor='.$general->secondary_color) }}">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">

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

    @include($activeTemplate.'partials.user_header')
    @if(Route::currentRouteName() != 'home')
      @include($activeTemplate.'partials.breadcrumb')
    @endif

    <div class="main-wrapper">
        @yield('content')
    </div>

    @include($activeTemplate.'partials.master_footer')
    
    <script src="{{asset('assets/global/js/jquery-3.6.0.min.js')}}"></script>
    
    <script src="{{asset('assets/global/js/nicEdit.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset($activeTemplateTrue.'js/lib/bootstrap.bundle.min.js')}}"></script>
    <!-- slick slider js -->
    <script src="{{asset($activeTemplateTrue.'js/lib/slick.min.js')}}"></script>
    <!-- scroll animation -->
    <script src="{{asset($activeTemplateTrue.'js/lib/wow.min.js')}}"></script>
    @stack('script-lib')
    <!-- main js -->
    <script src="{{asset($activeTemplateTrue.'js/app.js')}}"></script>
    <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
    
    <!-- <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script> -->
    <!-- owl carousel -->
    <script src="{{ asset('assets/global/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/global/js/owl.carousel.min.js') }}"></script>
   
    @stack('script')

    @include('partials.plugins')

    @include('partials.notify')

    


    <script>
      "use strict";
      bkLib.onDomLoaded(function() {
          $( ".nicEdit" ).each(function( index ) {
              $(this).attr("id","nicEditor"+index);
              new nicEditor({fullPanel : true}).panelInstance('nicEditor'+index,{hasPanel : true});
          });
      });
      
    </script>

    <script>
        (function ($) {
            "use strict";
            $(".langSel").on("change", function() {
                window.location.href = "{{route('home')}}/change/"+$(this).val() ;
            });
        })(jQuery);
    </script>
    </body>
</html>