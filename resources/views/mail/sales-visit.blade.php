<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Sales Visit Request</title>
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
        .feature-list {
            background-color: #f8fafc;
            border-radius: 6px;
            padding: 25px;
            margin-bottom: 30px;
            border: 1px solid #edf2f7;
        }
        .info-row {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
        }
        .info-label {
            font-weight: bold;
            color: #333;
            min-width: 130px;
            display: inline-block;
        }
        .info-value {
            color: #555;
        }
        .dates-box {
            background-color: #e9ecef;
            border-left: 4px solid #e91d8e;
            padding: 15px 20px;
            border-radius: 4px;
            margin-top: 25px;
        }
        .dates-box ul {
            margin: 10px 0 0 0;
            padding-left: 20px;
            color: #333;
        }
        .dates-box li {
            margin-bottom: 8px;
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
                    <img src="{{ asset('storage/app/public/' . config('app.logo')) }}" alt="{{ config('app.name') }}" style="max-width: 150px;">
                @else
                    <img src="{{ asset('assets/images/logo.png') }}" alt="{{ config('app.name') }}" style="max-width: 150px;">
                @endif
            </div>
            <div class="body">
                <div class="greeting">New Sales Visit Request 🔔</div>
                
                <div class="message">
                    A new request for a sales visit has been submitted on the website. Please find the details below:
                </div>

                <div class="feature-list">
                    <div class="info-row">
                        <div class="info-label">Full Name:</div>
                        <div class="info-value">{{ $data['full_name'] }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Email Address:</div>
                        <div class="info-value"><a href="mailto:{{ $data['email'] }}" style="color: #e91d8e; text-decoration: none;">{{ $data['email'] }}</a></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Mobile Number:</div>
                        <div class="info-value"><a href="tel:{{ $data['mobile_number'] }}" style="color: #e91d8e; text-decoration: none;">{{ $data['mobile_number'] }}</a></div>
                    </div>
                    <div class="info-row" style="margin-bottom: 0;">
                        <div class="info-label">Address:</div>
                        <div class="info-value">{{ $data['address'] }}</div>
                    </div>
                </div>

                @if(!empty($data['message']))
                <div class="message">
                    <strong>Message / Requirements:</strong>
                    <div style="margin-top: 10px; padding: 15px; background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; font-style: italic; color: #4a5568;">
                        "{{ $data['message'] }}"
                    </div>
                </div>
                @endif

                <div class="dates-box">
                    <strong>Preferred Date & Time Slots:</strong>
                    <ul>
                        @foreach($data['preferred_dates'] as $date)
                            <li>{{ \Carbon\Carbon::parse($date)->format('l, F j, Y \a\t g:i A') }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="footer">
                <p>This email was automatically generated from the {{ config('app.name') }} website.</p>
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>

