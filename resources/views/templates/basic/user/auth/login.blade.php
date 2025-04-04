@extends($activeTemplate . 'layouts.auth')
@php
  $content = optional(getContent('login.content', true))->data_values;
@endphp
@section('style')
  <style>
    /* Center the container vertically and horizontally */
    .vh-100 {
    display: flex;
    justify-content: center;
    align-items: center;
    }

    /* Custom primary button styles */
    .btn-custom-primary {
    background-color: #007bff;
    border: none;
    color: white;
    font-size: 1rem;
    font-weight: bold;
    border-radius: 8px;
    transition: all 0.3s ease;
    }

    .btn-custom-primary:hover {
    background-color: #0056b3;
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
    }

    /* Custom Google button styles */
    .btn-custom-google {
    background-color: #ffffff;
    border: 1px solid #ced4da;
    font-size: 1rem;
    font-weight: bold;
    color: #495057;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    }

    .btn-custom-google:hover {
    background-color: #f8f9fa;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Form inputs styles */
    .text-input {
    border: 1px solid #ced4da;
    padding: 10px;
    font-size: 1rem;
    color: #495057;
    }

    .text-input:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 4px rgba(0, 123, 255, 0.3);
    }

    #passwordIcon:hover {
    cursor: pointer;
    }
  </style>
@endsection
@section('content')
  <div class="container-fluid  px-md-4 pb-5 d-flex justify-content-center align-items-center vh-100 "
    style="background: url('{{asset('assets/admin/images/1.jpg')}}');">
    <div class="row align-items-center" style="max-width: 600px; width: 100%;">
    <!-- Left Column: Login Form -->
    <div class="d-flex flex-column justify-content-center"
      style="background: #ffffff; border-radius: 12px; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15); padding: 2rem;">
      <div class="text-center mb-4">
      <a href="{{URL('/')}}">
        <img class="logo-img" src="{{asset('assets/images/ceeyit_logo.svg')}}" alt="Ceeyit Logo"
        style="max-width: 150px;">
      </a>
      </div>
      <h1 class="title-header text-center mb-4" style="font-size: 2rem; font-weight: bold; color: #343a40;">Sign in to
      continue</h1>
      <form class="row g-4 login-form" method="POST" action="{{ route('user.login')}}"
      onsubmit="return submitUserForm();">
      @csrf
      <div class="col-md-12">
        <label for="username" class="form-label" style="font-weight: 600; color: #495057;">Username or Email</label>
        <input type="email" class="form-control text-input" id="username" name="username"
        placeholder="i.e john@gmail.com" required style="border-radius: 8px;">
      </div>
      <div class="col-md-12 position-relative">
        <label for="password" class="form-label" style="font-weight: 600; color: #495057;">Password</label>
        <div class="input-group">
        <input type="password" class="form-control text-input" id="password" name="password" placeholder="******"
          required style="border-radius: 8px;">
        <span class="input-group-text" id="togglePassword">
          <i class="bi bi-eye-slash" id="passwordIcon"></i>
        </span>
        </div>
      </div>

      <div class="col-12 d-flex justify-content-between align-items-center">
        <div class="form-check">
        <input class="form-check-input" type="checkbox" id="rememberMe">
        <label class="form-check-label" for="rememberMe" style="color: #495057;">Remember me</label>
        </div>
        <a class="forgot-password" href="{{url('password/reset')}}"
        style="color: #007bff; text-decoration: none;">Forgot
        Password?</a>
      </div>
      <div class="col-12 text-center">
        <button type="submit" class="btn btn-primary w-100 py-2 mb-3 btn-custom-primary">Login Now</button>
        {{-- <button type="button" class="btn w-100 py-2 btn-custom-google">
        <img class="me-2" src="{{asset('assets/images/google_image.svg')}}" alt="Google Logo" style="width: 20px;">
        Sign in with Google
        </button> --}}
      </div>
      <div class="text-center mt-3">
        <span style="color: #6c757d;">Not registered yet?</span>
        <a href="{{route('user.register')}}" class="login-link"
        style="color: #007bff; text-decoration: none; font-weight: 600;">Create an Account</a>
      </div>
      </form>
    </div>

    </div>
  </div>


@endsection

@push('script-lib')
  <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
  <!-- Select2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- jQuery -->

  <!-- Select2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- jQuery -->

  <!-- Select2 CSS -->

  <!-- Select2 JS -->

@endpush
@push('script')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
    // Password and Confirm Password Toggle Visibility
    const passwordField = document.getElementById('password');
    const passwordIcon = document.getElementById('passwordIcon');
    const togglePassword = document.getElementById('togglePassword');

    // Toggle password visibility for password field
    togglePassword.addEventListener('click', function () {
      if (passwordField.type === 'password') {
      passwordField.type = 'text';
      passwordIcon.classList.remove('bi-eye-slash');
      passwordIcon.classList.add('bi-eye');
      } else {
      passwordField.type = 'password';
      passwordIcon.classList.remove('bi-eye');
      passwordIcon.classList.add('bi-eye-slash');
      }
    });


    });
  </script>
@endpush