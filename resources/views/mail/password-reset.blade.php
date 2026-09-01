<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset OTP - Smart Print</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
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
        .otp-box {
            background-color: #f8f9fa;
            border: 2px dashed #e91d8e;
            padding: 25px;
            text-align: center;
            margin: 30px 0;
            border-radius: 8px;
        }
        .otp-code {
            font-size: 36px;
            font-weight: 700;
            color: #e91d8e;
            letter-spacing: 8px;
            font-family: 'Courier New', monospace;
        }
        .warning-box {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .footer {
            padding: 30px;
            text-align: center;
            background-color: #f9f9f9;
            font-size: 12px;
            color: #999999;
            border-top: 1px solid #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="content">
            <div class="header">
                @if(config('app.logo'))
                    <img src="{{ asset('storage/app/public/' . config('app.logo')) }}" alt="{{ config('app.name', 'Smart Print') }}" style="max-width: 150px;">
                @else
                    <img src="{{ asset('assets/images/logo.png') }}" alt="{{ config('app.name', 'Smart Print') }}" style="max-width: 150px;">
                @endif
            </div>
            <div class="body">
                <div class="greeting">Password Reset OTP</div>
                
                <div class="message">
                    Hello {{ $user->first_name }},
                </div>

                <div class="message">
                    We received a request to reset your password for your Printing Press account. If you made this request, use the OTP below to reset your password:
                </div>

                <div class="otp-box">
                    <div style="font-size: 14px; color: #666; margin-bottom: 10px;">Your OTP Code:</div>
                    <div class="otp-code">{{ $resetLink }}</div>
                </div>

                <div class="warning-box">
                    <strong>⚠️ Important:</strong> This OTP will expire in 10 minutes. If you didn't request a password reset, please ignore this email and your password will remain unchanged.
                </div>

                <div class="message" style="margin-top: 30px;">
                    If you have any questions or need assistance, feel free to contact our support team.
                </div>
            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} Smart Print. All rights reserved.</p>
                <p>Sent with ❤️ from Smart Print Team.</p>
            </div>
        </div>
    </div>
</body>
</html>

