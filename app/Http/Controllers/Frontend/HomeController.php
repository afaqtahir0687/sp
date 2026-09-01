<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageMail;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = \App\Models\Slider::where('status', 'active')->get();
        $conceptBanners = \App\Models\Banner::where('status', 'active')->where('type', 'concept')->get();
        $bigSaleBanner = \App\Models\Banner::where('status', 'active')->where('type', 'big_sale')->first();
        $promoBanner = \App\Models\Banner::where('status', 'active')->where('type', 'promo')->first();
        $featuredProducts = \App\Models\Product::with(['category', 'subcategory'])->where('is_featured', true)->where('status', 'active')->orderBy('id', 'asc')->take(10)->get();
        $newArrivals = \App\Models\Product::with(['category', 'subcategory'])->where('is_new_arrival', true)->where('status', 'active')->orderBy('id', 'asc')->take(10)->get();
        $categories = \App\Models\Category::where('status', 'active')->withCount('products')->get();
        $services = \App\Models\Service::where('status', 'active')->get();
        $printingTechnologies = \App\Models\PrintingTechnology::where('status', 'active')->orderBy('id', 'asc')->get();
        $industries = \App\Models\Industry::where('status', 'active')->orderBy('id', 'asc')->get();
        $clients = \App\Models\Client::where('status', 'active')->orderBy('sort_order')->get();
        $testimonials = \App\Models\Testimonial::where('status', 'active')->orderBy('sort_order')->get();
        
        return view('frontend.index', compact('sliders', 'conceptBanners', 'bigSaleBanner', 'promoBanner', 'featuredProducts', 'newArrivals', 'categories', 'services', 'printingTechnologies', 'industries', 'clients', 'testimonials'));
    }
    public function aboutUs()
    {
        return view('frontend.header-pages.about-us');
    }

    public function visionMission()
    {
        return view('frontend.header-pages.vision-mission');
    }
    public function ceoMessage()
    {
        return view('frontend.header-pages.ceo-message');
    }
    public function companyProfile()
    {
        return view('frontend.header-pages.company-profile');
    }
    public function servicesPage()
    {
        return view('frontend.header-pages.services');
    }
    public function clientsPage()
    {
        return view('frontend.header-pages.clients');
    }
    public function careersPage()
    {
        return view('frontend.header-pages.careers');
    }
     public function blogs()
    {
        return view('frontend.header-pages.blogs');
    }
     public function single()
    {
        return view('frontend.header-pages.single');
    }
    public function wishlist()
    {
        $wishlistIds = array_keys(session()->get('wishlist', []));
        $products = \App\Models\Product::with(['category', 'subcategory'])->whereIn('id', $wishlistIds)->where('status', 'active')->latest()->get();
        
        $blankWishlistIds = array_keys(session()->get('wishlist_blank', []));
        $blankProducts = \App\Models\BlankProduct::whereIn('id', $blankWishlistIds)->where('status', 'active')->latest()->get();
        
        return view('frontend.header-pages.wishlist', compact('products', 'blankProducts'));
    }
    public function cart()
    {
        return view('frontend.header-pages.cart');
    }
    public function checkout()
    {
        $cart = session()->get('cart', []);
        $user = auth()->user();

        // Calculate totals — same logic as cart.blade.php
        $subtotal       = 0;
        $total_discount = 0;

        foreach ($cart as $id => $details) {
            $qty              = (int) ($details['quantity'] ?? 1);
            $unit_price       = (float) ($details['price'] ?? 0);
            $unit_orig_price  = (float) ($details['original_price'] ?? $unit_price);

            $item_original_total = $unit_orig_price * $qty;
            $item_selling_total  = $unit_price * $qty;

            $subtotal       += $item_original_total;
            $total_discount += ($item_original_total - $item_selling_total);
        }

        // after_discount = actual amount to charge (selling total)
        $after_discount = $subtotal - $total_discount;
        $tax            = round($after_discount * 0.15, 2); // 15% VAT
        $grand_total    = round($after_discount + $tax, 2);

        $countries = \App\Models\Country::all();

        return view('frontend.header-pages.checkout', compact(
            'cart', 'user',
            'subtotal', 'total_discount', 'after_discount',
            'tax', 'grand_total',
            'countries'
        ));
    }
    public function orderComplete()
    {
        return view('frontend.header-pages.order-complete');
    }
    public function contactUs()
    {
        $setting = \App\Models\ContactSetting::first();
        $faqs = \App\Models\Faq::where('status', 'active')->get();
        return view('frontend.pages.contacts.contact-us', compact('setting', 'faqs'));
    }

    public function submitContactMessage(Request $request)
    {
        $request->validate([
            'contact-name' => 'required|string|max:255',
            'contact-email' => 'required|email|max:255',
            'contact-message' => 'required|string',
        ]);

        $message = \App\Models\ContactMessage::create([
            'name' => $request->input('contact-name'),
            'email' => $request->input('contact-email'),
            'message' => $request->input('contact-message'),
            'is_read' => false,
        ]);

        try {
            // Send email to admin
            $adminEmail = env('MAIL_FROM_ADDRESS', 'afaqtahir0687@gmail.com');
            $setting = \App\Models\ContactSetting::first();
            if ($setting && $setting->email) {
                $adminEmail = $setting->email;
            }

            Mail::to($adminEmail)->send(new ContactMessageMail($message->toArray()));
        } catch (\Exception $e) {
            \Log::error('Failed to send contact message email: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }

    public function requestVisit()
    {
        $setting = \App\Models\ContactSetting::first();
        return view('frontend.pages.request-visit', compact('setting'));
    }

    public function submitRequestVisit(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile_number' => 'required|string|max:20',
            'address' => 'required|string',
            'message' => 'nullable|string',
            'preferred_dates' => 'required|array',
            'preferred_dates.*' => 'required|date',
        ]);

        // Save to database
        $visitRequest = \App\Models\SalesVisitRequest::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'address' => $request->address,
            'preferred_dates' => $request->preferred_dates,
            'message' => $request->message,
            'is_read' => false,
        ]);

        try {
            $adminEmail = env('MAIL_FROM_ADDRESS', 'afaqtahir0687@gmail.com');
            $setting = \App\Models\ContactSetting::first();
            if ($setting && $setting->email) {
                $adminEmail = $setting->email;
            }

            Mail::to($adminEmail)->send(new \App\Mail\SalesVisitRequestMail($request->all()));
        } catch (\Exception $e) {
            \Log::error('Failed to send sales visit request email: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'There was an error sending your request. Please try again later.');
        }

        return redirect()->back()->with('success', 'Your request for a sales visit has been submitted successfully! We will contact you soon.');
    }

    public function trackOrder(Request $request)
    {
        $order = null;
        if ($request->isMethod('post')) {
            $request->validate([
                'order_number' => 'required|string',
                'email' => 'required|email',
            ]);

            $order = \App\Models\Order::with('items')
                ->where('order_number', $request->order_number)
                ->where('email', $request->email)
                ->first();

            if (!$order) {
                return redirect()->back()->withInput()->with('error', 'Order not found with provided details.');
            }
        }

        return view('frontend.pages.track-order', compact('order'));
    }

    public function getLatestProductsForPopup()
    {
        $products = \App\Models\Product::with(['category', 'subcategory'])
            ->where('status', 'active')
            ->latest()
            ->take(10)
            ->get();

        return response()->json([
            'products' => $products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'image' => $product->image ? asset('storage/' . $product->image) : asset('assets/images/products/product-3.jpg'),
                    'price' => $product->price,
                    'discount_price' => $product->discount_price,
                    'category_slug' => $product->category ? $product->category->slug : null,
                    'subcategory_slug' => $product->subcategory ? $product->subcategory->slug : null,
                ];
            })
        ]);
    }

    public function submitInquiry(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'number' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        \App\Models\Inquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'message' => $request->message,
            'is_read' => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your inquiry has been submitted successfully!'
        ]);
    }
}

