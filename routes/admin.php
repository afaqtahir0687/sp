<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BlankProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BookCategoryController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\SeoSettingController;
use App\Http\Controllers\Admin\PrintingTechnologyController;
use App\Http\Controllers\Admin\IndustryController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');

    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('sliders', SliderController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('banners', BannerController::class);
        Route::resource('printing-technologies', PrintingTechnologyController::class);
        Route::resource('industries', IndustryController::class);
        Route::resource('clients', ClientController::class);
        Route::resource('testimonials', TestimonialController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('subcategories', SubcategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('blank-products', BlankProductController::class);
        Route::resource('blank-categories', \App\Http\Controllers\Admin\BlankCategoryController::class);
        Route::resource('blank-subcategories', \App\Http\Controllers\Admin\BlankSubCategoryController::class);
        Route::resource('portfolios', \App\Http\Controllers\Admin\PortfolioController::class);
        
        // SEO Settings
        Route::resource('seo-settings', SeoSettingController::class);
        
        // Books Management
        Route::resource('book-categories', BookCategoryController::class);
        Route::resource('authors', AuthorController::class);
        Route::resource('publishers', PublisherController::class);
        Route::resource('books', BookController::class);
        
        Route::get('get-subcategories/{category_id?}', [SubcategoryController::class, 'getSubcategories'])->name('get-subcategories');
        Route::get('get-blank-subcategories/{category_id?}', [\App\Http\Controllers\Admin\BlankSubCategoryController::class, 'getSubcategories'])->name('get-blank-subcategories');
        Route::get('carts', [CartController::class, 'index'])->name('carts.index');
        Route::resource('orders', OrderController::class)->only(['index', 'show', 'destroy']);
        Route::post('orders/{id}/update-status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
        Route::resource('users', UserController::class)->only(['index', 'destroy']);
        
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

        Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');

        // Contact Page Management
        Route::get('contact-settings', [\App\Http\Controllers\Admin\ContactSettingController::class, 'index'])->name('contact-settings.index');
        Route::post('contact-settings', [\App\Http\Controllers\Admin\ContactSettingController::class, 'update'])->name('contact-settings.update');
        
        Route::resource('faqs', \App\Http\Controllers\Admin\FaqController::class);
        
        Route::get('contact-messages', [\App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('contact-messages.index');
        Route::get('contact-messages/{id}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'show'])->name('contact-messages.show');
        Route::delete('contact-messages/{id}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');

        Route::get('sales-visits', [\App\Http\Controllers\Admin\SalesVisitRequestController::class, 'index'])->name('sales-visits.index');
        Route::get('sales-visits/{id}', [\App\Http\Controllers\Admin\SalesVisitRequestController::class, 'show'])->name('sales-visits.show');
        Route::delete('sales-visits/{id}', [\App\Http\Controllers\Admin\SalesVisitRequestController::class, 'destroy'])->name('sales-visits.destroy');

        Route::resource('inquiries', \App\Http\Controllers\Admin\InquiryController::class)->only(['index', 'show', 'destroy']);
    });
});
