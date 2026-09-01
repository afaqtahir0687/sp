<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
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
        .header h1 {
            color: #ffffff;
            font-size: 24px;
            margin: 0;
            font-weight: 600;
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
        .tracking-number {
            font-size: 16px;
            color: #4a5568;
            margin-bottom: 20px;
            display: block;
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
            padding: 12px 25px;
            border-radius: 5px;
            font-weight: 600;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #d61c84;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .table th {
            text-align: left;
            border-bottom: 2px solid #edf2f7;
            padding: 10px;
            color: #718096;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }
        .table td {
            border-bottom: 1px solid #edf2f7;
            padding: 10px;
            vertical-align: top;
        }
        .table tr:last-child td {
            border-bottom: none;
        }
        .total-row td {
            font-weight: 700;
            color: #2d3748;
            font-size: 16px;
            border-top: 2px solid #edf2f7;
        }
        .footer {
            padding: 30px;
            text-align: center;
            background-color: #f9f9f9;
            font-size: 12px;
            color: #999999;
            border-top: 1px solid #f0f0f0;
        }
        .address-box {
            margin-top: 30px;
            background: #fff;
            border: 1px solid #e2e8f0;
            padding: 15px;
            border-radius: 5px;
        }
        .address-title {
            font-weight: 700;
            margin-bottom: 10px;
            color: #2d3748;
            display: block;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="content">
            <div class="header">
                @if(config('app.logo'))
                    <img src="{{ asset('storage/app/public/' . config('app.logo')) }}" alt="{{ config('app.name', 'Printing Press') }}" style="max-width: 150px;">
                @else
                    <img src="{{ asset('assets/images/logo.png') }}" alt="{{ config('app.name', 'Printing Press') }}" style="max-width: 150px;">
                @endif
            </div>
            <div class="body">
                <div class="greeting">Hi {{ $order->first_name }},</div>
                <div class="message">
                    Thank you for your order! We've received it and are getting it ready to ship.
                </div>

                <div class="order-details">
                    <span class="order-number">Order #{{ $order->order_number }}</span>
                    <span class="tracking-number">Tracking Number: <strong>{{ $order->order_number }}</strong></span>
                </div>

                <div class="btn-container">
                    <a href="{{ route('track.order', ['order_number' => $order->order_number]) }}" class="btn" style="color: white">Track Your Order</a>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th width="60%">Product</th>
                            <th width="10%">Qty</th>
                            <th width="30%" style="text-align: right;">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                @if($item->product && $item->product->image)
                                    <img src="{{ asset('storage/app/public/' . $item->product->image) }}" alt="{{ $item->product_name }}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px; vertical-align: middle; margin-right: 10px;">
                                @endif
                                <strong style="vertical-align: middle; display: block; margin-bottom: 5px;">{{ $item->product_name }}</strong>
                                @if($item->options)
                                    @php
                                        $itemOptions = is_string($item->options) ? json_decode($item->options, true) : $item->options;
                                    @endphp
                                    @if(is_array($itemOptions))
                                        <div style="font-size: 12px; color: #718096; line-height: 1.4;">
                                        @foreach($itemOptions as $key => $value)
                                            @if(!is_null($value) && $value !== '')
                                                <div style="margin-bottom: 2px;">
                                                    <strong style="text-transform: capitalize; color: #4a5568;">{{ str_replace('_', ' ', $key) }}:</strong> 
                                                    {{ is_array($value) ? implode(', ', $value) : $value }}
                                                </div>
                                            @endif
                                        @endforeach
                                        </div>
                                    @endif
                                @endif
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td style="text-align: right;">{{ format_price($item->price) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" style="text-align: right; padding-top: 20px;">Subtotal:</td>
                            <td style="text-align: right; padding-top: 20px;">{{ format_price($order->subtotal) }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right;">Tax:</td>
                            <td style="text-align: right;">{{ format_price($order->tax) }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right;">Shipping:</td>
                            <td style="text-align: right;">{{ format_price($order->shipping) }}</td>
                        </tr>
                        <tr class="total-row">
                            <td colspan="2" style="text-align: right;">Total:</td>
                            <td style="text-align: right;">{{ format_price($order->grand_total) }}</td>
                        </tr>
                    </tfoot>
                </table>

                <div class="address-box">
                    <span class="address-title">Shipping Address:</span>
                    {{ $order->first_name }} {{ $order->last_name }}<br>
                    {{ $order->address }}<br>
                    {{ $order->city ? $order->city->name : '' }}, {{ $order->state ? $order->state->name : '' }}<br>
                    {{ $order->country ? $order->country->name : '' }} - {{ $order->zip_code }}<br>
                    Phone: {{ $order->phone }}
                </div>
            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} Printing Press. All rights reserved.</p>
                <p>If you have questions, reply to this email or contact support.</p>
            </div>
        </div>
    </div>
</body>
</html>

