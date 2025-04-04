@extends($activeTemplate . 'layouts.auth')
@php
  $content = optional(getContent('login.content', true))->data_values;
@endphp
<style>
  .account-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
  }

  /* For Chrome, Safari, Edge, and Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* For Firefox */
  input[type="number"] {
    -moz-appearance: textfield;

  }
</style>
@section('content')
  <section class="account-section"
    style="min-height: 100vh; display: flex; align-items: center; justify-content: center;background-image: url('{{ getImage('assets/images/frontend/login/' . @$content->texture_image_up, '1595x645') }}');">
    <div class="card account-card shadow-lg"
    style="width: 100%; max-width: 500px; padding: 20px; background: #fff; border-radius: 10px; transition: transform 0.3s, box-shadow 0.3s;">
    <div class="text-center">
      <a href="{{ url('/') }}" class="account-logo">
      <img src="{{ getImage(imagePath()['logoIcon']['path'] . '/logo.png') }}" alt="Logo" style="width: 120px;">
      </a>
    </div>
    <form class="account-form mt-5" method="POST" action="{{ route('user.verify.email') }}">
      @csrf
      <div class="form-group">
      <p class="text-center">
      <h4 class="text-center text-secondary">
        Verify your account</h4>
      </p>
      <p class="text-center">@lang('Your email'): <strong>{{ auth()->user()->email }}</strong></p>
      </div>
      <div class="form-group">
      <label class=" text-secondary">@lang('Verification Code : ')</label>
      <input type="number" name="email_verified_code" class="form-control" maxlength="7" id="code" required
        style="border-radius: 5px;">
      </div>

      <div class="form-group mt-4">
      <button type="submit" class="btn btn-primary w-100">@lang('Verify ')</button>
      </div>

    </form>
    <div class="row gy-1 mt-3  d-flex justify-content-center align-items-center">
      <div class="col-12">
      <small>@lang('Please check including your Junk/Spam Folder. If not found, you can')</small>
      <a href="{{ route('user.send.verify.code') }}?type=email" class="text-center text-decoration-none text-primary">
        <button class="btn btn-info text-white ">@lang('Resend code')</button>
      </a>
      @if ($errors->has('resend'))
      <br />
      <small class="text-danger">{{ $errors->first('resend') }}</small>
    @endif
      </div>
    </div>
    </div>
  </section>





@endsection
@push('script')
  <script>
    (function ($) {
    "use strict";
    $('#code').on('input change', function () {
      var xx = document.getElementById('code').value;
      $(this).val(function (index, value) {
      value = value.substr(0, 7);
      return value.replace(/\W/gi, '').replace(/(.{3})/g, '$1 ');
      });

    });
    })(jQuery)
  </script>
@endpush