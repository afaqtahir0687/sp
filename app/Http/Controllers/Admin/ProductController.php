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

    public function show(Product $product)
    {
        $product->load(['category', 'subcategory']);
        $data = $this->prepareProductData($product);
        return view('admin.products.show', $data);
    }

    public function pdf(Product $product)
    {
        $product->load(['category', 'subcategory']);
        $data = $this->prepareProductData($product);
        return view('admin.products.pdf', $data);
    }

    protected function prepareProductData(Product $product)
    {
        $mainImageDataUri = null;
        if ($product->image && file_exists(storage_path('app/public/' . $product->image))) {
            $path = storage_path('app/public/' . $product->image);
            $mime = mime_content_type($path) ?: 'image/jpeg';
            $mainImageDataUri = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($path));
        }

        $galleryDataUris = [];
        if (!empty($product->images) && is_array($product->images)) {
            foreach ($product->images as $gImg) {
                if ($gImg && file_exists(storage_path('app/public/' . $gImg))) {
                    $path = storage_path('app/public/' . $gImg);
                    $mime = mime_content_type($path) ?: 'image/jpeg';
                    $galleryDataUris[] = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($path));
                }
            }
        }

        return compact('product', 'mainImageDataUri', 'galleryDataUris');
    }

    public function create()
    {
        $categories = Category::with(['subcategories', 'products' => function($q) {
            $q->select('id', 'name_en', 'name_ar', 'category_id', 'subcategory_id')
              ->whereNotNull('materials')
              ->orderBy('name_en');
        }])->where('status', 'active')->get();

        $existingProducts = Product::select('id', 'name_en', 'name_ar', 'category_id', 'subcategory_id')
            ->whereNotNull('materials')
            ->orderBy('name_en')
            ->get();

        return view('admin.products.create', compact('categories', 'existingProducts'));
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
        
        // Handle material prices
        if ($request->has('material_prices') && is_array($request->material_prices)) {
            $materialPrices = [];
            foreach ($request->material_prices as $mat => $priceVal) {
                if ($priceVal !== null && $priceVal !== '') {
                    $materialPrices[trim($mat)] = (float) $priceVal;
                }
            }
            $product->material_prices = !empty($materialPrices) ? $materialPrices : null;
        } elseif ($request->filled('material_prices_raw')) {
            $product->material_prices = json_decode($request->material_prices_raw, true);
        } else {
            $product->material_prices = null;
        }

        $product->sizes = $request->sizes ? array_map('trim', explode(',', $request->sizes)) : null;
        $product->sizes_ar = $request->sizes_ar ? array_map('trim', explode(',', $request->sizes_ar)) : null;
        $product->quantities = $request->quantities ? array_map('trim', explode(',', $request->quantities)) : null;
        $product->side_1_colors = $request->side_1_colors ? array_map('trim', explode(',', $request->side_1_colors)) : null;
        $product->side_1_colors_ar = $request->side_1_colors_ar ? array_map('trim', explode(',', $request->side_1_colors_ar)) : null;
        $product->sides_options = $request->sides_options ? array_map('trim', explode(',', $request->sides_options)) : null;
        $product->sides_options_ar = $request->sides_options_ar ? array_map('trim', explode(',', $request->sides_options_ar)) : null;
        $product->lamination_types = $request->lamination_types ? array_map('trim', explode(',', $request->lamination_types)) : null;
        $product->lamination_types_ar = $request->lamination_types_ar ? array_map('trim', explode(',', $request->lamination_types_ar)) : null;
        $product->lamination_price = $request->filled('lamination_price') ? (float) $request->lamination_price : null;
        $product->die_cutting_options = $request->die_cutting_options ? array_map('trim', explode(',', $request->die_cutting_options)) : null;
        $product->die_cutting_options_ar = $request->die_cutting_options_ar ? array_map('trim', explode(',', $request->die_cutting_options_ar)) : null;

        $product->orientations = $request->orientations ? array_map('trim', explode(',', $request->orientations)) : null;
        $product->orientations_ar = $request->orientations_ar ? array_map('trim', explode(',', $request->orientations_ar)) : null;
        $product->folding_options = $request->folding_options ? array_map('trim', explode(',', $request->folding_options)) : null;
        $product->folding_options_ar = $request->folding_options_ar ? array_map('trim', explode(',', $request->folding_options_ar)) : null;
        $product->binding_options = $request->binding_options ? array_map('trim', explode(',', $request->binding_options)) : null;
        $product->binding_options_ar = $request->binding_options_ar ? array_map('trim', explode(',', $request->binding_options_ar)) : null;

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
        $categories = Category::with(['subcategories', 'products' => function($q) {
            $q->select('id', 'name_en', 'name_ar', 'category_id', 'subcategory_id')
              ->whereNotNull('materials')
              ->orderBy('name_en');
        }])->where('status', 'active')->get();

        $subcategories = \App\Models\SubCategory::where('category_id', $product->category_id)->where('status', 'active')->get();

        $existingProducts = Product::select('id', 'name_en', 'name_ar', 'category_id', 'subcategory_id')
            ->where('id', '!=', $product->id)
            ->whereNotNull('materials')
            ->orderBy('name_en')
            ->get();

        return view('admin.products.edit', compact('product', 'categories', 'subcategories', 'existingProducts'));
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

        // Handle material prices
        if ($request->has('material_prices') && is_array($request->material_prices)) {
            $materialPrices = [];
            foreach ($request->material_prices as $mat => $priceVal) {
                if ($priceVal !== null && $priceVal !== '') {
                    $materialPrices[trim($mat)] = (float) $priceVal;
                }
            }
            $product->material_prices = !empty($materialPrices) ? $materialPrices : null;
        } elseif ($request->filled('material_prices_raw')) {
            $product->material_prices = json_decode($request->material_prices_raw, true);
        } else {
            $product->material_prices = null;
        }

        $product->sizes = $request->sizes ? array_map('trim', explode(',', $request->sizes)) : null;
        $product->sizes_ar = $request->sizes_ar ? array_map('trim', explode(',', $request->sizes_ar)) : null;
        $product->quantities = $request->quantities ? array_map('trim', explode(',', $request->quantities)) : null;
        $product->side_1_colors = $request->side_1_colors ? array_map('trim', explode(',', $request->side_1_colors)) : null;
        $product->side_1_colors_ar = $request->side_1_colors_ar ? array_map('trim', explode(',', $request->side_1_colors_ar)) : null;
        $product->sides_options = $request->sides_options ? array_map('trim', explode(',', $request->sides_options)) : null;
        $product->sides_options_ar = $request->sides_options_ar ? array_map('trim', explode(',', $request->sides_options_ar)) : null;
        $product->lamination_types = $request->lamination_types ? array_map('trim', explode(',', $request->lamination_types)) : null;
        $product->lamination_types_ar = $request->lamination_types_ar ? array_map('trim', explode(',', $request->lamination_types_ar)) : null;
        $product->lamination_price = $request->filled('lamination_price') ? (float) $request->lamination_price : null;
        $product->die_cutting_options = $request->die_cutting_options ? array_map('trim', explode(',', $request->die_cutting_options)) : null;
        $product->die_cutting_options_ar = $request->die_cutting_options_ar ? array_map('trim', explode(',', $request->die_cutting_options_ar)) : null;

        $product->orientations = $request->orientations ? array_map('trim', explode(',', $request->orientations)) : null;
        $product->orientations_ar = $request->orientations_ar ? array_map('trim', explode(',', $request->orientations_ar)) : null;
        $product->folding_options = $request->folding_options ? array_map('trim', explode(',', $request->folding_options)) : null;
        $product->folding_options_ar = $request->folding_options_ar ? array_map('trim', explode(',', $request->folding_options_ar)) : null;
        $product->binding_options = $request->binding_options ? array_map('trim', explode(',', $request->binding_options)) : null;
        $product->binding_options_ar = $request->binding_options_ar ? array_map('trim', explode(',', $request->binding_options_ar)) : null;

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

    /**
     * Get customization options for a product dynamically via AJAX.
     */
    public function getOptions(Product $product)
    {
        return response()->json([
            'success' => true,
            'product_id' => $product->id,
            'product_name' => $product->name_en,
            'category_id' => $product->category_id,
            'subcategory_id' => $product->subcategory_id,
            'materials' => is_array($product->materials) ? implode(', ', $product->materials) : ($product->materials ?? ''),
            'materials_ar' => is_array($product->materials_ar) ? implode(', ', $product->materials_ar) : ($product->materials_ar ?? ''),
            'material_prices' => $product->material_prices ?? [],
            'sizes' => is_array($product->sizes) ? implode(', ', $product->sizes) : ($product->sizes ?? ''),
            'sizes_ar' => is_array($product->sizes_ar) ? implode(', ', $product->sizes_ar) : ($product->sizes_ar ?? ''),
            'quantities' => is_array($product->quantities) ? implode(', ', $product->quantities) : ($product->quantities ?? ''),
            'side_1_colors' => is_array($product->side_1_colors) ? implode(', ', $product->side_1_colors) : ($product->side_1_colors ?? ''),
            'side_1_colors_ar' => is_array($product->side_1_colors_ar) ? implode(', ', $product->side_1_colors_ar) : ($product->side_1_colors_ar ?? ''),
            'sides_options' => is_array($product->sides_options) ? implode(', ', $product->sides_options) : ($product->sides_options ?? ''),
            'sides_options_ar' => is_array($product->sides_options_ar) ? implode(', ', $product->sides_options_ar) : ($product->sides_options_ar ?? ''),
            'lamination_types' => is_array($product->lamination_types) ? implode(', ', $product->lamination_types) : ($product->lamination_types ?? ''),
            'lamination_types_ar' => is_array($product->lamination_types_ar) ? implode(', ', $product->lamination_types_ar) : ($product->lamination_types_ar ?? ''),
            'lamination_price' => $product->lamination_price,
            'die_cutting_options' => is_array($product->die_cutting_options) ? implode(', ', $product->die_cutting_options) : ($product->die_cutting_options ?? ''),
            'die_cutting_options_ar' => is_array($product->die_cutting_options_ar) ? implode(', ', $product->die_cutting_options_ar) : ($product->die_cutting_options_ar ?? ''),
            'orientations' => is_array($product->orientations) ? implode(', ', $product->orientations) : ($product->orientations ?? ''),
            'orientations_ar' => is_array($product->orientations_ar) ? implode(', ', $product->orientations_ar) : ($product->orientations_ar ?? ''),
            'folding_options' => is_array($product->folding_options) ? implode(', ', $product->folding_options) : ($product->folding_options ?? ''),
            'folding_options_ar' => is_array($product->folding_options_ar) ? implode(', ', $product->folding_options_ar) : ($product->folding_options_ar ?? ''),
            'binding_options' => is_array($product->binding_options) ? implode(', ', $product->binding_options) : ($product->binding_options ?? ''),
            'binding_options_ar' => is_array($product->binding_options_ar) ? implode(', ', $product->binding_options_ar) : ($product->binding_options_ar ?? ''),
            'allow_round_corners' => (bool)$product->allow_round_corners,
        ]);
    }

    /**
     * Get latest product options for a category or subcategory dynamically via AJAX.
     */
    public function getCategoryLatestOptions(Request $request)
    {
        $categoryId = $request->query('category_id');
        $subcategoryId = $request->query('subcategory_id');

        if (!$categoryId && !$subcategoryId) {
            return response()->json(['success' => false, 'message' => 'No category or subcategory provided.']);
        }

        $query = Product::whereNotNull('materials');
        if ($subcategoryId) {
            $query->where('subcategory_id', $subcategoryId);
        } elseif ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $product = $query->orderBy('id', 'desc')->first();

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'No product with options found.']);
        }

        return $this->getOptions($product);
    }
}
