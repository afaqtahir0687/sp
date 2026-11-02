<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thank You for Contacting Us</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 20px; background-color: #f7f7f7;">
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <div style="text-align: center; margin-bottom: 25px;">
            @include('mail.partials.logo')
        </div>

        <h2 style="color: #25A6D9; margin-top: 0;">Thank You for Contacting Us!</h2>
        <p>Dear <strong>{{ $messageData['name'] }}</strong>,</p>
        <p>Thank you for reaching out to us. We have received your message and our team will get back to you as soon as possible.</p>

        <div style="background: #f4f6f8; padding: 20px; border-radius: 6px; border-left: 4px solid #25A6D9; margin: 20px 0;">
            <p style="margin: 0 0 10px 0;"><strong>Your Message Details:</strong></p>
            <p style="margin: 0 0 5px 0;"><strong>Name:</strong> {{ $messageData['name'] }}</p>
            <p style="margin: 0 0 10px 0;"><strong>Email:</strong> {{ $messageData['email'] }}</p>
            <p style="margin: 0 0 5px 0;"><strong>Message:</strong></p>
            <p style="margin: 0; white-space: pre-line; color: #555;">{{ $messageData['message'] }}</p>
        </div>

        <p>If your inquiry is urgent, please feel free to reach out to us directly through our website contact information.</p>

        <p style="margin-top: 30px; margin-bottom: 0;">Best regards,<br><strong>{{ config('app.name', 'New Sign Advertising') }} Team</strong></p>
    </div>
</body>
</html>
