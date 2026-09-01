<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrintingTechnology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrintingTechnologyController extends Controller
{
    public function index()
    {
        $technologies = PrintingTechnology::latest()->get();
        return view('admin.printing-technologies.index', compact('technologies'));
    }

    public function create()
    {
        return view('admin.printing-technologies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'image' => 'nullable|image',
            'status' => 'required|in:active,inactive',
        ]);

        $technology = new PrintingTechnology();
        if ($request->hasFile('image')) {
            $technology->image = $request->file('image')->store('printing_technologies', 'public');
        }
        $technology->title_en = $request->title_en;
        $technology->title_ar = $request->title_ar;
        $technology->description_en = $request->description_en;
        $technology->description_ar = $request->description_ar;
        $technology->status = $request->status;
        $technology->save();

        return redirect()->route('admin.printing-technologies.index')->with('success', 'Printing Technology created successfully.');
    }

    public function edit($id)
    {
        $technology = PrintingTechnology::findOrFail($id);
        return view('admin.printing-technologies.edit', compact('technology'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'image' => 'nullable|image',
            'status' => 'required|in:active,inactive',
        ]);

        $technology = PrintingTechnology::findOrFail($id);
        if ($request->hasFile('image')) {
            if ($technology->image) {
                Storage::disk('public')->delete($technology->image);
            }
            $technology->image = $request->file('image')->store('printing_technologies', 'public');
        }
        $technology->title_en = $request->title_en;
        $technology->title_ar = $request->title_ar;
        $technology->description_en = $request->description_en;
        $technology->description_ar = $request->description_ar;
        $technology->status = $request->status;
        $technology->save();

        return redirect()->route('admin.printing-technologies.index')->with('success', 'Printing Technology updated successfully.');
    }

    public function destroy($id)
    {
        $technology = PrintingTechnology::findOrFail($id);
        if ($technology->image) {
            Storage::disk('public')->delete($technology->image);
        }
        $technology->delete();

        return redirect()->route('admin.printing-technologies.index')->with('success', 'Printing Technology deleted successfully.');
    }
}
