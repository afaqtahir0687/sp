@extends('frontend.layouts.master')
@section('title', __('auth.verify_otp'))

@section('content')
    <style>
        .otp-page-header {
            background-color: #f8f9fa;
            padding: 40px 0;
            margin-bottom: 0;
            border-bottom: 1px solid #e9ecef;
        }
        .otp-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .otp-card:hover {
            transform: translateY(-5px);
        }
        .otp-card .card-body {
            padding: 3rem;
        }
        .otp-title {
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }
        .otp-subtitle {
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
            text-align: center;
            letter-spacing: 5px;
            font-weight: 700;
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
        .resend-group {
            margin-top: 25px;
            text-align: center;
            font-size: 14px;
            color: #718096;
        }
        .btn-resend-link {
            color: #2596be;
            font-weight: 600;
            text-decoration: none;
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-resend-link:hover {
            text-decoration: underline;
            color: #d61c84;
        }
        .btn-resend-link:disabled {
            color: #a0aec0;
            cursor: not-allowed;
            text-decoration: none;
        }
    </style>

    <div class="page-header otp-page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('auth.verify_otp') }}</li>
                    </ol>
                </div>
            </nav>
            <h1>{{ __('auth.verify_your_email') }}</h1>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="card otp-card">
                    <div class="card-body">
                        <div class="text-center">
                            @if(config('app.logo'))
                                <img src="{{ asset('storage/app/public/' . config('app.logo')) }}" alt="{{ config('app.name', 'Printing Press') }}" style="max-width: 120px; margin: 0 auto 20px auto; display: block;">
                            @else
                                <img src="{{ asset('assets/images/logo.png') }}" alt="{{ config('app.name', 'Printing Press') }}" style="max-width: 120px; margin: 0 auto 20px auto; display: block;">
                            @endif
                            <h2 class="otp-title">{{ __('auth.otp_verification') }}</h2>
                            <p class="otp-subtitle">{{ __('auth.enter_6_digit_code') }}</p>
                        </div>

                        <form method="POST" action="{{ route('otp.verify.store') }}">
                            @csrf
                            <div class="form-group mb-4 text-center">
                                <label for="otp" class="form-label-custom">
                                    {{ __('auth.6_digit_otp_code') }} <span class="required-asterisk">*</span>
                                </label>
                                <input type="text"
                                       class="form-control form-control-custom @error('otp') is-invalid @enderror"
                                       id="otp"
                                       name="otp"
                                       required
                                       maxlength="6"
                                       placeholder="------"
                                       pattern="\d{6}"
                                       autocomplete="one-time-code"
                                       autofocus />
                                @error('otp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-custom-primary btn-block" id="verify-btn">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" id="verify-spinner"></span>
                                    <span class="btn-text">{{ __('auth.verify_otp_button') }}</span>
                                </button>
                            </div>
                        </form>

                        <div class="resend-group">
                            <p class="mb-0">{{ __('auth.didnt_receive_code') }}</p>
                            <form method="POST" action="{{ route('otp.resend') }}">
                                @csrf
                                <button type="submit" class="btn-resend-link" id="resend-btn">
                                    {{ __('auth.resend_otp') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Optional: Simple cooldown for resend button to prevent spam
            const resendBtn = document.getElementById('resend-btn');
            if (resendBtn) {
                // You could add a timer here if needed, but for now just basic styling
            }

            // Auto-focus logic for better UX if needed
            const otpInput = document.getElementById('otp');
            if(otpInput) {
                otpInput.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
            }

            // Verify Button Loader
            const verifyForm = document.querySelector('.otp-card form');
            const verifyBtn = document.getElementById('verify-btn');
            const verifySpinner = document.getElementById('verify-spinner');
            const btnText = verifyBtn ? verifyBtn.querySelector('.btn-text') : null;

            if (verifyForm && verifyBtn) {
                verifyForm.addEventListener('submit', function() {
                    if (this.checkValidity()) {
                        verifyBtn.disabled = true;
                        if (verifySpinner) verifySpinner.classList.remove('d-none');
                        if (btnText) btnText.textContent = '{{ __('auth.verifying') }}';
                    }
                });
            }
        });
    </script>
    @endpush
@endsection

