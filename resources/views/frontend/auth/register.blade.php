@extends('frontend.layouts.master')
@section('title', __('auth.register'))

@section('content')
    <style>
        .register-page-header {
            background-color: #f8f9fa;
            padding: 40px 0;
            margin-bottom: 0;
            border-bottom: 1px solid #e9ecef;
        }
        .register-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .register-card:hover {
            transform: translateY(-5px);
        }
        .register-card .card-body {
            padding: 3rem;
        }
        .register-title {
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }
        .register-subtitle {
            color: #6c757d;
            margin-bottom: 30px;
            font-size: 0.95rem;
        }
        .form-control-custom {
            height: 50px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding-left: 15px;
            font-size: 15px;
            transition: all 0.2s;
        }
        .form-control-custom:focus {
            border-color: #2596be;
            box-shadow: 0 0 0 3px rgba(37, 150, 190, 0.1);
        }
        .btn-custom-primary {
            background-color: #2596be;
            border-color: #2596be;
            color: white;
            height: 50px;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            font-size: 16px;
            box-shadow: 0 4px 6px rgba(37, 150, 190, 0.2);
            transition: all 0.3s;
        }
        .btn-custom-primary:hover {
            background-color: #d61c84;
            border-color: #d61c84;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(37, 150, 190, 0.3);
            color: white;
        }
        .form-label-custom {
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 8px;
            font-size: 14px;
        }
        .required-asterisk {
            color: #e53e3e;
        }
        .login-link-group {
            margin-top: 25px;
            text-align: center;
            font-size: 14px;
            color: #718096;
        }
        .signin-link-custom {
            color: #2596be;
            font-weight: 600;
            text-decoration: none;
        }
        .signin-link-custom:hover {
            text-decoration: underline;
        }
        
        /* Password Validation Styles */
        .password-requirements {
            margin-top: 15px;
            padding: 15px;
            background-color: #f8fafc;
            border-radius: 8px;
            border: 1px solid #edf2f7;
        }
        .requirement-item {
            font-size: 13px;
            color: #718096;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            transition: all 0.2s;
        }
        .requirement-item i {
            margin-right: 8px;
            font-size: 12px;
            width: 15px;
            text-align: center;
        }
        .requirement-item.valid {
            color: #38a169;
            font-weight: 500;
        }
        .requirement-item.valid i {
            color: #38a169;
        }
        .requirement-item.invalid {
            color: #e53e3e;
        }
        .requirement-item.invalid i {
            color: #e53e3e;
        }

        /* Custom File Input Styling Fix */
        .custom-file-label {
            height: 50px;
            display: flex;
            align-items: center;
            padding-left: 15px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
        .custom-file-label::after {
            height: 100%;
            display: flex;
            align-items: center;
            padding: 0 15px;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
            background-color: #f8f9fa;
            color: #4a5568;
            content: "Browse";
        }
        .custom-file-input:focus ~ .custom-file-label {
            border-color: #2596be;
            box-shadow: 0 0 0 3px rgba(37, 150, 190, 0.1);
        }

        /* Password Toggle */
        .password-toggle-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #718096;
            z-index: 10;
        }
        .password-toggle-icon:hover {
            color: #2596be;
        }

        /* RTL Fixes for Arabic */
        html[dir="rtl"] .form-control-custom {
            padding-left: 15px;
            padding-right: 15px;
            text-align: right;
        }

        html[dir="rtl"] .password-toggle-icon {
            right: auto;
            left: 15px;
        }

        html[dir="rtl"] .form-label-custom {
            text-align: right;
        }

        html[dir="rtl"] .register-title,
        html[dir="rtl"] .register-subtitle {
            text-align: right;
        }

        html[dir="rtl"] .requirement-item i {
            margin-right: 0;
            margin-left: 8px;
        }

        html[dir="rtl"] .custom-file-label {
            padding-left: 15px;
            padding-right: 15px;
        }

        html[dir="rtl"] .custom-file-label::after {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        html[dir="rtl"] .breadcrumb-item + .breadcrumb-item::before {
            float: right;
            padding-right: 0.5rem;
            padding-left: 0;
            content: var(--bs-breadcrumb-divider, "/");
        }

        html[dir="rtl"] .breadcrumb-item {
            float: right;
        }
    </style>

    <div class="page-header register-page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('login') }}">{{ __('auth.login') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('auth.register') }}</li>
                    </ol>
                </div>
            </nav>
            <h1>{{ __('auth.create_account') }}</h1>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">
                <div class="card register-card">
                    <div class="card-body">
                        <div class="text-center">
                            @if(config('app.logo'))
                                <img src="{{ asset('storage/app/public/' . config('app.logo')) }}" alt="{{ config('app.name', 'Printing Press') }}" style="max-width: 120px; margin: 0 auto 20px auto; display: block;">
                            @else
                                <img src="{{ asset('assets/images/logo.png') }}" alt="{{ config('app.name', 'Printing Press') }}" style="max-width: 120px; margin: 0 auto 20px auto; display: block;">
                            @endif
                            <h2 class="register-title">{{ __('auth.register') }}</h2>
                            <p class="register-subtitle">{{ __('auth.create_account_to_get_started') }}</p>
                        </div>

                        <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="first_name" class="form-label-custom">
                                            {{ __('auth.first_name') }} <span class="required-asterisk">*</span>
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-custom @error('first_name') is-invalid @enderror"
                                               id="first_name"
                                               name="first_name"
                                               value="{{ old('first_name') }}"
                                               required
                                               autocomplete="given-name"
                                               placeholder="{{ __('auth.first_name') }}"
                                               autofocus />
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="last_name" class="form-label-custom">
                                            {{ __('auth.last_name') }} <span class="required-asterisk">*</span>
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-custom @error('last_name') is-invalid @enderror"
                                               id="last_name"
                                               name="last_name"
                                               value="{{ old('last_name') }}"
                                               required
                                               placeholder="{{ __('auth.last_name') }}"
                                               autocomplete="family-name" />
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="email" class="form-label-custom">
                                    {{ __('auth.email') }} <span class="required-asterisk">*</span>
                                </label>
                                <input type="email"
                                       class="form-control form-control-custom @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required
                                       placeholder="{{ __('auth.enter_email') }}"
                                       autocomplete="email" />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="image" class="form-label-custom">{{ __('auth.profile_image') }} ({{ __('auth.optional') }})</label>
                                <div class="custom-file">
                                    <input type="file"
                                           class="custom-file-input @error('image') is-invalid @enderror"
                                           id="image"
                                           name="image"
                                           accept="image/*">
                                    <label class="custom-file-label form-control-custom d-flex align-items-center" for="image" style="padding-top: 0; padding-bottom: 0;">{{ __('auth.choose_file') }}</label>
                                </div>
                                @error('image')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="password" class="form-label-custom">
                                    {{ __('auth.password') }} <span class="required-asterisk">*</span>
                                </label>
                                <div class="position-relative">
                                    <input type="password"
                                           class="form-control form-control-custom @error('password') is-invalid @enderror"
                                           id="password"
                                           name="password"
                                           required
                                           placeholder="{{ __('auth.create_a_password') }}"
                                           autocomplete="new-password"
                                           style="padding-right: 40px;" />
                                    <span class="password-toggle-icon" onclick="togglePasswordVisibility('password', this)">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="password-requirements">
                                    <p class="mb-2 font-weight-bold" style="font-size: 13px; color: #4a5568;">{{ __('auth.password_requirements') }}</p>
                                    <div class="requirement-item" id="req-length">
                                        <i class="fas fa-circle"></i> {{ __('auth.at_least_8_characters') }}
                                    </div>
                                    <div class="requirement-item" id="req-upper">
                                        <i class="fas fa-circle"></i> {{ __('auth.at_least_one_uppercase') }}
                                    </div>
                                    <div class="requirement-item" id="req-lower">
                                        <i class="fas fa-circle"></i> {{ __('auth.at_least_one_lowercase') }}
                                    </div>
                                    <div class="requirement-item" id="req-number">
                                        <i class="fas fa-circle"></i> {{ __('auth.at_least_one_number') }}
                                    </div>
                                    <div class="requirement-item" id="req-special">
                                        <i class="fas fa-circle"></i> {{ __('auth.at_least_one_special') }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="password-confirm" class="form-label-custom">
                                    {{ __('auth.confirm_password') }} <span class="required-asterisk">*</span>
                                </label>
                                <div class="position-relative">
                                    <input type="password"
                                           class="form-control form-control-custom"
                                           id="password-confirm"
                                           name="password_confirmation"
                                           required
                                           placeholder="{{ __('auth.confirm_your_password') }}"
                                           autocomplete="new-password"
                                           style="padding-right: 40px;" />
                                    <span class="password-toggle-icon" onclick="togglePasswordVisibility('password-confirm', this)">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group mt-5">
                                <button type="submit" class="btn btn-custom-primary btn-block" id="register-btn">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" id="register-spinner"></span>
                                    <span class="btn-text">{{ __('auth.create_account') }}</span>
                                </button>
                            </div>

                            <div class="login-link-group">
                                <p class="mb-0">
                                    {{ __('auth.already_have_account') }}
                                    <a href="{{ route('login') }}" class="signin-link-custom">{{ __('auth.sign_in') }}</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function togglePasswordVisibility(inputId, iconSpan) {
            const input = document.getElementById(inputId);
            const icon = iconSpan.querySelector('i');
            
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // File input label update
            var fileInput = document.getElementById('image');
            if(fileInput) {
                fileInput.addEventListener('change', function(e) {
                    var fileName = e.target.files[0] ? e.target.files[0].name : 'Choose file...';
                    var nextSibling = e.target.nextElementSibling;
                    nextSibling.innerText = fileName;
                });
            }

            // Password Validation Logic
            const passwordInput = document.getElementById('password');
            const reqLength = document.getElementById('req-length');
            const reqUpper = document.getElementById('req-upper');
            const reqLower = document.getElementById('req-lower');
            const reqNumber = document.getElementById('req-number');
            const reqSpecial = document.getElementById('req-special');

            function updateRequirement(element, isValid) {
                const icon = element.querySelector('i');
                if (isValid) {
                    element.classList.add('valid');
                    element.classList.remove('invalid');
                    icon.classList.remove('fa-circle', 'fa-times-circle');
                    icon.classList.add('fa-check-circle');
                } else {
                    element.classList.remove('valid');
                    // Only add invalid class if user has typed something
                    if(passwordInput.value.length > 0) {
                         element.classList.add('invalid');
                         icon.classList.remove('fa-circle', 'fa-check-circle');
                         icon.classList.add('fa-times-circle');
                    } else {
                        element.classList.remove('invalid');
                        icon.classList.remove('fa-check-circle', 'fa-times-circle');
                        icon.classList.add('fa-circle');
                    }
                }
            }

            if(passwordInput) {
                passwordInput.addEventListener('input', function() {
                    const value = this.value;

                    // Length Check
                    updateRequirement(reqLength, value.length >= 8);

                    // Uppercase Check
                    updateRequirement(reqUpper, /[A-Z]/.test(value));

                    // Lowercase Check
                    updateRequirement(reqLower, /[a-z]/.test(value));

                    // Number Check
                    updateRequirement(reqNumber, /[0-9]/.test(value));

                    // Special Character Check
                    updateRequirement(reqSpecial, /[!@#$%^&*(),.?":{}|<>]/.test(value));
                });
            }

        // Register Button Loader
        const registerForm = document.querySelector('.register-card form');
        const registerBtn = document.getElementById('register-btn');
        const registerSpinner = document.getElementById('register-spinner');
        const btnText = registerBtn ? registerBtn.querySelector('.btn-text') : null;

        if (registerForm && registerBtn) {
            registerForm.addEventListener('submit', function(e) {
                if (this.checkValidity()) {
                    registerBtn.disabled = true;
                    registerSpinner.classList.remove('d-none');
                    if (btnText) btnText.textContent = 'Creating Account...';
                }
            });
        }
    });
    </script>
    @endpush
@endsection

