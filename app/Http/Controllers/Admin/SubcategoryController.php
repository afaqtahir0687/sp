<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::with('category')->orderBy('id', 'desc')->get();
        return view('admin.subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $parent_categories = Category::where('status', 'active')->get();
        return view('admin.subcategories.create', compact('parent_categories'));
    }

     public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|unique:sub_categories',
            'name_ar' => 'required|unique:sub_categories',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required',
            'banner_title_en' => 'nullable|string|max:255',
            'banner_title_ar' => 'nullable|string|max:255',
            'banner_button_text_en' => 'nullable|string|max:255',
            'banner_button_text_ar' => 'nullable|string|max:255',
            'banner_button_link' => 'nullable|string|max:255',
            'banner_text_color' => 'nullable|string|max:20',
        ]);

        $subcategory = new SubCategory();
        $subcategory->name_en = $request->name_en;
        $subcategory->name_ar = $request->name_ar;
        $subcategory->slug = Str::slug($request->name_en);
        $subcategory->status = $request->status;
        $subcategory->category_id = $request->category_id;
        
        $subcategory->banner_title_en = $request->banner_title_en;
        $subcategory->banner_title_ar = $request->banner_title_ar;
        $subcategory->banner_button_text_en = $request->banner_button_text_en;
        $subcategory->banner_button_text_ar = $request->banner_button_text_ar;
        $subcategory->banner_button_link = $request->banner_button_link;
        $subcategory->banner_text_color = $request->banner_text_color;
        
        if ($request->hasFile('image')) {
            $subcategory->image = $request->file('image')->store('subcategories', 'public');
        }

        if ($request->hasFile('banner_image')) {
            $subcategory->banner_image = $request->file('banner_image')->store('subcategories', 'public');
        }

        $subcategory->save();

        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory created successfully.');
    }

    public function edit(SubCategory $subcategory)
    {
        $parent_categories = Category::where('status', 'active')->get();
        return view('admin.subcategories.edit', compact('subcategory', 'parent_categories'));
    }

    public function update(Request $request, SubCategory $subcategory)
    {
        $request->validate([
            'name_en' => 'required|unique:sub_categories,name_en,' . $subcategory->id,
            'name_ar' => 'required|unique:sub_categories,name_ar,' . $subcategory->id,
            'category_id' => 'required|exists:categories,id',
            'status' => 'required',
            'banner_title_en' => 'nullable|string|max:255',
            'banner_title_ar' => 'nullable|string|max:255',
            'banner_button_text_en' => 'nullable|string|max:255',
            'banner_button_text_ar' => 'nullable|string|max:255',
            'banner_button_link' => 'nullable|string|max:255',
            'banner_text_color' => 'nullable|string|max:20',
        ]);

        $subcategory->name_en = $request->name_en;
        $subcategory->name_ar = $request->name_ar;
        $subcategory->slug = Str::slug($request->name_en);
        $subcategory->status = $request->status;
        $subcategory->category_id = $request->category_id;

        $subcategory->banner_title_en = $request->banner_title_en;
        $subcategory->banner_title_ar = $request->banner_title_ar;
        $subcategory->banner_button_text_en = $request->banner_button_text_en;
        $subcategory->banner_button_text_ar = $request->banner_button_text_ar;
        $subcategory->banner_button_link = $request->banner_button_link;
        $subcategory->banner_text_color = $request->banner_text_color;

        if ($request->hasFile('image')) {
            if ($subcategory->image) {
                Storage::disk('public')->delete($subcategory->image);
            }
            $subcategory->image = $request->file('image')->store('subcategories', 'public');
        }

        if ($request->hasFile('banner_image')) {
            if ($subcategory->banner_image) {
                Storage::disk('public')->delete($subcategory->banner_image);
            }
            $subcategory->banner_image = $request->file('banner_image')->store('subcategories', 'public');
        }

        $subcategory->save();

        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory updated successfully.');
    }

    public function destroy(SubCategory $subcategory)
    {
        if ($subcategory->image) {
            Storage::disk('public')->delete($subcategory->image);
        }
        if ($subcategory->banner_image) {
            Storage::disk('public')->delete($subcategory->banner_image);
        }
        $subcategory->delete();

        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory deleted successfully.');
    }

    public function getSubcategories($category_id = null)
    {
        if (!$category_id) {
            return response()->json([]);
        }
        $subcategories = SubCategory::where('category_id', $category_id)->where('status', 'active')->get();
        return response()->json($subcategories);
    }
}