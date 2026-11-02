@php
    $logoPath = null;
    if (config('app.logo')) {
        $storagePath = storage_path('app/public/' . config('app.logo'));
        if (file_exists($storagePath)) {
            $logoPath = $storagePath;
        } elseif (file_exists(public_path('storage/' . config('app.logo')))) {
            $logoPath = public_path('storage/' . config('app.logo'));
        }
    }
    if (!$logoPath && file_exists(public_path('assets/images/logo.png'))) {
        $logoPath = public_path('assets/images/logo.png');
    }
@endphp

@if($logoPath && isset($message) && method_exists($message, 'embed'))
    <img src="{{ $message->embed($logoPath) }}" alt="{{ config('app.name', 'New Sign Advertising') }}" style="max-width: 160px; height: auto;">
@elseif(config('app.logo'))
    <img src="{{ asset('storage/' . config('app.logo')) }}" alt="{{ config('app.name', 'New Sign Advertising') }}" style="max-width: 160px; height: auto;">
@else
    <h2 style="color: #25A6D9; margin: 0;">{{ config('app.name', 'New Sign Advertising') }}</h2>
@endif

