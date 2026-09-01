<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlankCategory;
use App\Models\BlankSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlankSubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = BlankSubCategory::with('blankCategory')->orderBy('id', 'desc')->get();
        return view('admin.blank-subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $parent_categories = BlankCategory::where('status', 'active')->get();
        return view('admin.blank-subcategories.create', compact('parent_categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|unique:blank_sub_categories',
            'name_ar' => 'required|unique:blank_sub_categories',
            'blank_category_id' => 'required|exists:blank_categories,id',
            'status' => 'required',
        ]);

        $subcategory = new BlankSubCategory();
        $subcategory->name_en = $request->name_en;
        $subcategory->name_ar = $request->name_ar;
        $subcategory->slug = Str::slug($request->name_en);
        $subcategory->status = $request->status;
        $subcategory->blank_category_id = $request->blank_category_id;
        
        if ($request->hasFile('image')) {
            $subcategory->image = $request->file('image')->store('blank-subcategories', 'public');
        }

        $subcategory->save();

        return redirect()->route('admin.blank-subcategories.index')->with('success', 'Blank Subcategory created successfully.');
    }

    public function edit(BlankSubCategory $blankSubcategory)
    {
        $parent_categories = BlankCategory::where('status', 'active')->get();
        // Since the route binds 'blank_subcategory', we can inject it or get it by ID
        return view('admin.blank-subcategories.edit', compact('blankSubcategory', 'parent_categories'));
    }

    public function update(Request $request, BlankSubCategory $blankSubcategory)
    {
        $request->validate([
            'name_en' => 'required|unique:blank_sub_categories,name_en,' . $blankSubcategory->id,
            'name_ar' => 'required|unique:blank_sub_categories,name_ar,' . $blankSubcategory->id,
            'blank_category_id' => 'required|exists:blank_categories,id',
            'status' => 'required',
        ]);

        $blankSubcategory->name_en = $request->name_en;
        $blankSubcategory->name_ar = $request->name_ar;
        $blankSubcategory->slug = Str::slug($request->name_en);
        $blankSubcategory->status = $request->status;
        $blankSubcategory->blank_category_id = $request->blank_category_id;

        if ($request->hasFile('image')) {
            if ($blankSubcategory->image) {
                Storage::disk('public')->delete($blankSubcategory->image);
            }
            $blankSubcategory->image = $request->file('image')->store('blank-subcategories', 'public');
        }

        $blankSubcategory->save();

        return redirect()->route('admin.blank-subcategories.index')->with('success', 'Blank Subcategory updated successfully.');
    }

    public function destroy(BlankSubCategory $blankSubcategory)
    {
        if ($blankSubcategory->image) {
            Storage::disk('public')->delete($blankSubcategory->image);
        }
        $blankSubcategory->delete();

        return redirect()->route('admin.blank-subcategories.index')->with('success', 'Blank Subcategory deleted successfully.');
    }

    public function getSubcategories($category_id = null)
    {
        if (!$category_id) {
            return response()->json([]);
        }
        $subcategories = BlankSubCategory::where('blank_category_id', $category_id)->where('status', 'active')->get();
        return response()->json($subcategories);
    }
}
