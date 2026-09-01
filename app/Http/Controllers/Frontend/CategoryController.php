<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $productsQuery = Product::with(['category', 'subcategory'])->where('status', 'active');

        // Handle sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price-asc':
                $productsQuery->orderBy('price', 'asc');
                break;
            case 'price-desc':
                $productsQuery->orderBy('price', 'desc');
                break;
            case 'newest':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            case 'name-asc':
                $productsQuery->orderBy('name_en', 'asc');
                break;
            case 'name-desc':
                $productsQuery->orderBy('name_en', 'desc');
                break;
            default:
                $productsQuery->orderBy('created_at', 'desc');
                break;
        }

        // Handle pagination
        $perPage = $request->get('per_page', 12);
        $products = $productsQuery->paginate($perPage);
        
        $categories = Category::where('status', 'active')->latest()->get();
        return view('frontend.pages.categories.index', compact('products', 'categories', 'sort', 'perPage'));
    }

    public function show(Request $request, $category_slug, $subcategory_slug = null)
    {
        if ($subcategory_slug) {
            // Looking for subcategory
            $category = \App\Models\SubCategory::where('slug', $subcategory_slug)->where('status', 'active')->firstOrFail();
            $subcategories = collect([]);
            $productsQuery = $category->getAllProducts();
            $bannerCategory = $category->category; // parent Category (belongsTo)
            $isSubcategory = true;
        } else {
            // Looking for main category
            $category = Category::where('slug', $category_slug)->where('status', 'active')->firstOrFail();
            $subcategories = $category->subcategories()->where('status', 'active')->withCount('products')->get();
            $productsQuery = $category->getAllProducts();
            $bannerCategory = $category; // already the main Category
            $isSubcategory = false;
        }

        // Handle sorting
        $sort = $request->get('sort', 'default');
        switch ($sort) {
            case 'price-asc':
                $productsQuery->orderBy('price', 'asc');
                break;
            case 'price-desc':
                $productsQuery->orderBy('price', 'desc');
                break;
            case 'newest':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            case 'name-asc':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'name-desc':
                $productsQuery->orderBy('name', 'desc');
                break;
            default:
                $productsQuery->orderBy('created_at', 'desc');
                break;
        }

        // Handle pagination
        $perPage = $request->get('per_page', 12);
        $products = $productsQuery->paginate($perPage);

        // Determine if products grid should be shown
        // Show if it's a subcategory OR if it's a main category with no subcategories
        $showProductsGrid = $isSubcategory || $subcategories->count() === 0;

        return view('frontend.pages.categories.show', compact('category', 'products', 'subcategories', 'sort', 'perPage', 'bannerCategory', 'isSubcategory', 'showProductsGrid'));
    }

    public function bannerBoxSlider()
    {
        return view('frontend.pages.categories.banner-slider');
    }
    public function bannerBoxImg()
    {
        return view('frontend.pages.categories.banner-box-image');
    }
    public function rightSidebar()
    {
        return view('frontend.pages.categories.right-sidebar');
    }
    public function offCanvas()
    {
        return view('frontend.pages.categories.off-canvas');
    }
}
