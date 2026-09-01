<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image'  => 'required|image',
            'status' => 'required',
        ]);

        $slider = new Slider();
        if ($request->hasFile('image')) {
            $slider->image = $request->file('image')->store('sliders', 'public');
        }
        $slider->title_en      = $request->title_en;
        $slider->title_ar      = $request->title_ar;
        $slider->subtitle_en   = $request->subtitle_en;
        $slider->subtitle_ar   = $request->subtitle_ar;
        $slider->offer_text_en = $request->offer_text_en;
        $slider->offer_text_ar = $request->offer_text_ar;
        $slider->link          = $request->link;
        $slider->status        = $request->status;
        $slider->text_color    = $request->text_color;
        $slider->save();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider created successfully.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
            $slider->image = $request->file('image')->store('sliders', 'public');
        }

        $slider->title_en      = $request->title_en;
        $slider->title_ar      = $request->title_ar;
        $slider->subtitle_en   = $request->subtitle_en;
        $slider->subtitle_ar   = $request->subtitle_ar;
        $slider->offer_text_en = $request->offer_text_en;
        $slider->offer_text_ar = $request->offer_text_ar;
        $slider->link          = $request->link;
        $slider->status        = $request->status;
        $slider->text_color    = $request->text_color;
        $slider->save();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }
        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider deleted successfully.');
    }
}
