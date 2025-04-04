@extends($activeTemplate . 'layouts.auth')
@php
  $content = getContent('login.content', true)->data_values;
@endphp

@section('content')
<section class="account-section">
  <div class="account-wrapper">
    <div class="form-container">
      <div class="logo text-center mb-4">
        <a href="{{url('/')}}">
          <img src="{{ getImage(imagePath()['logoIcon']['path'] . '/logo.png') }}" alt="Logo" class="logo-image">
        </a>
      </div>
      <h3 class="text-center mb-3">@lang('Email Verification')</h3>
      <p class="text-center">
        @lang('We sent a verification code to your email. Please enter the code below to verify your email address.')
      </p>

      <form class="account-form mt-4" method="POST" action="{{ route('user.password.verify.code') }}">
        @csrf
        <div class="form-group">
          <label for="email_verified_code" class="form-label">@lang('Verification Code')</label>
          <input type="number" name="email_verified_code" class="form--control" maxlength="7" id="email_verified_code"
            value="{{ old('email_verified_code') }}" required placeholder="@lang('Enter your code here')"
            autocomplete="off">
        </div>

        <div class="form-group mt-4">
          <button type="submit" class="btn btn--base w-100">@lang('Verify')</button>
        </div>
      </form>

    </div>

    <div class="image-container">
      <div class="overlay">
        <h2 class="title text-white">@lang('Verify Your Email to Get Access')</h2>
      </div>
    </div>
  </div>
</section>

<style>
  .account-section {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background-color: #f4f4f9;
  }

  .account-wrapper {
    display: flex;
    width: 80%;
    max-width: 1200px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
  }

  .form-container {
    flex: 1;
    padding: 40px 30px;
    background: #fff;
  }

  .image-container {
    flex: 1;
    background-image: url('{{ getImage("assets/images/frontend/login/" . @$content->background_image, "1920x1280") }}');
    background-size: cover;
    background-position: center;
    position: relative;
  }

  .overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 20px;
  }

  .logo-image {
    height: 80px;
  }

  .title {
    font-size: 24px;
    line-height: 1.5;
  }

  .form--control {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    margin-top: 8px;
  }

  .btn--base {
    background: #007bff;
    color: #fff;
    padding: 12px;
    border: none;
    border-radius: 6px;
    transition: background 0.3s;
  }

  .btn--base:hover {
    background: #0056b3;
  }

  .text--base {
    color: #007bff;
    text-decoration: none;
  }

  .text--base:hover {
    text-decoration: underline;
  }

  .form-label {
    font-weight: bold;
    font-size: 14px;
    margin-bottom: 5px;
    display: inline-block;
  }
</style>
@endsection

@push('script')
  <script>
    (function ($) {
    "use strict";
    $('#code').on('input change', function () {
      $(this).val(function (index, value) {
      value = value.substr(0, 7);
      return value.replace(/\W/gi, '').replace(/(.{3})/g, '$1 ');
      });
    });
    })(jQuery);
  </script>
@endpush