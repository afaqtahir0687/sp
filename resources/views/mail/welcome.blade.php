<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Printing Press</title>
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
        .hero-img {
            width: 100%;
            height: auto;
            border-radius: 6px;
            margin-bottom: 30px;
        }
        .message {
            font-size: 16px;
            color: #51545e;
            margin-bottom: 30px;
        }
        .feature-list {
            background-color: #f8fafc;
            border-radius: 6px;
            padding: 25px;
            margin-bottom: 30px;
            border: 1px solid #edf2f7;
        }
        .feature-item {
            display: flex;
            margin-bottom: 15px;
            align-items: center;
        }
        .feature-icon {
            width: 24px;
            height: 24px;
            background-color: #e91d8e;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 12px;
            font-weight: bold;
        }
        .btn-container {
            text-align: center;
            margin: 30px 0;
        }
        .btn {
            display: inline-block;
            background-color: #e91d8e;
            color: #ffffff;
            text-decoration: none;
            padding: 14px 30px;
            border-radius: 5px;
            font-weight: 600;
            font-size: 16px;
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
                <div class="greeting">Welcome to our community, {{ $user->first_name }}! 🎉</div>
                
                <div class="message">
                    We're thrilled to have you with us! Your account has been successfully verified, and you're now part of the <strong>Printing Press</strong> family.
                </div>

                <div class="feature-list">
                    <div style="font-weight: 700; margin-bottom: 15px; font-size: 18px; color: #333;">Getting Started:</div>
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <div>Browse our exclusive categories and products.</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <div>Create and manage your wishlist.</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <div>Track your orders in real-time.</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <div>Enjoy a seamless and secure shopping experience.</div>
                    </div>
                </div>

                <div class="message">
                    Ready to explore? Head over to your dashboard or start shopping now!
                </div>

                <div class="btn-container">
                    <a href="{{ route('dashboard') }}" class="btn" style="color: white">Go to Dashboard</a>
                </div>

                <div class="message" style="margin-top: 30px; font-style: italic;">
                    If you have any questions or need assistance, feel free to reply to this email. We're here to help!
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

