@extends($activeTemplate . 'layouts.auth')

@php
  $content = getContent('login.content', true)->data_values;
@endphp

<style>
  .account-card {
    width: 100%;
    max-width: 500px;
    padding: 30px;
    background: #ffffff;
    border-radius: 10px;
    transition: transform 0.3s, box-shadow 0.3s;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .account-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
  }

  .form-control {
    border-radius: 8px;
    padding: 10px 12px;
    font-size: 14px;
  }

  .btn {
    border-radius: 8px;
    font-size: 16px;
    padding: 12px;
  }

  label {
    font-weight: 600;
    color: #495057;
  }

  .account-logo img {
    width: 120px;
  }

  .account-section {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-size: cover;
    background-position: center;
  }

  .form-group label {
    margin-bottom: 8px;
    display: block;
  }

  .form-group select,
  .form-group input {
    margin-top: 5px;
  }

  .text-secondary {
    color: #6c757d !important;
  }

  .invalid-feedback {
    display: block;
    font-size: 0.9rem;
    color: #dc3545;
    margin-top: 5px;
  }
</style>

@section('content')
<section class="container-fluid  px-md-4 pb-5 d-flex justify-content-center align-items-center vh-100"
  style="background-image: url('{{asset('assets/admin/images/1.jpg')}}');">
  <div class="card account-card shadow-lg">
    <div class="text-center">
      <a href="{{ url('/') }}" class="account-logo">
        <img src="{{ getImage(imagePath()['logoIcon']['path'] . '/logo.png') }}" alt="Logo">
      </a>
    </div>
    <form class="account-form mt-4" method="POST" action="{{ route('user.password.email') }}">
      @csrf
      <h4 class="text-center text-secondary mb-4">Forgot Your Password?</h4>

      {{-- <div class="form-group">
        <select class="form-control" id="type" name="type">
          <option value="">Select Email or Username</option>
          <option value="email">@lang('Via Email')</option>
          <option value="username">@lang('Via Username')</option>
        </select>
      </div> --}}

      <div class="form-group">
        <label class="my_value"></label>
        <input type="text" class="form-control @error('value') is-invalid @enderror" name="value"
          value="{{ old('value') }}" required placeholder="Enter email or username">
        @error('value')
      <span class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
      </div>

      <button type="submit" class="btn btn-info text-white w-100 mt-3">@lang('Send Reset Code')</button>
    </form>
  </div>
</section>
@endsection

@push('script')
  <script>
    (function ($) {
    "use strict";

    function updateLabel() {
      $('.my_value').text($('select[name=type] option:selected').text());
    }

    updateLabel();

    $('select[name=type]').on('change', function () {
      updateLabel();
    });
    })(jQuery);
  </script>
@endpush