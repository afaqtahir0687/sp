<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndustryController extends Controller
{
    public function index()
    {
        $industries = Industry::latest()->get();
        return view('admin.industries.index', compact('industries'));
    }

    public function create()
    {
        return view('admin.industries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'image' => 'nullable|image',
            'status' => 'required|in:active,inactive',
        ]);

        $industry = new Industry();
        if ($request->hasFile('image')) {
            $industry->image = $request->file('image')->store('industries', 'public');
        }
        $industry->icon = $request->icon;
        $industry->title_en = $request->title_en;
        $industry->title_ar = $request->title_ar;
        $industry->description_en = $request->description_en;
        $industry->description_ar = $request->description_ar;
        $industry->status = $request->status;
        $industry->save();

        return redirect()->route('admin.industries.index')->with('success', 'Industry created successfully.');
    }

    public function edit($id)
    {
        $industry = Industry::findOrFail($id);
        return view('admin.industries.edit', compact('industry'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'image' => 'nullable|image',
            'status' => 'required|in:active,inactive',
        ]);

        $industry = Industry::findOrFail($id);
        if ($request->hasFile('image')) {
            if ($industry->image) {
                Storage::disk('public')->delete($industry->image);
            }
            $industry->image = $request->file('image')->store('industries', 'public');
        }
        $industry->icon = $request->icon;
        $industry->title_en = $request->title_en;
        $industry->title_ar = $request->title_ar;
        $industry->description_en = $request->description_en;
        $industry->description_ar = $request->description_ar;
        $industry->status = $request->status;
        $industry->save();

        return redirect()->route('admin.industries.index')->with('success', 'Industry updated successfully.');
    }

    public function destroy($id)
    {
        $industry = Industry::findOrFail($id);
        if ($industry->image) {
            Storage::disk('public')->delete($industry->image);
        }
        $industry->delete();

        return redirect()->route('admin.industries.index')->with('success', 'Industry deleted successfully.');
    }
}
