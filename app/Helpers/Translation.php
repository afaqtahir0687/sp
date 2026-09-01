<?php

namespace App\Helpers;

class Translation
{
    public static function get($key, $replace = [], $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        
        // Try JSON files
        $jsonFile = resource_path('lang/' . $locale . '.json');
        if (file_exists($jsonFile)) {
            $translations = json_decode(file_get_contents($jsonFile), true);
            if (is_array($translations)) {
                // Support nested keys like "header.home"
                $keys = explode('.', $key);
                $value = $translations;
                foreach ($keys as $k) {
                    if (isset($value[$k])) {
                        $value = $value[$k];
                    } else {
                        return $key; // Key not found
                    }
                }

                // Replace placeholders
                foreach ($replace as $placeholder => $replacement) {
                    $value = str_replace(':' . $placeholder, $replacement, $value);
                }
                
                return $value;
            }
        }
        
        return $key;
    }
}
