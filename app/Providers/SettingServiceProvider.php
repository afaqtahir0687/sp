<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;
use Illuminate\Support\Facades\Config;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Check if database connection is available and settings table exists
        try {
            if (Schema::hasTable('settings')) {
                $settings = Setting::all()->pluck('value', 'key');

                // Override App Name
                if ($settings->has('site_name') && $settings->get('site_name')) {
                    Config::set('app.name', $settings->get('site_name'));
                }

                if ($settings->has('site_logo') && $settings->get('site_logo')) {
                    Config::set('app.logo', $settings->get('site_logo'));
                }

                // Override SMTP settings if present in database
                if ($settings->has('mail_host') && $settings->get('mail_host')) {
                    Config::set('mail.mailers.smtp.host', $settings->get('mail_host'));
                }
                if ($settings->has('mail_port') && $settings->get('mail_port')) {
                    Config::set('mail.mailers.smtp.port', $settings->get('mail_port'));
                }
                if ($settings->has('mail_username') && $settings->get('mail_username')) {
                    Config::set('mail.mailers.smtp.username', $settings->get('mail_username'));
                }
                if ($settings->has('mail_password') && $settings->get('mail_password')) {
                    Config::set('mail.mailers.smtp.password', $settings->get('mail_password'));
                }
                if ($settings->has('mail_encryption') && $settings->get('mail_encryption')) {
                    Config::set('mail.mailers.smtp.encryption', $settings->get('mail_encryption'));
                }
                if ($settings->has('mail_from_address') && $settings->get('mail_from_address')) {
                    Config::set('mail.from.address', $settings->get('mail_from_address'));
                }
                if ($settings->has('mail_from_name') && $settings->get('mail_from_name')) {
                    Config::set('mail.from.name', $settings->get('mail_from_name'));
                }
            }
        } catch (\Exception $e) {
            // Silently fail if DB is not ready (e.g. during migrations)
        }
    }
}
