<!-- NEW IMPLEMENTATION -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> {{ $general->sitename(__($pageTitle)) }}</title>
  @include('partials.seo')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">

  @stack('style-lib')

  @stack('style')
  @yield('style')
  <style>
    /* h1 {
      width: 334px;
      height: 27px;
      font-family: 'Nunito', sans-serif;
      font-weight: 600;
      font-size: 38.69px;
      line-height: 52.77px;
      color: #000000;
     
    }

    label {

      height: 7px;
      font-family: 'Nunito', sans-serif;
      font-weight: 700;
      color: #000000;
      font-size: 10px;
      text-wrap: nowrap;
    }

    .form-control {
      height: 39px;
      border-radius: 4.91px;
      border: 0.98px solid #0000001A;
      background-color: #FFFFFF;
    }

    .form-select {
      color: #000000;
    }

    .btn-register {
      background: linear-gradient(180deg, #03BAAF 0%, #06807A 100%);
      border-radius: 50px;
      border: none;
      width: 575px;
      height: 61px;
    }

    .finance-aid-link {
      display: block;
      text-decoration: underline !important;
      text-align: center;
      color: #00000080 !important;
    }

    .login-link {
      text-decoration: none !important;
      color: #06807A;
    }

    span {
      color: #00000080;
      opacity: 60%;
    }

    input[type="text"]::placeholder,
    input[type="email"]::placeholder,
    input[type="password"]::placeholder,
    select::placeholder {
      color: #000000 !important;
      font-size: 9px;
      opacity: 30%
    }

    .form-check-input:checked
      background-color: #4ECDC4;
      border-color: #4ECDC4;
    }

    .form-check-input:focus {
      border-color: #4ECDC4;
      box-shadow: 0 0 0 0.25rem rgba(78, 205, 196, 0.25);
    } */
  </style>
  
</head>

<body>
  @stack('fbComment')
  <div class="preloader">
    <div class="preloader-container">
      <span class="animated-preloader"></span>
    </div>
  </div>

  @yield('content')

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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>