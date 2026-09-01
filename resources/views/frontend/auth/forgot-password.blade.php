@extends('frontend.layouts.master')
@section('title', __('auth.forgot_password'))

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
    </style>

    <div class="page-header login-page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('header.home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('login') }}">{{ __('auth.login') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('auth.forgot_password') }}</li>
                    </ol>
                </div>
            </nav>
            <h1>{{ __('auth.forgot_password') }}</h1>
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
                            <h2 class="login-title">{{ __('auth.reset_your_password') }}</h2>
                            <p class="login-subtitle">{{ __('auth.enter_email_send_otp') }}</p>
                        </div>

                        <form method="POST" action="{{ route('password.email') }}">
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

                            <div class="form-group">
                                <button type="submit" class="btn btn-custom-primary btn-block" id="send-btn">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" id="send-spinner"></span>
                                    <span class="btn-text">{{ __('auth.send_reset_link') }}</span>
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
            const forgotForm = document.querySelector('.login-card form');
            const sendBtn = document.getElementById('send-btn');
            const sendSpinner = document.getElementById('send-spinner');
            const btnText = sendBtn ? sendBtn.querySelector('.btn-text') : null;

            if (forgotForm && sendBtn) {
                forgotForm.addEventListener('submit', function() {
                    if (this.checkValidity()) {
                        sendBtn.disabled = true;
                        if (sendSpinner) sendSpinner.classList.remove('d-none');
                        if (btnText) btnText.textContent = '{{ __('auth.sending') }}';
                    }
                });
            }

            // Auto-redirect to OTP verification page if success message exists
            @if(session('success'))
                setTimeout(function() {
                    window.location.href = "{{ route('password.verify.otp') }}";
                }, 2000);
            @endif
        });
    </script>
    @endpush
@endsection

