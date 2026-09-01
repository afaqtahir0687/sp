<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'status' => 'required',
            'type' => 'required|in:concept,big_sale,promo',
        ]);

        $banner = new Banner();
        $banner->title_en = $request->title_en;
        $banner->title_ar = $request->title_ar;
        $banner->subtitle_en = $request->subtitle_en;
        $banner->subtitle_ar = $request->subtitle_ar;
        $banner->description_en = $request->description_en;
        $banner->description_ar = $request->description_ar;
        $banner->link = $request->link;
        $banner->button_text_en = $request->button_text_en;
        $banner->button_text_ar = $request->button_text_ar;
        $banner->status = $request->status;
        $banner->type = $request->type;
        $banner->discount_amount = $request->discount_amount;
        $banner->discount_text = $request->discount_text;
        
        if ($request->hasFile('image')) {
            $banner->image = $request->file('image')->store('banners', 'public');
        }

        $banner->save();

        return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'status' => 'required',
            'type' => 'required|in:concept,big_sale,promo',
        ]);

        $banner->title_en = $request->title_en;
        $banner->title_ar = $request->title_ar;
        $banner->subtitle_en = $request->subtitle_en;
        $banner->subtitle_ar = $request->subtitle_ar;
        $banner->description_en = $request->description_en;
        $banner->description_ar = $request->description_ar;
        $banner->link = $request->link;
        $banner->button_text_en = $request->button_text_en;
        $banner->button_text_ar = $request->button_text_ar;
        $banner->status = $request->status;
        $banner->type = $request->type;
        $banner->discount_amount = $request->discount_amount;
        $banner->discount_text = $request->discount_text;

        if ($request->hasFile('image')) {
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }
            $banner->image = $request->file('image')->store('banners', 'public');
        }

        $banner->save();

        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully.');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image) {
            Storage::disk('public')->delete($banner->image);
        }
        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully.');
    }
}
