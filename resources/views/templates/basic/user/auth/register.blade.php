@extends($activeTemplate . 'layouts.auth')
@section('style')

@endsection
@push('style')
<style>
.container-fluid {
    margin: 0 auto;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.title-header {
    font-size: 32px;
    font-weight: bold;
    text-align: center;
}


.form-control {
    display: block;
    width: 100%;
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: var(--bs-body-color);
    background-color: var(--bs-body-bg);
    background-clip: padding-box;
    border: var(--bs-border-width) solid var(--bs-border-color);
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    height: 45px;
    border-radius: var(--bs-border-radius);
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out
}

.error-message {
    color: red;
    font-size: 12px;
    margin-top: 5px;
}

/* Responsive styling */
@media (max-width: 767px) {
    .col-lg-6 {
        width: 100%;
    }

    .logo-img {
        width: 150px;
    }
}

/* For red border on error */
.invalid {
    border-color: red !important;
}

/* Styling for buttons */
.btn-register {
    padding: 12px;
    border: none;
    font-size: 16px;
    cursor: pointer;
    width: 129px;
    background: linear-gradient(6.43deg, #00E8DB -18.08%, #095450 121.1%);
    box-shadow: 0px 4px 55px 0px #0000001F;
    color: white;
    border-radius: 70px;
}

.btn-register:hover {
    background: linear-gradient(6.43deg, #00E8DB -18.08%, #095450 121.1%);
    color: white;
}

/* Mobile Code Styling */
.input-group-text {
    background-color: #f8f9fa;
    border-right: none;
    height: 45px;
}

input[type="checkbox"] {
    margin-top: 5px;
}

/* Style for the eye icon */
.input-group-text {
    cursor: pointer;
    padding: 0.5rem;
    background-color: #f8f9fa;
    height: 45px;
}

.input-group-text i {
    font-size: 1.2rem;
}

.error-message {
    color: red;
    font-size: 0.875rem;
}

/* Style the Select2 dropdown input */
.select2-container .select2-selection--single {
    height: 40px !important;
    line-height: 40px !important;
    border: 1px solid #ced4da;
    border-radius: 4px;
    padding: 0 10px;
}

.select2-container .select2-selection--single .select2-selection__placeholder {
    line-height: 40px !important;
}

.select2-container .select2-selection--single .select2-selection__arrow {
    height: 40px;
}

.select2-container .select2-results__option {
    padding: 10px;
}
</style>
@endpush
@section('content')
<div class="container-fluid  px-md-4 pb-5 d-flex justify-content-center align-items-center vh-100 "
    style="background: url('{{asset('assets/admin/images/1.jpg')}}');">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-lg-6 col-xl-6 col-sm-12 card"
            style=" border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
            <div class="d-flex justify-content-center mt-4">
                <a href="{{ URL('/') }}">
                    <img height="50px" class="logo-img mb-4 mt-4" src="{{ asset('assets/images/ceeyit_logo.svg') }}"
                        alt="Logo">
                </a>
            </div>
            <h1 class="title-header mb-4 ">Create an Account</h1>
            <form id="registerForm" class="row g-4 register-form" action="{{ route('user.register') }}" method="POST"
                onsubmit="return validateForm();">
                @csrf
                <div class="col-md-6">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control text-input" id="firstName" name="firstname"
                        value="{{ old('firstname') }}" required>
                    <div class="error-message" id="firstNameError"></div>
                </div>
                <div class="col-md-6">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control text-input" id="lastName" name="lastname"
                        value="{{ old('lastname') }}" required>
                    <div class="error-message" id="lastNameError"></div>
                </div>

                <div class="col-md-6">
                    <label for="country" class="form-label">Country</label>
                    <select style="height:40px;" class="form-select text-input searchable-dropdown" id="country"
                        name="country" required>
                        <option value="">Select Country</option>
                        @foreach($countries as $key => $country)
                        <option data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}"
                            data-code="{{ $key }}">{{ __($country->country) }}</option>
                        @endforeach
                    </select>
                    <div class="error-message" id="countryError"></div>
                </div>

                <div class="col-md-6">
                    <label for="mobile" class="form-label">Phone Number</label>
                    <input type="hidden" id="mobile_code" name="mobile_code" value="+234">
                    <div class="input-group">
                        <span class="input-group-text mobile-code">00</span>
                        <input type="text" class="form-control text-input" id="mobile" name="mobile"
                            value="{{ old('mobile') }}" placeholder="Phone Number" aria-label="Phone Number" required>
                    </div>
                    <div class="error-message" id="mobileError"></div>
                </div>

                <div class="col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control text-input" id="username" name="username"
                        value="{{ old('username') }}" required>
                    <div class="error-message" id="usernameError"></div>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email </label>
                    <input type="email" class="form-control text-input" id="email" name="email"
                        value="{{ old('email') }}" required>
                    <div class="error-message" id="emailError"></div>
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control text-input" id="password" name="password" required>
                        <span class="input-group-text" id="togglePassword">
                            <i class="bi bi-eye-slash" id="passwordIcon"></i> <!-- Eye Icon -->
                        </span>
                    </div>
                    <div class="error-message" id="passwordError"></div>
                </div>

                <div class="col-md-6">
                    <label for="password-confirm" class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control text-input" id="password-confirm"
                            name="password_confirmation" required>
                        <span class="input-group-text" id="toggleConfirmPassword">
                            <i class="bi bi-eye-slash" id="confirmPasswordIcon"></i>
                        </span>
                    </div>
                    <div class="error-message" id="confirmPasswordError"></div>
                </div>

                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                </div>


                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-register">Register Now</button>
                </div>


            </form>
            <div class="text-center bottom-text mt-3 mb-5">
                <span>Already have an Account? </span>
                <a href="{{ route('user.login') }}" class="login-link  ">Login</a>
            </div>
            {{-- <div class="text-center mt-3 mb-5">
                    <button class="btn btn-financial-aid">@lang('Financial Aid')</button>
                </div> --}}
        </div>
    </div>
</div>
@php
$content = optional(getContent('login.content', true))->data_values;
@endphp

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
$(document).ready(function() {
    $('.searchable-dropdown').select2({
        placeholder: "",
        allowClear: true,
        width: '100%',
        minimumInputLength: 1
    });
});


document.addEventListener('DOMContentLoaded', function() {
    // Password and Confirm Password Toggle Visibility
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('password-confirm');
    const passwordIcon = document.getElementById('passwordIcon');
    const confirmPasswordIcon = document.getElementById('confirmPasswordIcon');
    const togglePassword = document.getElementById('togglePassword');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');

    // Toggle password visibility for password field
    togglePassword.addEventListener('click', function() {
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

    // Toggle password visibility for confirm password field
    toggleConfirmPassword.addEventListener('click', function() {
        if (confirmPasswordField.type === 'password') {
            confirmPasswordField.type = 'text';
            confirmPasswordIcon.classList.remove('bi-eye-slash');
            confirmPasswordIcon.classList.add('bi-eye');
        } else {
            confirmPasswordField.type = 'password';
            confirmPasswordIcon.classList.remove('bi-eye');
            confirmPasswordIcon.classList.add('bi-eye-slash');
        }
    });

    // Password Strength Check
    $('#password').on('input', function() {
        let strength = checkPasswordStrength($(this).val());
        $('.password-strength').text(strength);
    });

    // Function to check password strength
    function checkPasswordStrength(password) {
        let strength = 'Weak';
        if (password.length >= 6 && /[A-Z]/.test(password) && /\d/.test(password) && /[@$!%*?&#]/.test(
                password)) {
            strength = 'Strong';
        }
        return strength;
    }

    // Form Submission Validation with reCAPTCHA
    window.submitUserForm = function() {
        var response = grecaptcha.getResponse();
        if (response.length === 0) {
            document.getElementById('g-recaptcha-error').innerHTML =
                '<span class="text-danger">@lang("Captcha field is required.")</span>';
            return false;
        }
        return true;
    };

    // Dynamic Mobile Code Selection Based on Country
    $('select[name=country]').on('change', function() {
        let mobileCode = $('select[name=country] :selected').data('mobile_code');
        let countryCode = $('select[name=country] :selected').data('code');

        $('input[name=country_code]').val(countryCode || '');
        $('input[name=mobile_code]').val(mobileCode || '');
        $('.mobile-code').text('+' + (mobileCode || ''));
    });

    // Password Validation for Secure Password Option
    @if($general -> secure_password)
    $('input[name=password]').on('input', function() {
        secure_password($(this));
    });
    @endif

    // User Check for Email, Mobile, or Username
    $('.checkUser').on('focusout', function() {
        var url = "{{ route('user.checkUser') }}";
        var value = $(this).val();
        var token = '{{ csrf_token() }}';
        var data = {
            _token: token
        };

        if ($(this).attr('name') === 'mobile') {
            var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
            data.mobile = mobile;
        } else if ($(this).attr('name') === 'email') {
            data.email = value;
        } else if ($(this).attr('name') === 'username') {
            data.username = value;
        }

        $.post(url, data, function(response) {
            if (response['data'] && response['type'] === 'email') {
                $('#existModalCenter').modal('show');
            } else if (response['data'] !== null) {
                $(`.${response['type']}Exist`).text(`${response['type']} already exists`);
            } else {
                $(`.${response['type']}Exist`).text('');
            }
        });
    });

});
</script>
@endpush