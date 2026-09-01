<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlankProduct;
use App\Models\BlankCategory;
use Illuminate\Http\Request;

class BlankProductController extends Controller
{
    public function index()
    {
        $query = BlankProduct::where('status', 'active');



        // Apply category filter if selected
        $selectedCategory = null;
        if (request()->has('category') && request()->get('category')) {
            $selectedCategories = explode(',', request()->get('category'));
            if (!in_array('all', $selectedCategories)) {
                $categoryIds = [];
                foreach ($selectedCategories as $categorySlug) {
                    $category = BlankCategory::where('slug', trim($categorySlug))->first();
                    if ($category) {
                        $categoryIds[] = $category->id;
                    }
                }
                if (!empty($categoryIds)) {
                    $query->whereIn('blank_category_id', $categoryIds);
                }
            }
        }

        // Apply subcategory filter if selected
        if (request()->has('subcategory') && request()->get('subcategory')) {
            $selectedSubcategories = explode(',', request()->get('subcategory'));
            $query->whereHas('blankSubcategory', function ($q) use ($selectedSubcategories) {
                $q->whereIn('slug', $selectedSubcategories);
            });
        }

        $blankProducts = $query->with(['blankCategory', 'blankSubcategory'])->latest()->paginate(12);
        $featuredBlankProducts = BlankProduct::where('is_featured', true)->where('status', 'active')->latest()->take(6)->get();
        $newArrivalBlankProducts = BlankProduct::where('is_new_arrival', true)->where('status', 'active')->latest()->take(6)->get();



        // Get categories that have active blank products
        $categoryIds = BlankProduct::where('status', 'active')->whereNotNull('blank_category_id')->pluck('blank_category_id')->unique();
        $categories = BlankCategory::whereIn('id', $categoryIds)->where('status', 'active')->with('blankSubcategories')->get();

        return view('frontend.pages.blank-products.index', compact('blankProducts', 'featuredBlankProducts', 'newArrivalBlankProducts', 'categories', 'selectedCategory'));
    }

    public function show($slug)
    {
        $blankProduct = BlankProduct::where('slug', $slug)->where('status', 'active')->firstOrFail();
        $relatedBlankProducts = BlankProduct::where('id', '!=', $blankProduct->id)->where('status', 'active')->latest()->take(6)->get();

        return view('frontend.pages.blank-products.show', compact('blankProduct', 'relatedBlankProducts'));
    }
}
