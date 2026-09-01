<?php

use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\BlankProductController;
use App\Http\Controllers\Frontend\BookController;
use Illuminate\Support\Facades\Route;


// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');


// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('login.store');
    Route::get('/register', [AuthController::class, 'create'])->name('register');
    Route::post('/register', [AuthController::class, 'storeRegistration'])->name('register.store');

    // Password Reset Routes
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/verify-reset-otp', [AuthController::class, 'showVerifyResetOtp'])->name('password.verify.otp');
    Route::post('/verify-reset-otp', [AuthController::class, 'verifyResetOtp'])->name('password.verify.otp.post');
    Route::match(['get', 'post'], '/resend-reset-otp', [AuthController::class, 'resendResetOtp'])->name('password.resend.otp');
    Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

    // OTP Verification Routes
    Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])->name('otp.verify');
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('otp.verify.store');
    Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('otp.resend');
});

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Wishlist
    Route::get('/wishlist', [HomeController::class, 'wishlist'])->name('wishlist.index');
    Route::get('/remove-from-wishlist/{id}/{type?}', [App\Http\Controllers\Frontend\WishlistController::class, 'remove'])->name('wishlist.remove');

    // Checkout & Orders
    Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order-complete', [HomeController::class, 'orderComplete'])->name('order.complete');
    Route::get('/track-order', [HomeController::class, 'trackOrder'])->name('track.order');
    Route::post('/track-order', [HomeController::class, 'trackOrder'])->name('track.order.post');
    Route::post('/order/{id}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');
});

// Cart Routes (accessible to guests)
Route::get('/cart', [HomeController::class, 'cart'])->name('cart.index');
Route::get('/add-to-cart/{id}', [App\Http\Controllers\Frontend\CartController::class, 'add'])->name('cart.add');
Route::patch('/update-cart', [App\Http\Controllers\Frontend\CartController::class, 'update'])->name('cart.update');
Route::get('/remove-from-cart/{id}', [App\Http\Controllers\Frontend\CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart-dropdown', [App\Http\Controllers\Frontend\CartController::class, 'dropdown'])->name('cart.dropdown');

// Wishlist Add Route (accessible to guests for redirect handling)
Route::get('/add-to-wishlist/{id}/{type?}', [App\Http\Controllers\Frontend\WishlistController::class, 'add'])->name('wishlist.add');

// Language Switcher
Route::get('/language/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'ar'])) {
        session()->put('locale', $lang);
        session()->save();
    }
    return back();
})->name('language.switch');

// Public Pages
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about.index');
Route::get('/vision-mission', [HomeController::class, 'visionMission'])->name('vision.mission');
Route::get('/ceo-message', [HomeController::class, 'ceoMessage'])->name('ceo.message');
Route::get('/company-profile', [HomeController::class, 'companyProfile'])->name('company.profile');
Route::get('/services', [HomeController::class, 'servicesPage'])->name('services.page');
Route::get('/clients', [HomeController::class, 'clientsPage'])->name('clients.page');
Route::get('/careers', [HomeController::class, 'careersPage'])->name('careers.page');
Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs.index');
Route::get('/single', [HomeController::class, 'single'])->name('single.index');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact.index');
Route::post('/contact-us', [HomeController::class, 'submitContactMessage'])->name('contact.submit');
Route::post('/submit-inquiry', [HomeController::class, 'submitInquiry'])->name('inquiry.submit');
Route::get('/request-visit', [HomeController::class, 'requestVisit'])->name('request.visit');
Route::post('/request-visit', [HomeController::class, 'submitRequestVisit'])->name('request.visit.submit');

// Currency Switching
Route::get('currency-switch/{currency}', [App\Http\Controllers\Frontend\CurrencyController::class, 'switch'])->name('currency.switch');

// Original generic indices
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Location Routes
Route::get('/get-states/{countryId}', [App\Http\Controllers\Frontend\LocationController::class, 'getStates'])->name('get.states');
Route::get('/get-cities/{stateId}', [App\Http\Controllers\Frontend\LocationController::class, 'getCities'])->name('get.cities');


// Hierarchical Product and Category Routes (Matching Zeejprint)
// These must be last to avoid catching other static routes
Route::get('/test-email', function () {
    try {
        \Illuminate\Support\Facades\Mail::raw('This is a test email from the server.', function ($message) {
            $message->to('afaqtahir0687@gmail.com')
                    ->subject('Server Email Test');
        });
        return 'Email sent successfully via SMTP!';
    } catch (\Exception $e) {
        return 'Error sending email: ' . $e->getMessage();
    }
});

// Blank Products Routes (Must be before dynamic category routes)
Route::get('/blank-products', [BlankProductController::class, 'index'])->name('blank-products.index');
Route::get('/blank-products/{slug}', [BlankProductController::class, 'show'])->name('blank-products.show');

// Books Routes (Must be before dynamic category routes)
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{slug}', [BookController::class, 'show'])->name('books.show');

// API Routes for dynamic content
Route::get('/api/latest-products', [HomeController::class, 'getLatestProductsForPopup'])->name('api.latest-products');

Route::get('/{category_slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/{category_slug}/{subcategory_slug}', [CategoryController::class, 'show'])->name('subcategory.show');
Route::get('/{category_slug}/{subcategory_slug}/{product_slug}', [ProductController::class, 'show'])->name('product.show');





// Fix for incorrect storage paths globally
Route::get('storage/app/public/{path}', function ($path) {
    return redirect('storage/' . $path, 301);
})->where('path', '.*');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Admin routes are now defined in routes/admin.php
|
*/
