<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        $data = $request->except('_token', 'site_logo');

        // Handle site logo upload
        if ($request->hasFile('site_logo')) {
            $logo = $request->file('site_logo');
            $logoPath = $logo->store('settings', 'public');
            
            $setting = Setting::firstOrNew(['key' => 'site_logo']);
            $setting->value = $logoPath;
            $setting->save();
        }

        foreach ($data as $key => $value) {
            if ($value !== null) {
                $setting = Setting::firstOrNew(['key' => $key]);
                $setting->value = $value;
                $setting->save();
            }
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
