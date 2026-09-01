<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use Illuminate\Http\Request;

class SeoSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seoSettings = SeoSetting::all();
        return view('admin.seo_settings.index', compact('seoSettings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.seo_settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'page_name' => 'required|string|unique:seo_settings,page_name',
            'title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        SeoSetting::create($request->all());

        return redirect()->route('admin.seo-settings.index')->with('success', 'SEO Setting created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Not needed usually, but we can leave it empty or redirect
        return redirect()->route('admin.seo-settings.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SeoSetting $seoSetting)
    {
        return view('admin.seo_settings.edit', compact('seoSetting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SeoSetting $seoSetting)
    {
        $request->validate([
            'page_name' => 'required|string|unique:seo_settings,page_name,' . $seoSetting->id,
            'title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        $seoSetting->update($request->all());

        return redirect()->route('admin.seo-settings.index')->with('success', 'SEO Setting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SeoSetting $seoSetting)
    {
        $seoSetting->delete();

        return redirect()->route('admin.seo-settings.index')->with('success', 'SEO Setting deleted successfully.');
    }
}
