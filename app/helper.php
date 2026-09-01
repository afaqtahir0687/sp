<?php

if (!function_exists('activeRoute')) {
    function activeRoute($route)
    {
        return request()->routeIs($route) ? 'active' : '';
    }
}

if (!function_exists('current_currency')) {
    function current_currency()
    {
        return session()->get('currency', 'SAR');
    }
}

if (!function_exists('get_latest_currency_rates')) {
    function get_latest_currency_rates()
    {
        return cache()->remember('latest_currency_rates', 86400, function() {
            try {
                $response = \Illuminate\Support\Facades\Http::timeout(5)->get('https://open.er-api.com/v6/latest/USD');
                if ($response->successful()) {
                    $data = $response->json();
                    $rates = $data['rates'] ?? [];
                    if (!empty($rates)) {
                        if (isset($rates['SAR'])) {
                            \App\Models\Setting::updateOrCreate(['key' => 'currency_rate_sar'], ['value' => $rates['SAR']]);
                        }
                        if (isset($rates['PKR'])) {
                            \App\Models\Setting::updateOrCreate(['key' => 'currency_rate_pkr'], ['value' => $rates['PKR']]);
                        }
                        return [
                            'USD' => 1.0,
                            'SAR' => (float)($rates['SAR'] ?? 3.75),
                            'PKR' => (float)($rates['PKR'] ?? 280.0),
                        ];
                    }
                }
            } catch (\Exception $e) {
                // Fail silently
            }
            return [
                'USD' => (float)(\App\Models\Setting::where('key', 'currency_rate_usd')->value('value') ?? 1),
                'SAR' => (float)(\App\Models\Setting::where('key', 'currency_rate_sar')->value('value') ?? 3.75),
                'PKR' => (float)(\App\Models\Setting::where('key', 'currency_rate_pkr')->value('value') ?? 280),
            ];
        });
    }
}

if (!function_exists('format_price')) {
    function format_price($price)
    {
        $currency = current_currency();
        
        $rates = get_latest_currency_rates();

        $symbols = [
            'USD' => '$',
            'SAR' => 'SAR ',
            'PKR' => 'Rs ',
        ];

        $rate = $rates[$currency] ?? 1;
        $symbol = $symbols[$currency] ?? '$';

        $converted_price = (float)$price * $rate;

        return $symbol . number_format($converted_price, 2);
    }
}

if (!function_exists('__')) {
    function __($key, $replace = [], $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        
        // Try Laravel's trans function first
        $translation = trans($key, $replace, $locale);
        
        // If it returns the key itself, try JSON files directly
        if ($translation === $key) {
            $jsonFile = resource_path('lang/' . $locale . '.json');
            if (file_exists($jsonFile)) {
                $translations = json_decode(file_get_contents($jsonFile), true);
                if (is_array($translations)) {
                    $keys = explode('.', $key);
                    $value = $translations;
                    foreach ($keys as $k) {
                        if (isset($value[$k])) {
                            $value = $value[$k];
                        } else {
                            return $key;
                        }
                    }
                    
                    // Replace placeholders
                    foreach ($replace as $placeholder => $replacement) {
                        $value = str_replace(':' . $placeholder, $replacement, $value);
                    }
                    
                    return $value;
                }
            }
        }
        
        return $translation;
    }
}

if (!function_exists('getTrans')) {
    function getTrans($key, $translations = [])
    {
        if (empty($translations)) {
            $locale = app()->getLocale();
            $jsonFile = resource_path('lang/' . $locale . '.json');
            if (file_exists($jsonFile)) {
                $translations = json_decode(file_get_contents($jsonFile), true);
            }
        }
        
        if (!is_array($translations)) {
            return $key;
        }
        
        $keys = explode('.', $key);
        $value = $translations;
        
        foreach ($keys as $k) {
            if (isset($value[$k])) {
                $value = $value[$k];
            } else {
                return $key;
            }
        }
        
        return $value;
    }
}
