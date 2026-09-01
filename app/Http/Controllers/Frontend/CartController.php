<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        if (!auth()->check()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'redirect' => route('login'),
                    'message' => __('messages.please_login_to_add_to_cart')
                ], 401);
            }
            return redirect()->route('login')->with('error', __('messages.please_login_to_add_to_cart'));
        }

        $type = $request->input('type', 'product');
        
        if ($type === 'blank') {
            return $this->addBlankProduct($request, $id);
        }

        if ($type === 'book') {
            return $this->addBook($request, $id);
        }
        
        // Regular product logic
        $product = Product::with(['category', 'subcategory'])->findOrFail($id);
        $cart = session()->get('cart', []);

        $designs_quantity = (int) $request->input('quantity', 1);
        $print_quantity = (int) $request->input('print_quantity', 100);
        $urgency = $request->input('urgency', 'regular');

        if ($print_quantity <= 0) {
            return redirect()->back()->with('error', 'Please select a valid quantity.');
        }

        $hasActiveDiscount = false;
        if ($product->discount_price > 0) {
            if (is_null($product->discount_end_date) || \Carbon\Carbon::parse($product->discount_end_date)->isFuture() || \Carbon\Carbon::parse($product->discount_end_date)->isToday()) {
                $hasActiveDiscount = true;
            }
        }

        $base_rate = 0;
        $production_days = 0;

        if ($urgency === 'flexible') {
            $base_rate = $product->flexible_rate;
            $production_days = $product->flexible_production_days ?? 5;
        } elseif ($urgency === 'urgent') {
            $base_rate = $product->urgent_rate;
            $production_days = $product->urgent_production_days ?? 1;
        } else {
            // Regular
            $base_rate = $product->price;
            $production_days = $product->production_days ?? 3;
        }

        $discount_value = $hasActiveDiscount ? $product->discount_price : 0;
        $rate = max(0, $base_rate - $discount_value);

        if ($rate <= 0) $rate = $base_rate;


        $options = $request->except(['_token', 'quantity', 'print_quantity', 'urgency']);
        
        // Price per unit: admin price = 1 unit ki qeemat
        $unit_price = $print_quantity * $rate;
        $unit_original_price = $print_quantity * $base_rate;

        // Generate a unique ID for the cart item based on product, quantities, urgency AND options
        $optionsHash = !empty($options) ? '_' . md5(json_encode($options)) : '';
        $cartId = $id . '_' . $print_quantity . '_' . $urgency . $optionsHash;

        if (isset($cart[$cartId])) {
            $cart[$cartId]['quantity'] += $designs_quantity;
        } else {
            $cart[$cartId] = [
                "product_id" => $product->id,
                "name" => $product->name_en,
                "name_ar" => $product->name_ar,
                "quantity" => $designs_quantity,
                "price" => $unit_price,
                "original_price" => $unit_original_price,
                "image" => $product->image,
                "slug" => $product->slug,
                "category_slug" => $product->category->slug,
                "subcategory_slug" => $product->subcategory ? $product->subcategory->slug : 'no-sub',
                "type" => "product",
                "options" => array_merge([
                    "print_quantity" => $print_quantity,
                    "urgency" => $urgency,
                    "production_days" => $production_days,
                    "delivery_days" => $product->delivery_days ?? 1
                ], $options)
            ];
        }

        session()->put('cart', $cart);

        if (auth()->check()) {
            $user = auth()->user();

            $existingCartItem = \App\Models\Cart::where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->where('print_quantity', $print_quantity)
                ->where('urgency', $urgency)
                ->get()
                ->first(function ($item) use ($options) {
                    $itemOptions = $item->options;
                    if (is_string($itemOptions)) {
                        $itemOptions = json_decode($itemOptions, true);
                    }
                    return $itemOptions == $options;
                });

            if ($existingCartItem) {
                $existingCartItem->quantity += $designs_quantity;
                $existingCartItem->save();
            } else {
                \App\Models\Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'quantity' => $designs_quantity,
                    'print_quantity' => $print_quantity,
                    'urgency' => $urgency,
                    'price' => $unit_price,
                    'production_days' => $production_days,
                    'delivery_days' => $product->delivery_days ?? 1,
                    'options' => json_encode($options)
                ]);
            }
        }

        if ($request->ajax()) {
            $cartCount = count(session('cart'));
            return response()->json([
                'success' => true,
                'message' => __('messages.product_added_to_cart'),
                'cartCount' => $cartCount
            ]);
        }

        return redirect()->back()->with('success', __('messages.product_added_to_cart'));
    }

    protected function addBlankProduct(Request $request, $id)
    {
        if (!auth()->check()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'redirect' => route('login'),
                    'message' => __('messages.please_login_to_add_to_cart')
                ], 401);
            }
            return redirect()->route('login')->with('error', __('messages.please_login_to_add_to_cart'));
        }

        $blankProduct = \App\Models\BlankProduct::findOrFail($id);
        $cart = session()->get('cart', []);

        $quantity = (int) $request->input('quantity', 1);
        $price = (float) $request->input('price', $blankProduct->discount_price ?? $blankProduct->price);
        $originalPrice = (float) $request->input('original_price', $blankProduct->price);
        $selectedSize = $request->input('size');
        $selectedColor = $request->input('color');

        if ($quantity <= 0) {
            return redirect()->back()->with('error', 'Please select a valid quantity.');
        }

        // Generate unique cart ID for blank product
        $optionsHash = md5(json_encode([
            'size' => $selectedSize,
            'color' => $selectedColor
        ]));
        $cartId = 'blank_' . $id . '_' . $optionsHash;

        if (isset($cart[$cartId])) {
            $cart[$cartId]['quantity'] += $quantity;
        } else {
            $cart[$cartId] = [
                "blank_product_id" => $blankProduct->id,
                "name" => $blankProduct->name_en,
                "name_ar" => $blankProduct->name_ar,
                "quantity" => $quantity,
                "price" => $price,
                "original_price" => $originalPrice,
                "image" => $blankProduct->image,
                "slug" => $blankProduct->slug,
                "type" => "blank",
                "options" => [
                    "size" => $selectedSize,
                    "color" => $selectedColor
                ]
            ];
        }

        session()->put('cart', $cart);

        if ($request->ajax()) {
            $cartCount = count(session('cart'));
            return response()->json([
                'success' => true,
                'message' => __('messages.product_added_to_cart'),
                'cartCount' => $cartCount
            ]);
        }

        return redirect()->back()->with('success', __('messages.product_added_to_cart'));
    }

    public function update(Request $request)
    {
        // Bulk update: { updates: { cartId: qty, ... } }
        $updates = $request->input('updates', []);

        if (!empty($updates)) {
            $cart = session()->get('cart', []);

            foreach ($updates as $cartId => $qty) {
                $qty = max(1, (int) $qty);
                if (isset($cart[$cartId])) {
                    $cart[$cartId]['quantity'] = $qty;

                    // Sync with DB for logged-in users
                    if (auth()->check()) {
                        $parts = explode('_', $cartId);
                        if (count($parts) >= 2 && $parts[0] === 'book') {
                            $bookId = $parts[1];
                            $cartItem = \App\Models\Cart::where('user_id', auth()->id())
                                ->where('book_id', $bookId)
                                ->first();

                            if ($cartItem) {
                                $cartItem->quantity = $qty;
                                $cartItem->save();
                            }
                        } elseif (count($parts) >= 3) {
                            $productId     = $parts[0];
                            $printQuantity = $parts[1];
                            $urgency       = $parts[2];

                            $cartItem = \App\Models\Cart::where('user_id', auth()->id())
                                ->where('product_id', $productId)
                                ->where('print_quantity', $printQuantity)
                                ->where('urgency', $urgency)
                                ->first();

                            if ($cartItem) {
                                $cartItem->quantity = $qty;
                                $cartItem->save();
                            }
                        }
                    }
                }
            }

            session()->put('cart', $cart);

            return response()->json(['success' => true, 'message' => 'Cart updated successfully']);
        }

        // Legacy single-item update (fallback)
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart', []);
            if (isset($cart[$request->id])) {
                $cart[$request->id]['quantity'] = max(1, (int) $request->quantity);
                session()->put('cart', $cart);
            }
            return response()->json(['success' => true, 'message' => 'Cart updated']);
        }

        return response()->json(['success' => false, 'message' => 'Nothing to update'], 400);
    }

    public function remove(Request $request, $id)
    {
        if ($id) {
            $cart = session()->get('cart');
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);

                // Sync with DB
                 if (auth()->check()) {
                     $parts = explode('_', $id);
                     if (count($parts) >= 2 && $parts[0] === 'book') {
                         $bookId = $parts[1];
                         \App\Models\Cart::where('user_id', auth()->id())
                             ->where('book_id', $bookId)
                             ->delete();
                     } elseif (count($parts) >= 3) {
                         $productId = $parts[0];
                         $printQuantity = $parts[1];
                         $urgency = $parts[2];

                         \App\Models\Cart::where('user_id', auth()->id())
                             ->where('product_id', $productId)
                             ->where('print_quantity', $printQuantity)
                             ->where('urgency', $urgency)
                             ->delete();
                     }
                 }
                
                if ($request->ajax()) {
                    $cart = session()->get('cart', []);
                    $count = 0;
                    $subtotal = 0;
                    $total_discount = 0;

                    foreach($cart as $c) {
                        $count += $c['quantity'];
                        $item_original_total = ($c['original_price'] ?? $c['price']) * $c['quantity'];
                        $item_selling_total = $c['price'] * $c['quantity'];
                        
                        $subtotal += $item_original_total;
                        $total_discount += ($item_original_total - $item_selling_total);
                    }
                    
                    $after_discount = $subtotal - $total_discount;
                    $tax = $after_discount * 0.15;
                    $grand_total = $after_discount + $tax;

                    return response()->json([
                        'success' => true,
                        'message' => __('messages.product_removed_from_cart'),
                        'cartCount' => $count,
                        'cartTotal' => format_price($after_discount),
                        'subtotal' => format_price($subtotal),
                        'discount' => format_price($total_discount),
                        'tax' => format_price($tax),
                        'grandTotal' => format_price($grand_total),
                        'isEmpty' => $count == 0
                    ]);
                }
            }
            return redirect()->back()->with('success', __('messages.product_removed_from_cart'));
        }
    }

    protected function addBook(Request $request, $id)
    {
        $book = \App\Models\Book::findOrFail($id);
        $cart = session()->get('cart', []);

        $quantity = (int) $request->input('quantity', 1);
        $price = (float) $book->price;
        $originalPrice = (float) $book->price;

        if ($quantity <= 0) {
            return redirect()->back()->with('error', 'Please select a valid quantity.');
        }

        $cartId = 'book_' . $id;

        if (isset($cart[$cartId])) {
            $cart[$cartId]['quantity'] += $quantity;
        } else {
            $cart[$cartId] = [
                "book_id" => $book->id,
                "name" => $book->name_en,
                "name_ar" => $book->name_ar,
                "quantity" => $quantity,
                "price" => $price,
                "original_price" => $originalPrice,
                "image" => ($book->images && count($book->images) > 0) ? $book->images[0] : 'assets/images/products/product-1.jpg',
                "slug" => $book->slug,
                "type" => "book",
                "options" => [
                    "author" => $book->author ? $book->author->name : 'N/A',
                    "publisher" => $book->publisher ? $book->publisher->name : 'N/A'
                ]
            ];
        }

        session()->put('cart', $cart);

        if (auth()->check()) {
            $user = auth()->user();
            $existingCartItem = \App\Models\Cart::where('user_id', $user->id)
                ->where('book_id', $book->id)
                ->first();

            if ($existingCartItem) {
                $existingCartItem->quantity += $quantity;
                $existingCartItem->save();
            } else {
                \App\Models\Cart::create([
                    'user_id' => $user->id,
                    'book_id' => $book->id,
                    'type' => 'book',
                    'quantity' => $quantity,
                    'price' => $price,
                    'production_days' => 0,
                    'delivery_days' => 1,
                    'options' => json_encode([
                        "author" => $book->author ? $book->author->name : 'N/A',
                        "publisher" => $book->publisher ? $book->publisher->name : 'N/A'
                    ])
                ]);
            }
        }

        if ($request->ajax()) {
            $cartCount = count(session('cart'));
            return response()->json([
                'success' => true,
                'message' => __('messages.product_added_to_cart'),
                'cartCount' => $cartCount
            ]);
        }

        return redirect()->back()->with('success', __('messages.product_added_to_cart'));
    }

    public function dropdown()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        $count = 0;
        foreach((array) $cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
            $count += $details['quantity'];
        }
        
        return response()->json([
            'html' => view('frontend.partials.cart-dropdown', compact('cart'))->render(),
            'total' => format_price($total),
            'count' => $count
        ]);
    }
}
