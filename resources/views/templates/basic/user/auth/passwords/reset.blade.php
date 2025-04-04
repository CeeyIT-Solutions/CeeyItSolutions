@extends($activeTemplate . 'layouts.auth')
@php
  $content = getContent('login.content', true)->data_values;
@endphp

@section('content')
<section class="account-section">
  <div class="account-wrapper">
    <div class="form-container">
      <div class="logo text-center mb-4">
        <a href="{{ url('/') }}">
          <img src="{{ getImage(imagePath()['logoIcon']['path'] . '/logo.png') }}" alt="Logo" class="logo-image">
        </a>
      </div>
      <h3 class="text-center mb-3">@lang('Set New Password')</h3>
      <p class="text-center">
        @lang('Enter your new password below to reset your account password.')
      </p>

      <form class="account-form mt-4" method="POST" action="{{ route('user.password.update') }}">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
          <label for="password" class="form-label">@lang('Password')</label>
          <div class="hover-input-popup">
            <input id="password" type="password" class="form--control @error('password') is-invalid @enderror" name="password" required>
            @if ($general->secure_password)
              <div class="input-popup">
                <p class="error lower">@lang('1 small letter minimum')</p>
                <p class="error capital">@lang('1 capital letter minimum')</p>
                <p class="error number">@lang('1 number minimum')</p>
                <p class="error special">@lang('1 special character minimum')</p>
                <p class="error minimum">@lang('6 character password')</p>
              </div>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label for="password-confirm" class="form-label">@lang('Confirm Password')</label>
          <input id="password-confirm" type="password" class="form--control" name="password_confirmation" required>
        </div>

        <div class="form-group mt-4">
          <button type="submit" class="btn btn--base w-100">@lang('Reset Password')</button>
        </div>
      </form>
    </div>

    <div class="image-container">
      <div class="overlay">
        <h2 class="title text-white">@lang('Reset Your Password to Secure Your Account')</h2>
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

  .form-label {
    font-weight: bold;
    font-size: 14px;
    margin-bottom: 5px;
    display: inline-block;
  }

  .hover-input-popup {
    position: relative;
  }

  .hover-input-popup:hover .input-popup {
    opacity: 1;
    visibility: visible;
  }

  .input-popup {
    position: absolute;
    bottom: 130%;
    left: 50%;
    width: 280px;
    background-color: #1a1a1a;
    color: #fff;
    padding: 20px;
    border-radius: 5px;
    transform: translateX(-50%);
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s;
  }

  .input-popup::after {
    position: absolute;
    content: '';
    bottom: -19px;
    left: 50%;
    margin-left: -5px;
    border-width: 10px;
    border-style: solid;
    border-color: transparent transparent #1a1a1a transparent;
    transform: rotate(180deg);
  }

  .input-popup p {
    padding-left: 20px;
    position: relative;
  }

  .input-popup p.error {
    text-decoration: line-through;
  }

  .input-popup p.error::before {
    content: "\f057";
    color: #ea5455;
  }

  .input-popup p.success::before {
    content: "\f058";
    color: #28c76f;
  }
</style>
@endsection

@push('script')
<script>
  (function ($) {
    "use strict";
    @if ($general->secure_password)
      $('input[name="password"]').on('input', function () {
        secure_password($(this));
      });
    @endif
  })(jQuery);
</script>
@endpush
