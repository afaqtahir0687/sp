@extends('frontend.layouts.master')
@section('title', __('auth.reset_password'))

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
        .back-link {
            color: #718096;
            font-size: 14px;
            text-decoration: none;
            transition: color 0.2s;
        }
        .back-link:hover {
            color: #2596be;
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
        #togglePassword,
        #toggleConfirmPassword {
            background: none !important;
            background-color: transparent !important;
            color: #000000 !important;
        }
        #togglePassword *,
        #togglePassword *::before,
        #togglePassword *::after,
        #toggleConfirmPassword *,
        #toggleConfirmPassword *::before,
        #toggleConfirmPassword *::after {
            color: #000000 !important;
            background-color: transparent !important;
            stroke: #000000 !important;
            fill: none !important;
        }
        #togglePassword svg,
        #toggleConfirmPassword svg {
            color: #000000 !important;
            background-color: transparent !important;
            stroke: #000000 !important;
        }
        #togglePassword svg path,
        #togglePassword svg line,
        #togglePassword svg circle,
        #toggleConfirmPassword svg path,
        #toggleConfirmPassword svg line,
        #toggleConfirmPassword svg circle {
            stroke: #000000 !important;
            fill: none !important;
        }
        #eyeIcon,
        #eyeOffIcon,
        #eyeIconConfirm,
        #eyeOffIconConfirm {
            color: #000000 !important;
            background-color: transparent !important;
            stroke: #000000 !important;
        }
        .password-wrapper {
            position: relative;
        }
    </style>

    <div class="page-header login-page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('header.home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('login') }}">{{ __('auth.login') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('auth.reset_password') }}</li>
                    </ol>
                </div>
            </nav>
            <h1>{{ __('auth.reset_password') }}</h1>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="card login-card">
                    <div class="card-body">
                        <div class="text-center">
                            @if(config('app.logo'))
                                <img src="{{ asset('storage/app/public' . config('app.logo')) }}" alt="{{ config('app.name', 'Printing Press') }}" style="max-width: 120px; margin: 0 auto 20px auto; display: block;">
                            @else
                                <img src="{{ asset('assets/images/logo.png') }}" alt="{{ config('app.name', 'Printing Press') }}" style="max-width: 120px; margin: 0 auto 20px auto; display: block;">
                            @endif
                            <h2 class="login-title">{{ __('auth.create_new_password') }}</h2>
                            <p class="login-subtitle">{{ __('auth.otp_verified_set_new_password') }}</p>
                        </div>

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <div class="form-group mb-4">
                                <label for="password" class="form-label-custom">
                                    {{ __('auth.new_password') }} <span class="required-asterisk">*</span>
                                </label>
                                <div class="password-wrapper">
                                    <input type="password"
                                           class="form-control form-control-custom @error('password') is-invalid @enderror"
                                           id="password"
                                           name="password"
                                           required
                                           placeholder="{{ __('auth.enter_new_password') }}"
                                           autocomplete="new-password" />
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
                                <small class="text-muted mt-2 d-block">
                                    {{ __('auth.password_requirement_text') }}
                                </small>
                            </div>

                            <div class="form-group mb-4">
                                <label for="password_confirmation" class="form-label-custom">
                                    {{ __('auth.confirm_password') }} <span class="required-asterisk">*</span>
                                </label>
                                <div class="password-wrapper">
                                    <input type="password"
                                           class="form-control form-control-custom @error('password_confirmation') is-invalid @enderror"
                                           id="password_confirmation"
                                           name="password_confirmation"
                                           required
                                           placeholder="{{ __('auth.confirm_new_password') }}"
                                           autocomplete="new-password" />
                                    <button type="button" class="password-toggle" id="toggleConfirmPassword">
                                        <span id="eyeIconConfirm" style="font-size: 20px; color: #000000 !important;">👁</span>
                                        <span id="eyeOffIconConfirm" style="display: none; font-size: 20px; color: #000000 !important;">👁‍🗨</span>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-custom-primary btn-block" id="reset-btn">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" id="reset-spinner"></span>
                                    <span class="btn-text">{{ __('auth.reset_password_button') }}</span>
                                </button>
                            </div>

                            <div class="text-center mt-4">
                                <a href="{{ route('login') }}" class="back-link">
                                    ← {{ __('auth.back_to_login') }}
                                </a>
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
            const resetForm = document.querySelector('.login-card form');
            const resetBtn = document.getElementById('reset-btn');
            const resetSpinner = document.getElementById('reset-spinner');
            const btnText = resetBtn ? resetBtn.querySelector('.btn-text') : null;

            if (resetForm && resetBtn) {
                resetForm.addEventListener('submit', function() {
                    if (this.checkValidity()) {
                        resetBtn.disabled = true;
                        if (resetSpinner) resetSpinner.classList.remove('d-none');
                        if (btnText) btnText.textContent = '{{ __('auth.resetting') }}';
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

            // Confirm password toggle functionality
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const eyeIconConfirm = document.getElementById('eyeIconConfirm');
            const eyeOffIconConfirm = document.getElementById('eyeOffIconConfirm');

            if (toggleConfirmPassword && confirmPasswordInput && eyeIconConfirm && eyeOffIconConfirm) {
                toggleConfirmPassword.addEventListener('click', function() {
                    const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    confirmPasswordInput.setAttribute('type', type);

                    // Toggle icons
                    if (type === 'text') {
                        eyeIconConfirm.style.display = 'none';
                        eyeOffIconConfirm.style.display = 'block';
                    } else {
                        eyeIconConfirm.style.display = 'block';
                        eyeOffIconConfirm.style.display = 'none';
                    }
                });
            }
        });
    </script>
    @endpush
@endsection

