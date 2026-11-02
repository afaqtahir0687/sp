<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 20px; background-color: #f7f7f7;">
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <div style="text-align: center; margin-bottom: 20px;">
            @include('mail.partials.logo')
        </div>

        <h2 style="color: #25A6D9; margin-top: 0;">You have received a new message from the Contact Us form:</h2>
        
        <div style="background: #f4f6f8; padding: 20px; border-radius: 6px; border-left: 4px solid #25A6D9; margin: 20px 0;">
            <p style="margin: 0 0 5px 0;"><strong>Name:</strong> {{ $messageData['name'] }}</p>
            <p style="margin: 0 0 10px 0;"><strong>Email:</strong> {{ $messageData['email'] }}</p>
            <p style="margin: 0 0 5px 0;"><strong>Message:</strong></p>
            <p style="margin: 0; white-space: pre-line; color: #555;">{{ $messageData['message'] }}</p>
        </div>

        <br>
        <p style="margin-bottom: 0;">You can view and manage all messages in your <a href="{{ route('admin.contact-messages.index') }}" style="color: #25A6D9;">Admin Panel</a>.</p>
    </div>
</body>
</html>
