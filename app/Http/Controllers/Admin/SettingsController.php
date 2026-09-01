<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Handle General Settings
        if ($request->has('site_name')) {
            Setting::updateOrCreate(['key' => 'site_name'], ['value' => $request->site_name]);
        }
        if ($request->hasFile('site_logo')) {
            $logoPath = $request->file('site_logo')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'site_logo'], ['value' => $logoPath]);
        }
        if ($request->has('contact_email')) {
            Setting::updateOrCreate(['key' => 'contact_email'], ['value' => $request->contact_email]);
        }
        if ($request->has('contact_phone')) {
            Setting::updateOrCreate(['key' => 'contact_phone'], ['value' => $request->contact_phone]);
        }
        if ($request->has('address')) {
            Setting::updateOrCreate(['key' => 'address'], ['value' => $request->address]);
        }
        if ($request->has('social_facebook')) {
            Setting::updateOrCreate(['key' => 'social_facebook'], ['value' => $request->social_facebook]);
        }
        if ($request->has('social_twitter')) {
            Setting::updateOrCreate(['key' => 'social_twitter'], ['value' => $request->social_twitter]);
        }
        if ($request->has('social_instagram')) {
            Setting::updateOrCreate(['key' => 'social_instagram'], ['value' => $request->social_instagram]);
        }

        // Handle Currency Settings
        if ($request->has('currency_rate_usd')) {
            Setting::updateOrCreate(['key' => 'currency_rate_usd'], ['value' => $request->currency_rate_usd]);
        }
        if ($request->has('currency_rate_sar')) {
            Setting::updateOrCreate(['key' => 'currency_rate_sar'], ['value' => $request->currency_rate_sar]);
        }
        if ($request->has('currency_rate_pkr')) {
            Setting::updateOrCreate(['key' => 'currency_rate_pkr'], ['value' => $request->currency_rate_pkr]);
        }

        // Handle SMTP Settings
        if ($request->has('mail_host')) {
            Setting::updateOrCreate(['key' => 'mail_host'], ['value' => $request->mail_host]);
        }
        if ($request->has('mail_port')) {
            Setting::updateOrCreate(['key' => 'mail_port'], ['value' => $request->mail_port]);
        }
        if ($request->has('mail_username')) {
            Setting::updateOrCreate(['key' => 'mail_username'], ['value' => $request->mail_username]);
        }
        if ($request->has('mail_password')) {
            Setting::updateOrCreate(['key' => 'mail_password'], ['value' => $request->mail_password]);
        }
        if ($request->has('mail_encryption')) {
            Setting::updateOrCreate(['key' => 'mail_encryption'], ['value' => $request->mail_encryption]);
        }
        if ($request->has('mail_from_address')) {
            Setting::updateOrCreate(['key' => 'mail_from_address'], ['value' => $request->mail_from_address]);
        }
        if ($request->has('mail_from_name')) {
            Setting::updateOrCreate(['key' => 'mail_from_name'], ['value' => $request->mail_from_name]);
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
