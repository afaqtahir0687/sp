<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|unique:categories',
            'name_ar' => 'required|unique:categories',
            'status' => 'required',
        ]);

        $category = new Category();
        $category->name_en = $request->name_en;
        $category->name_ar = $request->name_ar;
        $category->slug = Str::slug($request->name_en);
        $category->status = $request->status;
        
        // Banner fields
        $category->banner_top_text_en = $request->banner_top_text_en;
        $category->banner_top_text_ar = $request->banner_top_text_ar;
        $category->banner_discount_text_en = $request->banner_discount_text_en;
        $category->banner_discount_text_ar = $request->banner_discount_text_ar;
        $category->banner_bottom_text_en = $request->banner_bottom_text_en;
        $category->banner_bottom_text_ar = $request->banner_bottom_text_ar;
        $category->banner_button_text_en = $request->banner_button_text_en;
        $category->banner_button_text_ar = $request->banner_button_text_ar;
        $category->banner_button_link = $request->banner_button_link;
        
        if ($request->hasFile('image')) {
            $category->image = $request->file('image')->store('categories', 'public');
        }

        if ($request->hasFile('home_image')) {
            $category->home_image = $request->file('home_image')->store('categories', 'public');
        }

        if ($request->hasFile('banner_image')) {
            $category->banner_image = $request->file('banner_image')->store('categories', 'public');
        }

        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name_en' => 'required|unique:categories,name_en,' . $category->id,
            'name_ar' => 'required|unique:categories,name_ar,' . $category->id,
            'status' => 'required',
        ]);

        $category->name_en = $request->name_en;
        $category->name_ar = $request->name_ar;
        $category->slug = Str::slug($request->name_en);
        $category->status = $request->status;

        // Banner fields
        $category->banner_top_text_en = $request->banner_top_text_en;
        $category->banner_top_text_ar = $request->banner_top_text_ar;
        $category->banner_discount_text_en = $request->banner_discount_text_en;
        $category->banner_discount_text_ar = $request->banner_discount_text_ar;
        $category->banner_bottom_text_en = $request->banner_bottom_text_en;
        $category->banner_bottom_text_ar = $request->banner_bottom_text_ar;
        $category->banner_button_text_en = $request->banner_button_text_en;
        $category->banner_button_text_ar = $request->banner_button_text_ar;
        $category->banner_button_link = $request->banner_button_link;

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $category->image = $request->file('image')->store('categories', 'public');
        }

        if ($request->hasFile('home_image')) {
            if ($category->home_image) {
                Storage::disk('public')->delete($category->home_image);
            }
            $category->home_image = $request->file('home_image')->store('categories', 'public');
        }

        if ($request->hasFile('banner_image')) {
            if ($category->banner_image) {
                Storage::disk('public')->delete($category->banner_image);
            }
            $category->banner_image = $request->file('banner_image')->store('categories', 'public');
        }

        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        if ($category->hover_image) {
            Storage::disk('public')->delete($category->hover_image);
        }
        if ($category->banner_image) {
            Storage::disk('public')->delete($category->banner_image);
        }
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
