<!DOCTYPE html>
<html>
<head>
    <title>New Contact Message</title>
</head>
<body>
    @if(config('app.logo'))
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="{{ asset('storage/app/public/' . config('app.logo')) }}" alt="{{ config('app.name', 'Printing Press') }}" style="max-width: 150px;">
        </div>
    @else
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="{{ asset('assets/images/logo.png') }}" alt="{{ config('app.name', 'Printing Press') }}" style="max-width: 150px;">
        </div>
    @endif
    <h2>You have received a new message from the Contact Us form:</h2>
    
    <p><strong>Name:</strong> {{ $messageData['name'] }}</p>
    <p><strong>Email:</strong> {{ $messageData['email'] }}</p>
    
    <p><strong>Message:</strong></p>
    <div style="background: #f4f4f4; padding: 15px; border-left: 4px solid #25A6D9;">
        {!! nl2br(e($messageData['message'])) !!}
    </div>

    <br>
    <p>You can view and manage all messages in your <a href="{{ route('admin.contact-messages.index') }}">Admin Panel</a>.</p>
</body>
</html>

