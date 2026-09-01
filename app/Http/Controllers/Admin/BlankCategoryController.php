<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlankCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlankCategoryController extends Controller
{
    public function index()
    {
        $blankCategories = BlankCategory::orderBy('id', 'desc')->get();
        return view('admin.blank-categories.index', compact('blankCategories'));
    }

    public function create()
    {
        return view('admin.blank-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|unique:blank_categories',
            'name_ar' => 'required|unique:blank_categories',
            'status' => 'required',
        ]);

        $category = new BlankCategory();
        $category->name_en = $request->name_en;
        $category->name_ar = $request->name_ar;
        $category->slug = Str::slug($request->name_en);
        $category->status = $request->status;
        
        if ($request->hasFile('image')) {
            $category->image = $request->file('image')->store('blank-categories', 'public');
        }

        $category->save();

        return redirect()->route('admin.blank-categories.index')->with('success', 'Blank Category created successfully.');
    }

    public function edit(BlankCategory $blankCategory)
    {
        return view('admin.blank-categories.edit', compact('blankCategory'));
    }

    public function update(Request $request, BlankCategory $blankCategory)
    {
        $request->validate([
            'name_en' => 'required|unique:blank_categories,name_en,' . $blankCategory->id,
            'name_ar' => 'required|unique:blank_categories,name_ar,' . $blankCategory->id,
            'status' => 'required',
        ]);

        $blankCategory->name_en = $request->name_en;
        $blankCategory->name_ar = $request->name_ar;
        $blankCategory->slug = Str::slug($request->name_en);
        $blankCategory->status = $request->status;

        if ($request->hasFile('image')) {
            if ($blankCategory->image) {
                Storage::disk('public')->delete($blankCategory->image);
            }
            $blankCategory->image = $request->file('image')->store('blank-categories', 'public');
        }

        $blankCategory->save();

        return redirect()->route('admin.blank-categories.index')->with('success', 'Blank Category updated successfully.');
    }

    public function destroy(BlankCategory $blankCategory)
    {
        if ($blankCategory->image) {
            Storage::disk('public')->delete($blankCategory->image);
        }
        $blankCategory->delete();

        return redirect()->route('admin.blank-categories.index')->with('success', 'Blank Category deleted successfully.');
    }
}
