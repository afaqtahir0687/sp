<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSetting;
use Illuminate\Http\Request;

class ContactSettingController extends Controller
{
    public function index()
    {
        $setting = ContactSetting::first();
        return view('admin.contact_settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'working_hours' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $setting = ContactSetting::first();
        if ($setting) {
            $setting->update($request->all());
        } else {
            ContactSetting::create($request->all());
        }

        return redirect()->back()->with('success', 'Contact settings updated successfully.');
    }
}
