@extends('frontend.layouts.master')
@section('title', __('auth.login'))

@section('content')
    <style>
        .login-page-header {
            background-color: #f8f9fa;
            padding: 40px 0;
            margin-bottom: 0;
            border-bottom: 1px solid #e9ecef;
        }
        .login-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .login-card:hover {
            transform: translateY(-5px);
        }
        .login-card .card-body {
            padding: 3rem;
        }
        .login-title {
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }
        .login-subtitle {
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
        .forgot-link {
            color: #718096;
            font-size: 13px;
            text-decoration: none;
            transition: color 0.2s;
        }
        .forgot-link:hover {
            color: #2596be;
            text-decoration: underline;
        }
        .register-link-group {
            margin-top: 25px;
            text-align: center;
            font-size: 14px;
            color: #718096;
        }
        .register-link {
            color: #2596be;
            font-weight: 600;
            text-decoration: none;
        }
        .register-link:hover {
            text-decoration: underline;
        }
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            background: none !important;
            background-color: transparent !important;
            border: none !important;
            padding: 0;
            z-index: 10;
            color: #000000 !important;
        }
        #togglePassword {
            background: none !important;
            background-color: transparent !important;
            color: #000000 !important;
        }
        #togglePassword *,
        #togglePassword *::before,
        #togglePassword *::after {
            color: #000000 !important;
            background-color: transparent !important;
            stroke: #000000 !important;
            fill: none !important;
        }
        #togglePassword svg {
            color: #000000 !important;
            background-color: transparent !important;
            stroke: #000000 !important;
        }
        #togglePassword svg path,
        #togglePassword svg line,
        #togglePassword svg circle {
            stroke: #000000 !important;
            fill: none !important;
        }
        #eyeIcon,
        #eyeOffIcon {
            color: #000000 !important;
            background-color: transparent !important;
            stroke: #000000 !important;
        }
        .password-wrapper {
            position: relative;
        }

        /* RTL Fixes for Arabic */
        html[dir="rtl"] .form-control-custom {
            padding-left: 15px;
            padding-right: 15px;
            text-align: right;
        }

        html[dir="rtl"] .password-toggle {
            right: auto;
            left: 15px;
        }

        html[dir="rtl"] .form-label-custom {
            text-align: right;
        }

        html[dir="rtl"] .login-title,
        html[dir="rtl"] .login-subtitle {
            text-align: right;
        }

        html[dir="rtl"] .form-check-input {
            margin-left: 0.5rem;
            margin-right: auto;
        }

        html[dir="rtl"] .form-check-label {
            margin-left: auto;
            margin-right: 0.25rem;
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

    <div class="page-header login-page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('header.home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('auth.login') }}</li>
                    </ol>
                </div>
            </nav>
            <h1>{{ __('auth.login') }} {{ __('header.to') }} {{ __('header.my_account') }}</h1>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="card login-card">
                    <div class="card-body">
                        <div class="text-center">
                            @if(config('app.logo'))
                                <img src="{{ asset('storage/app/public/' . config('app.logo')) }}" alt="{{ config('app.name', 'Printing Press') }}" style="max-width: 120px; margin: 0 auto 20px auto; display: block;">
                            @else
                                <img src="{{ asset('assets/images/logo.png') }}" alt="{{ config('app.name', 'Printing Press') }}" style="max-width: 120px; margin: 0 auto 20px auto; display: block;">
                            @endif
                            <h2 class="login-title">{{ __('auth.welcome_back') }}</h2>
                            <p class="login-subtitle">{{ __('auth.please_enter_details') }}</p>
                        </div>

                        <form method="POST" action="{{ route('login.store') }}">
                            @csrf
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
                                       autocomplete="email"
                                       placeholder="{{ __('auth.enter_email') }}"
                                       autofocus />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="password" class="form-label-custom mb-0">
                                        {{ __('auth.password') }} <span class="required-asterisk">*</span>
                                    </label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="forgot-link">
                                            {{ __('auth.forgot_password_question') }}
                                        </a>
                                    @endif
                                </div>
                                <div class="password-wrapper mt-2">
                                    <input type="password"
                                           class="form-control form-control-custom @error('password') is-invalid @enderror"
                                           id="password"
                                           name="password"
                                           required
                                           placeholder="{{ __('auth.enter_password') }}"
                                           autocomplete="current-password" />
                                    <button type="button" class="password-toggle" id="togglePassword">
                                        <span id="eyeIcon" style="font-size: 20px; color: #000000 !important;">👁</span>
                                        <span id="eyeOffIcon" style="display: none; font-size: 20px; color: #000000 !important;">👁‍🗨</span>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group form-check mb-4">
                                <input type="checkbox"
                                       class="form-check-input"
                                       id="remember"
                                       name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-muted small" for="remember">
                                    {{ __('auth.remember_me') }}
                                </label>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-custom-primary btn-block" id="login-btn">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" id="login-spinner"></span>
                                    <span class="btn-text">{{ __('auth.login_button') }}</span>
                                </button>
                            </div>

                            <div class="register-link-group">
                                <p class="mb-0">
                                    {{ __('auth.dont_have_account') }}
                                    <a href="{{ route('register') }}" class="register-link">{{ __('auth.create_account') }}</a>
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
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.querySelector('.login-card form');
            const loginBtn = document.getElementById('login-btn');
            const loginSpinner = document.getElementById('login-spinner');
            const btnText = loginBtn ? loginBtn.querySelector('.btn-text') : null;

            if (loginForm && loginBtn) {
                loginForm.addEventListener('submit', function() {
                    if (this.checkValidity()) {
                        loginBtn.disabled = true;
                        if (loginSpinner) loginSpinner.classList.remove('d-none');
                        if (btnText) btnText.textContent = '{{ __('auth.signing_in') }}';
                    }
                });
            }

            // Password toggle functionality
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeOffIcon = document.getElementById('eyeOffIcon');

            if (togglePassword && passwordInput && eyeIcon && eyeOffIcon) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

                    // Toggle icons
                    if (type === 'text') {
                        eyeIcon.style.display = 'none';
                        eyeOffIcon.style.display = 'block';
                    } else {
                        eyeIcon.style.display = 'block';
                        eyeOffIcon.style.display = 'none';
                    }
                });
            }
        });
    </script>
    @endpush
@endsection

