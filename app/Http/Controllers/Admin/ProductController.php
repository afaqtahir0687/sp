<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('id', 'desc')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'nullable|exists:sub_categories,id',
            'price' => 'required|numeric',
            'status' => 'required',
            'image' => 'required|image',
        ]);

        $product = new Product();
        $product->name_en = $request->name_en;
        $product->name_ar = $request->name_ar;
        $product->sku = $request->sku;
        $product->slug = Str::slug($request->name_en);
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->short_description_en = $request->short_description_en;
        $product->short_description_ar = $request->short_description_ar;
        $product->description_en = $request->description_en;
        $product->description_ar = $request->description_ar;
        $product->size_guide_en = $request->size_guide_en;
        $product->size_guide_ar = $request->size_guide_ar;
        $product->additional_info_en = $request->additional_info_en;
        $product->additional_info_ar = $request->additional_info_ar;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->discount_end_date = $request->discount_end_date;
        $product->delivery_days = $request->delivery_days ?? 1;
        $product->production_days = $request->production_days ?? 3;
        $product->flexible_rate = $request->flexible_rate;
        $product->urgent_rate = $request->urgent_rate;
        $product->flexible_production_days = $request->flexible_production_days ?? 5;
        $product->urgent_production_days = $request->urgent_production_days ?? 1;

        $product->materials = $request->materials ? array_map('trim', explode(',', $request->materials)) : null;
        $product->materials_ar = $request->materials_ar ? array_map('trim', explode(',', $request->materials_ar)) : null;
        $product->sizes = $request->sizes ? array_map('trim', explode(',', $request->sizes)) : null;
        $product->sizes_ar = $request->sizes_ar ? array_map('trim', explode(',', $request->sizes_ar)) : null;
        $product->quantities = $request->quantities ? array_map('trim', explode(',', $request->quantities)) : null;
        $product->side_1_colors = $request->side_1_colors ? array_map('trim', explode(',', $request->side_1_colors)) : null;
        $product->side_1_colors_ar = $request->side_1_colors_ar ? array_map('trim', explode(',', $request->side_1_colors_ar)) : null;
        $product->sides_options = $request->sides_options ? array_map('trim', explode(',', $request->sides_options)) : null;
        $product->sides_options_ar = $request->sides_options_ar ? array_map('trim', explode(',', $request->sides_options_ar)) : null;
        $product->lamination_types = $request->lamination_types ? array_map('trim', explode(',', $request->lamination_types)) : null;
        $product->lamination_types_ar = $request->lamination_types_ar ? array_map('trim', explode(',', $request->lamination_types_ar)) : null;
        $product->die_cutting_options = $request->die_cutting_options ? array_map('trim', explode(',', $request->die_cutting_options)) : null;
        $product->die_cutting_options_ar = $request->die_cutting_options_ar ? array_map('trim', explode(',', $request->die_cutting_options_ar)) : null;
        $product->allow_custom_quantity = $request->has('allow_custom_quantity');
        $product->allow_round_corners = $request->has('allow_round_corners');

        $product->status = $request->status;
        $product->is_featured = $request->has('is_featured');
        $product->is_new_arrival = $request->has('is_new_arrival');
        $product->is_wishlist = $request->has('is_wishlist');

        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $file) {
                $images[] = $file->store('products/gallery', 'public');
            }
            $product->images = $images;
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('status', 'active')->get();
        $subcategories = \App\Models\SubCategory::where('category_id', $product->category_id)->where('status', 'active')->get();
        return view('admin.products.edit', compact('product', 'categories', 'subcategories'));
    }

    public function update(Request $request, Product $product)
    {
         $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'nullable|exists:sub_categories,id',
            'price' => 'required|numeric',
            'status' => 'required',
        ]);

        $product->name_en = $request->name_en;
        $product->name_ar = $request->name_ar;
        $product->sku = $request->sku;
        $product->slug = Str::slug($request->name_en);
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->short_description_en = $request->short_description_en;
        $product->short_description_ar = $request->short_description_ar;
        $product->description_en = $request->description_en;
        $product->description_ar = $request->description_ar;
        $product->size_guide_en = $request->size_guide_en;
        $product->size_guide_ar = $request->size_guide_ar;
        $product->additional_info_en = $request->additional_info_en;
        $product->additional_info_ar = $request->additional_info_ar;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->discount_end_date = $request->discount_end_date;
        $product->delivery_days = $request->delivery_days ?? 1;
        $product->production_days = $request->production_days ?? 3;
        $product->flexible_rate = $request->flexible_rate;
        $product->urgent_rate = $request->urgent_rate;
        $product->flexible_production_days = $request->flexible_production_days ?? 5;
        $product->urgent_production_days = $request->urgent_production_days ?? 1;

        $product->materials = $request->materials ? array_map('trim', explode(',', $request->materials)) : null;
        $product->materials_ar = $request->materials_ar ? array_map('trim', explode(',', $request->materials_ar)) : null;
        $product->sizes = $request->sizes ? array_map('trim', explode(',', $request->sizes)) : null;
        $product->sizes_ar = $request->sizes_ar ? array_map('trim', explode(',', $request->sizes_ar)) : null;
        $product->quantities = $request->quantities ? array_map('trim', explode(',', $request->quantities)) : null;
        $product->side_1_colors = $request->side_1_colors ? array_map('trim', explode(',', $request->side_1_colors)) : null;
        $product->side_1_colors_ar = $request->side_1_colors_ar ? array_map('trim', explode(',', $request->side_1_colors_ar)) : null;
        $product->sides_options = $request->sides_options ? array_map('trim', explode(',', $request->sides_options)) : null;
        $product->sides_options_ar = $request->sides_options_ar ? array_map('trim', explode(',', $request->sides_options_ar)) : null;
        $product->lamination_types = $request->lamination_types ? array_map('trim', explode(',', $request->lamination_types)) : null;
        $product->lamination_types_ar = $request->lamination_types_ar ? array_map('trim', explode(',', $request->lamination_types_ar)) : null;
        $product->die_cutting_options = $request->die_cutting_options ? array_map('trim', explode(',', $request->die_cutting_options)) : null;
        $product->die_cutting_options_ar = $request->die_cutting_options_ar ? array_map('trim', explode(',', $request->die_cutting_options_ar)) : null;
        $product->allow_custom_quantity = $request->has('allow_custom_quantity');
        $product->allow_round_corners = $request->has('allow_round_corners');

        $product->status = $request->status;
        $product->is_featured = $request->has('is_featured');
        $product->is_new_arrival = $request->has('is_new_arrival');
        $product->is_wishlist = $request->has('is_wishlist');

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        // Handle gallery images update logic
        $images = $product->images ?? [];

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
                $images[] = $file->store('products/gallery', 'public');
            }
        }

        $product->images = $images;

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        // Delete gallery images
        if ($product->images) {
            foreach ($product->images as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
