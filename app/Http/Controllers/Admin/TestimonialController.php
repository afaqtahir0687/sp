<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('sort_order')->latest()->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name_en' => 'required|string|max:255',
            'review_en'      => 'required|string',
            'rating'         => 'required|integer|min:1|max:5',
            'client_image'   => 'nullable|image|max:2048',
            'status'         => 'required|in:active,inactive',
            'sort_order'     => 'nullable|integer',
        ]);

        $testimonial = new Testimonial();
        if ($request->hasFile('client_image')) {
            $testimonial->client_image = $request->file('client_image')->store('testimonials', 'public');
        }
        $testimonial->client_name_en     = $request->client_name_en;
        $testimonial->client_name_ar     = $request->client_name_ar;
        $testimonial->client_position_en = $request->client_position_en;
        $testimonial->client_position_ar = $request->client_position_ar;
        $testimonial->client_company     = $request->client_company;
        $testimonial->review_en          = $request->review_en;
        $testimonial->review_ar          = $request->review_ar;
        $testimonial->rating             = $request->rating;
        $testimonial->status             = $request->status;
        $testimonial->sort_order         = $request->sort_order ?? 0;
        $testimonial->save();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'client_name_en' => 'required|string|max:255',
            'review_en'      => 'required|string',
            'rating'         => 'required|integer|min:1|max:5',
            'client_image'   => 'nullable|image|max:2048',
            'status'         => 'required|in:active,inactive',
            'sort_order'     => 'nullable|integer',
        ]);

        $testimonial = Testimonial::findOrFail($id);
        if ($request->hasFile('client_image')) {
            if ($testimonial->client_image) {
                Storage::disk('public')->delete($testimonial->client_image);
            }
            $testimonial->client_image = $request->file('client_image')->store('testimonials', 'public');
        }
        $testimonial->client_name_en     = $request->client_name_en;
        $testimonial->client_name_ar     = $request->client_name_ar;
        $testimonial->client_position_en = $request->client_position_en;
        $testimonial->client_position_ar = $request->client_position_ar;
        $testimonial->client_company     = $request->client_company;
        $testimonial->review_en          = $request->review_en;
        $testimonial->review_ar          = $request->review_ar;
        $testimonial->rating             = $request->rating;
        $testimonial->status             = $request->status;
        $testimonial->sort_order         = $request->sort_order ?? 0;
        $testimonial->save();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        if ($testimonial->client_image) {
            Storage::disk('public')->delete($testimonial->client_image);
        }
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
