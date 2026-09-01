<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BookCategoryController extends Controller
{
    public function index()
    {
        $bookCategories = BookCategory::orderBy('id', 'desc')->get();
        return view('admin.book-categories.index', compact('bookCategories'));
    }

    public function create()
    {
        return view('admin.book-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|unique:book_categories',
            'name_ar' => 'nullable|unique:book_categories',
            'status' => 'required',
        ]);

        $category = new BookCategory();
        $category->name_en = $request->name_en;
        $category->name_ar = $request->name_ar;
        $category->slug = Str::slug($request->name_en);
        $category->description_en = $request->description_en;
        $category->description_ar = $request->description_ar;
        $category->status = $request->status;
        
        if ($request->hasFile('image')) {
            $category->image = $request->file('image')->store('book-categories', 'public');
        }

        $category->save();

        return redirect()->route('admin.book-categories.index')->with('success', 'Book Category created successfully.');
    }

    public function edit(BookCategory $bookCategory)
    {
        return view('admin.book-categories.edit', compact('bookCategory'));
    }

    public function update(Request $request, BookCategory $bookCategory)
    {
        $request->validate([
            'name_en' => 'required|unique:book_categories,name_en,' . $bookCategory->id,
            'name_ar' => 'nullable|unique:book_categories,name_ar,' . $bookCategory->id,
            'status' => 'required',
        ]);

        $bookCategory->name_en = $request->name_en;
        $bookCategory->name_ar = $request->name_ar;
        $bookCategory->slug = Str::slug($request->name_en);
        $bookCategory->description_en = $request->description_en;
        $bookCategory->description_ar = $request->description_ar;
        $bookCategory->status = $request->status;

        if ($request->hasFile('image')) {
            if ($bookCategory->image) {
                Storage::disk('public')->delete($bookCategory->image);
            }
            $bookCategory->image = $request->file('image')->store('book-categories', 'public');
        }

        $bookCategory->save();

        return redirect()->route('admin.book-categories.index')->with('success', 'Book Category updated successfully.');
    }

    public function destroy(BookCategory $bookCategory)
    {
        if ($bookCategory->image) {
            Storage::disk('public')->delete($bookCategory->image);
        }
        $bookCategory->delete();

        return redirect()->route('admin.book-categories.index')->with('success', 'Book Category deleted successfully.');
    }
}
