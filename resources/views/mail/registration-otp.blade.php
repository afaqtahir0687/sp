<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration OTP</title>
    <style>
        body {
            font-family: 'Poppins', 'Open Sans', Helvetica, Arial, sans-serif;
            background-color: #f4f4f7;
            color: #51545e;
            margin: 0;
            padding: 0;
            width: 100% !important;
            -webkit-text-size-adjust: none;
        }
        .wrapper {
            width: 100%;
            background-color: #f4f4f7;
            padding: 40px 0;
        }
        .content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .header {
            background-color: #ffffff;
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid #f0f0f0;
        }
        .header img {
            max-width: 150px;
            height: auto;
        }
        .body {
            padding: 40px;
            line-height: 1.6;
        }
        .greeting {
            font-size: 24px;
            font-weight: 700;
            color: #333333;
            margin-bottom: 20px;
        }
        .message {
            font-size: 16px;
            color: #51545e;
            margin-bottom: 30px;
        }
        .otp-container {
            background-color: rgba(233, 29, 142, 0.05);
            border: 2px dashed #e91d8e;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            margin-bottom: 30px;
        }
        .otp-code {
            font-size: 42px;
            font-weight: 800;
            color: #e91d8e;
            letter-spacing: 12px;
            margin: 0;
            padding-left: 12px; /* To center because of letter-spacing on last char */
        }
        .expiry-notice {
            font-size: 14px;
            color: #74787e;
            text-align: center;
            margin-bottom: 20px;
        }
        .footer {
            padding: 30px;
            text-align: center;
            background-color: #f9f9f9;
            font-size: 12px;
            color: #999999;
        }
        .footer p {
            margin: 5px 0;
        }
        @media only screen and (max-width: 600px) {
            .content {
                width: 100% !important;
                border-radius: 0;
            }
            .body {
                padding: 25px;
            }
            .otp-code {
                font-size: 32px;
                letter-spacing: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="content">
            <div class="header">
                @if(config('app.logo'))
                    <img src="{{ asset('storage/app/public/' . config('app.logo')) }}" alt="{{ config('app.name', 'Smart Print') }}">
                @else
                    <img src="{{ asset('assets/images/logo.png') }}" alt="{{ config('app.name', 'Smart Print') }}">
                @endif
            </div>
            <div class="body">
                <div class="greeting">Hello {{ $first_name }}!</div>
                <div class="message">
                    Thank you for registering with <strong>Printing Press</strong>. Please use the following One-Time Password (OTP) to verify your account and complete your registration.
                </div>
                
                <div class="otp-container">
                    <h1 class="otp-code">{{ $otp }}</h1>
                </div>
                
                <div class="expiry-notice">
                    This code will expire in <strong>10 minutes</strong>.
                </div>
                
                <div class="message">
                    If you did not create an account, no further action is required.
                </div>
            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} Smart Print. All rights reserved.</p>
                <p>If you have any questions, please contact our support team.</p>
            </div>
        </div>
    </div>
</body>
</html>

