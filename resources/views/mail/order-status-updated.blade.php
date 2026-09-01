<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status Update</title>
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
            font-size: 22px;
            font-weight: 700;
            color: #333333;
            margin-bottom: 20px;
        }
        .message {
            font-size: 16px;
            color: #51545e;
            margin-bottom: 30px;
        }
        .order-details {
            background-color: #f8fafc;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 30px;
            border: 1px solid #edf2f7;
        }
        .order-number {
            font-size: 18px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 5px;
            display: block;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-pending { background-color: #f6ad55; color: #fff; }
        .status-processing { background-color: #4299e1; color: #fff; }
        .status-completed { background-color: #48bb78; color: #fff; }
        .status-cancelled { background-color: #f56565; color: #fff; }

        .btn-container {
            text-align: center;
            margin: 30px 0;
        }
        .btn {
            display: inline-block;
            background-color: #e91d8e;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 25px;
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
                <div class="greeting">Hi {{ $order->first_name }},</div>
                <div class="message">
                    @if($newStatus == 'processing')
                        Your order is now being processed. We'll notify you once it's completed.
                    @elseif($newStatus == 'completed')
                        Great news! Your order has been completed successfully.
                    @elseif($newStatus == 'cancelled')
                        Your order has been cancelled.
                        @if($order->payment_status == 'refund_pending')
                            <br><br>Since you cancelled within 5 minutes of placing the order, a <strong>75% refund</strong> (with a 25% deduction) has been initiated.
                        @elseif($order->payment_status == 'non_refundable')
                            <br><br>Please note that as per our policy, cancellations made after 5 minutes of order placement are <strong>non-refundable</strong>.
                        @endif
                        <br><br>If this was a mistake, please contact our support team.
                    @else
                        The status of your order has been updated to <strong>{{ ucfirst($newStatus) }}</strong>.
                    @endif
                </div>

                <div class="order-details">
                    <span class="order-number">Order #{{ $order->order_number }}</span>
                    <div style="margin-top: 10px;">
                        Current Status: <span class="status-badge status-{{ $newStatus }}">{{ ucfirst($newStatus) }}</span>
                    </div>
                </div>

                <div class="btn-container">
                    <a href="{{ route('track.order', ['order_number' => $order->order_number]) }}" class="btn" style="color: white">View Order Progress</a>
                </div>
            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} Smart Print. All rights reserved.</p>
                <p>If you have questions, reply to this email or contact support.</p>
            </div>
        </div>
    </div>
</body>
</html>

