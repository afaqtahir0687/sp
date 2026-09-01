<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\BlankProduct;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function add($id, $type = 'product')
    {
        if (!auth()->check()) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'redirect' => route('login'),
                    'message' => __('messages.please_login_to_add_to_wishlist')
                ], 401);
            }
            return redirect()->route('login')->with('error', __('messages.please_login_to_add_to_wishlist'));
        }

        if ($type === 'blank') {
            $blankProduct = BlankProduct::findOrFail($id);
            $wishlist = session()->get('wishlist_blank', []);

            if (!isset($wishlist[$id])) {
                $wishlist[$id] = [
                    "blank_product_id" => $blankProduct->id,
                    "name" => $blankProduct->name,
                    "name_ar" => $blankProduct->name_ar,
                    "price" => $blankProduct->discount_price ?: $blankProduct->price,
                    "image" => $blankProduct->image,
                    "slug" => $blankProduct->slug,
                    "type" => "blank"
                ];
                session()->put('wishlist_blank', $wishlist);

                if (auth()->check()) {
                    \App\Models\Wishlist::updateOrCreate([
                        'user_id' => auth()->id(),
                        'blank_product_id' => $id,
                        'type' => 'blank'
                    ], [
                        'product_id' => null
                    ]);
                }

                if (request()->ajax()) {
                    $wishlistCount = count(session('wishlist_blank')) + count(session('wishlist', []));
                    return response()->json([
                        'success' => true,
                        'message' => __('messages.product_added_to_wishlist'),
                        'wishlistCount' => $wishlistCount
                    ]);
                }

                return redirect()->back()->with('success', __('messages.product_added_to_wishlist'));
            }

            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => __('messages.product_already_in_wishlist')
                ]);
            }

            return redirect()->back()->with('info', __('messages.product_already_in_wishlist'));
        } else {
            $product = Product::findOrFail($id);
            $wishlist = session()->get('wishlist', []);

            if (!isset($wishlist[$id])) {
                $wishlist[$id] = [
                    "product_id" => $product->id,
                    "name" => $product->name_en,
                    "name_ar" => $product->name_ar,
                    "price" => $product->getSellingPrice(),
                    "image" => $product->image,
                    "slug" => $product->slug,
                    "type" => "product"
                ];
                session()->put('wishlist', $wishlist);

                if (auth()->check()) {
                    \App\Models\Wishlist::updateOrCreate([
                        'user_id' => auth()->id(),
                        'product_id' => $id,
                        'type' => 'product'
                    ]);
                }

                if (request()->ajax()) {
                    $wishlistCount = count(session('wishlist')) + count(session('wishlist_blank', []));
                    return response()->json([
                        'success' => true,
                        'message' => __('messages.product_added_to_wishlist'),
                        'wishlistCount' => $wishlistCount
                    ]);
                }

                return redirect()->back()->with('success', __('messages.product_added_to_wishlist'));
            }

            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => __('messages.product_already_in_wishlist')
                ]);
            }

            return redirect()->back()->with('info', __('messages.product_already_in_wishlist'));
        }
    }

    public function remove($id, $type = 'product')
    {
        if ($type === 'blank') {
            $wishlist = session()->get('wishlist_blank');
            if (isset($wishlist[$id])) {
                unset($wishlist[$id]);
                session()->put('wishlist_blank', $wishlist);

                if (auth()->check()) {
                    \App\Models\Wishlist::where('user_id', auth()->id())
                        ->where('blank_product_id', $id)
                        ->where('type', 'blank')
                        ->delete();
                }
            }

            if (request()->ajax()) {
                $wishlistCount = count(session('wishlist', [])) + count(session('wishlist_blank', []));
                return response()->json([
                    'success' => true,
                    'message' => __('messages.product_removed_from_wishlist'),
                    'wishlistCount' => $wishlistCount
                ]);
            }

            session()->flash('success', __('messages.product_removed_from_wishlist'));
        } else {
            $wishlist = session()->get('wishlist');
            if (isset($wishlist[$id])) {
                unset($wishlist[$id]);
                session()->put('wishlist', $wishlist);

                if (auth()->check()) {
                    \App\Models\Wishlist::where('user_id', auth()->id())
                        ->where('product_id', $id)
                        ->where('type', 'product')
                        ->delete();
                }
            }

            if (request()->ajax()) {
                $wishlistCount = count(session('wishlist', [])) + count(session('wishlist_blank', []));
                return response()->json([
                    'success' => true,
                    'message' => __('messages.product_removed_from_wishlist'),
                    'wishlistCount' => $wishlistCount
                ]);
            }

            session()->flash('success', __('messages.product_removed_from_wishlist'));
        }
        return redirect()->back();
    }
}
