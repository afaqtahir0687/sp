<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlankProduct;
use App\Models\BlankCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlankProductController extends Controller
{
    public function index()
    {
        $blankProducts = BlankProduct::orderBy('id', 'desc')->get();
        return view('admin.blank-products.index', compact('blankProducts'));
    }

    public function create()
    {
        $categories = BlankCategory::where('status', 'active')->get();
        return view('admin.blank-products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|unique:blank_products',
            'name_ar' => 'required|unique:blank_products',
            'price' => 'required|numeric',
            'status' => 'required',
            'image' => 'required|image',
            'blank_category_id' => 'nullable|exists:blank_categories,id',
            'blank_subcategory_id' => 'nullable|exists:blank_sub_categories,id',
        ]);

        $blankProduct = new BlankProduct();
        $blankProduct->name_en = $request->name_en;
        $blankProduct->name_ar = $request->name_ar;
        $blankProduct->sku = $request->sku;
        $blankProduct->slug = Str::slug($request->name_en);
        $blankProduct->short_description_en = $request->short_description_en;
        $blankProduct->short_description_ar = $request->short_description_ar;
        $blankProduct->description_en = $request->description_en;
        $blankProduct->description_ar = $request->description_ar;
        $blankProduct->price = $request->price;
        $blankProduct->discount_price = $request->discount_price;
        $blankProduct->stock = $request->stock ?? 0;
        $blankProduct->blank_category_id = $request->blank_category_id;
        $blankProduct->blank_subcategory_id = $request->blank_subcategory_id;

        $blankProduct->sizes = $request->sizes ? array_map('trim', explode(',', $request->sizes)) : null;
        $blankProduct->size_prices = null; // No per-size pricing
        
        $blankProduct->colors = $request->colors ? array_map('trim', explode(',', $request->colors)) : null;

        $blankProduct->status = $request->status;
        $blankProduct->is_featured = $request->has('is_featured');
        $blankProduct->is_new_arrival = $request->has('is_new_arrival');

        if ($request->hasFile('image')) {
            $blankProduct->image = $request->file('image')->store('blank-products', 'public');
        }

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $file) {
                $images[] = $file->store('blank-products/gallery', 'public');
            }
            $blankProduct->images = $images;
        }

        $blankProduct->save();

        return redirect()->route('admin.blank-products.index')->with('success', 'Blank Product created successfully.');
    }

    public function edit(BlankProduct $blankProduct)
    {
        $categories = BlankCategory::where('status', 'active')->get();
        return view('admin.blank-products.edit', compact('blankProduct', 'categories'));
    }

    public function update(Request $request, BlankProduct $blankProduct)
    {
        $request->validate([
            'name_en' => 'required|unique:blank_products,name_en,' . $blankProduct->id,
            'name_ar' => 'required|unique:blank_products,name_ar,' . $blankProduct->id,
            'price' => 'required|numeric',
            'status' => 'required',
            'blank_category_id' => 'nullable|exists:blank_categories,id',
            'blank_subcategory_id' => 'nullable|exists:blank_sub_categories,id',
        ]);

        $blankProduct->name_en = $request->name_en;
        $blankProduct->name_ar = $request->name_ar;
        $blankProduct->sku = $request->sku;
        $blankProduct->slug = Str::slug($request->name_en);
        $blankProduct->short_description_en = $request->short_description_en;
        $blankProduct->short_description_ar = $request->short_description_ar;
        $blankProduct->description_en = $request->description_en;
        $blankProduct->description_ar = $request->description_ar;
        $blankProduct->price = $request->price;
        $blankProduct->discount_price = $request->discount_price;
        $blankProduct->stock = $request->stock ?? 0;
        $blankProduct->blank_category_id = $request->blank_category_id;
        $blankProduct->blank_subcategory_id = $request->blank_subcategory_id;

        $blankProduct->sizes = $request->sizes ? array_map('trim', explode(',', $request->sizes)) : null;
        $blankProduct->size_prices = null; // No per-size pricing
        
        $blankProduct->colors = $request->colors ? array_map('trim', explode(',', $request->colors)) : null;

        $blankProduct->status = $request->status;
        $blankProduct->is_featured = $request->has('is_featured');
        $blankProduct->is_new_arrival = $request->has('is_new_arrival');

        if ($request->hasFile('image')) {
            if ($blankProduct->image) {
                Storage::disk('public')->delete($blankProduct->image);
            }
            $blankProduct->image = $request->file('image')->store('blank-products', 'public');
        }

        // Handle gallery images update logic
        $images = $blankProduct->images ?? [];

        // Remove specific images if requested
        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $imageToRemove) {
                // Delete from storage
                if (Storage::disk('public')->exists($imageToRemove)) {
                    Storage::disk('public')->delete($imageToRemove);
                }
                // Remove from array
                $images = array_filter($images, function($img) use ($imageToRemove) {
                    return $img !== $imageToRemove;
                });
            }
            $images = array_values($images); // Re-index array
        }

        // Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $images[] = $file->store('blank-products/gallery', 'public');
            }
        }

        $blankProduct->images = $images;

        $blankProduct->save();

        return redirect()->route('admin.blank-products.index')->with('success', 'Blank Product updated successfully.');
    }

    public function destroy(BlankProduct $blankProduct)
    {
        if ($blankProduct->image) {
            Storage::disk('public')->delete($blankProduct->image);
        }
        
        // Delete gallery images
        if ($blankProduct->images) {
            foreach ($blankProduct->images as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        $blankProduct->delete();

        return redirect()->route('admin.blank-products.index')->with('success', 'Blank Product deleted successfully.');
    }
}
