@extends('frontend.layouts.master')
@section('title', __('home.title'))
@section('meta_description', __('home.meta_description'))
@section('meta_keywords', __('home.meta_keywords'))
@section('content')

    <div class="main-content">
    <div class="home-slider slide-animate owl-carousel owl-theme show-nav-hover nav-big mb-2 text-uppercase"
        data-owl-options="{ 'rtl': {{ app()->getLocale() == 'ar' ? 'true' : 'false' }},
                'loop': false
             }">

        @if(isset($sliders) && $sliders->count() > 0)

            {{-- ✅ Dynamic sliders --}}
            @foreach($sliders as $slider)
                <div class="home-slide home-slide1 banner">
                    <img class="slide-bg" src="{{ asset('storage/app/public/' . $slider->image) }}" width="1903" height="499"
                        alt="slider image">

                    <div class="container d-flex align-items-center">
                        <div class="banner-layer appear-animate" data-animation-name="fadeInUpShorter">
                            <h4 class="text-transform-none m-b-3"{{ $slider->text_color ? ' style=color:' . $slider->text_color . ';' : '' }}>{{ $slider->title }}</h4>
                            <h2 class="text-transform-none mb-0"{{ $slider->text_color ? ' style=color:' . $slider->text_color . ';' : '' }}>{{ $slider->subtitle }}</h2>
                             <h3 class="m-b-3" {{ $slider->text_color ? ' style=color:' . $slider->text_color . ';' : '' }}>
                                    {{ $slider->offer_text }}
                                </h3>

                            @if($slider->link)
                                <a href="{{ $slider->link }}" class="btn btn-dark btn-lg">
                                    {{ __('home.shop_now') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

        @else

            {{-- ❌ Static sliders (unchanged HTML) --}}
            <div class="home-slide home-slide1 banner">
                <img class="slide-bg" src="{{ asset('assets/images/demoes/demo4/slider/slide-1.jpeg') }}" width="1903"
                    height="499" alt="slider image">

                <div class="container d-flex align-items-center">
                    <div class="banner-layer appear-animate" data-animation-name="fadeInUpShorter">
                        <h4 class="text-transform-none m-b-3">{{ __('home.slider1_title') }}</h4>
                        <h2 class="text-transform-none mb-0">{{ __('home.slider1_subtitle') }}</h2>
                        <h3 class="m-b-3">{{ __('home.off') }}</h3>
                        <h5 class="d-inline-block mb-0">
                            <span>{{ __('home.starting_at') }}</span>
                            <b class="coupon-sale-text text-white bg-secondary align-middle">
                                {!! format_price(199.99) !!}
                            </b>
                        </h5>
                        <a href="{{ route('category.index') }}" class="btn btn-dark btn-lg">
                            {{ __('home.shop_now') }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="home-slide home-slide2 banner banner-md-vw">
                <img class="slide-bg" src="{{ asset('assets/images/demoes/demo4/slider/slide-2.jpeg') }}" width="1903"
                    height="499" alt="slider image">

                <div class="container d-flex align-items-center">
                    <div class="banner-layer d-flex justify-content-center appear-animate"
                        data-animation-name="fadeInUpShorter">
                        <div class="mx-auto">
                            <h4 class="m-b-1">{{ __('home.slider2_extra') }}</h4>
                            <h3 class="m-b-2">20% {{ __('home.off') }}</h3>
                            <h3 class="mb-2 heading-border">{{ __('home.slider2_accessories') }}</h3>
                            <h2 class="text-transform-none m-b-4">{{ __('home.slider1_subtitle') }}</h2>
                            <a href="{{ route('category.index') }}" class="btn btn-block btn-dark">
                                {{ __('home.shop_all_sale') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        @endif
    </div>



    <div class="container">
        <h2 style="text-align: center;">{{ __('home.concept_to_delivery') }}</h2>
        <p style="text-align: center;">{{ __('home.fuel_your_business') }}</p>
        <div class="info-boxes-slider owl-carousel owl-theme mb-2" data-owl-options="{ 'rtl': {{ app()->getLocale() == 'ar' ? 'true' : 'false' }},
                                'dots': false,
                                'loop': false,
                                'responsive': {
                                    '576': {
                                        'items': 2
                                    },
                                    '992': {
                                        'items': 3
                                    }
                                }
                            }">
            @if(isset($services) && $services->count() > 0)
                @foreach($services as $service)
                    <div class="info-box info-box-icon-left">
                        <i
                            class="{{ strpos($service->icon, 'fa-') !== false ? 'fas ' : '' }}{{ $service->icon ?? 'icon-shipping' }}"></i>

                        <div class="info-box-content">
                            <h4>{{ $service->title }}</h4>
                            <p class="text-body">{{ $service->description }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="info-box info-box-icon-left">
                    <i class="icon-shipping"></i>

                    <div class="info-box-content">
                        <h4>{{ __('home.free_shipping_return') }}</h4>
                        <p class="text-body">{{ __('home.free_shipping_text', ['price' => format_price(99)]) }}</p>
                    </div>
                </div>

                <div class="info-box info-box-icon-left" style="align-items: center;">
                    <span class="info-box-icon"
                        style="width: 50px; min-width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">

                        <img src="{{ asset('assets/images/demoes/demo4/banners/rial.jpg') }}" alt="Money Back"
                            style="width: 40px; height: 40px; object-fit: contain; display: block;">
                    </span>

                    <div class="info-box-content"
                        style="{{ app()->getLocale() == 'ar' ? 'padding-left: 12px; padding-right: 0;' : 'padding-left: 12px;' }}">
                        <h4>{{ __('home.money_back_guarantee') }}</h4>
                        <p class="text-body">{{ __('home.money_back_text') }}</p>
                    </div>
                </div>

                <div class="info-box info-box-icon-left">
                    <i class="icon-support"></i>

                    <div class="info-box-content">
                        <h4>{{ __('home.online_support') }}</h4>
                        <p class="text-body">{{ __('home.online_support_text') }}</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="banners-container mb-2">
            <div class="banners-slider owl-carousel owl-theme" data-owl-options="{ 'rtl': {{ app()->getLocale() == 'ar' ? 'true' : 'false' }},
                                     'dots': false
                                 }">
                @if(isset($conceptBanners) && $conceptBanners->count() > 0)
                    @foreach($conceptBanners as $index => $banner)
                        @php
                            $animationName = 'fadeInUpShorter';
                            $animationDelay = '200';
                            if ($index == 0) {
                                $animationName = 'fadeInLeftShorter';
                                $animationDelay = '500';
                            } elseif ($index == 2) {
                                $animationName = 'fadeInRightShorter';
                                $animationDelay = '500';
                            }
                        @endphp
                        <div class="banner banner{{ $index + 1 }} banner-sm-vw d-flex align-items-center appear-animate"
                                style="background-color: #ccc;" data-animation-name="{{ $animationName }}"
                                data-animation-delay="{{ $animationDelay }}">
                                <figure class="w-100">
                                    <img src="{{ asset('storage/app/public/' . $banner->image) }}" alt="{{ $banner->title }}" width="380"
                                        height="175" style="border: 12px solid #153045;" />
                                </figure>
                            <div class="banner-layer {{ $index == 1 ? 'text-center' : ($index == 2 ? 'text-right' : '') }}">
                                @if($index == 1)
                                    <div class="row align-items-lg-center text-uppercase">
                                        <div class="col-lg-7 text-lg-right">
                                            <h3>{{ $banner->title }}</h3>
                                        </div>
                                        <div class="col-lg-5 text-lg-left px-0 px-xl-3">
                                            <a href="{{ $banner->link ?? route('category.index') }}"
                                                class="btn btn-sm btn-dark">{{ $banner->button_text ?? 'Order Now' }}</a>
                                        </div>
                                    </div>
                                @else
                                    <h3 class="m-b-2">{{ $banner->title }}</h3>
                                    <a href="{{ $banner->link ?? route('category.index') }}"
                                        class="btn btn-sm btn-dark">{{ $banner->button_text ?? 'Check Credit' }}</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="banner banner1 banner-sm-vw d-flex align-items-center appear-animate"
                        style="background-color: #ccc;" data-animation-name="fadeInLeftShorter" data-animation-delay="500">
                        <figure class="w-100">
                            <img src="{{ asset('assets/images/demoes/demo4/banners/banner-1.jpg') }}" alt="banner" width="380"
                                height="175" />
                        </figure>
                        <div class="banner-layer">
                            <h3 class="m-b-2">{{ __('home.credit_terms') }}</h3>
                            <a href="{{ route('category.index') }}"
                                class="btn btn-sm btn-dark">{{ __('home.check_credit') }}</a>
                        </div>
                    </div>

                    <div class="banner banner2 banner-sm-vw text-uppercase d-flex align-items-center appear-animate"
                        data-animation-name="fadeInUpShorter" data-animation-delay="200">
                        <figure class="w-100">
                            <img src="{{ asset('assets/images/demoes/demo4/banners/banner-2.jpg') }}"
                                style="background-color: #ccc;" alt="banner" width="380" height="175" />
                        </figure>
                        <div class="banner-layer text-center">
                            <div class="row align-items-lg-center">
                                <div class="col-lg-7 text-lg-right">
                                    <h3>{{ __('home.design_services') }}</h3>
                                </div>
                                <div class="col-lg-5 text-lg-left px-0 px-xl-3">
                                    <a href="{{ route('category.index') }}"
                                        class="btn btn-sm btn-dark">{{ __('home.order_now') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="banner banner3 banner-sm-vw d-flex align-items-center appear-animate"
                        style="background-color: #ccc;" data-animation-name="fadeInRightShorter" data-animation-delay="500">
                        <figure class="w-100">
                            <img src="{{ asset('assets/images/demoes/demo4/banners/banner-3.jpg') }}" alt="banner" width="380"
                                height="175" />
                        </figure>
                        <div class="banner-layer text-right">
                            <h3 class="m-b-2">{{ __('home.express_delivery') }}</h3>
                            <a href="{{ route('category.index') }}"
                                class="btn btn-sm btn-dark">{{ __('home.see_products') }}</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    
    <section class="categories-section pb-4">
        <div class="container">
            <h2 class="section-title categories-section-title heading-border border-0 ls-0 appear-animate"
                data-animation-delay="100" data-animation-name="fadeInUpShorter">
                {{ app()->getLocale() == 'ar' ? 'تصفح فئاتنا' : 'Browse Our Categories' }}
            </h2>

            <div class="categories-slider owl-carousel owl-theme show-nav-hover nav-outer">

                @if(isset($categories) && $categories->count() > 0)

                    {{-- ✅ Dynamic Categories --}}
                    @foreach($categories as $category)
                        <div class="product-category appear-animate" data-animation-name="fadeInUpShorter">
                            <a href="{{ route('category.show', $category->slug) }}">
                                <figure>
                                    <img src="{{ $category->home_image ? asset('storage/app/public/' . $category->home_image) : asset('storage/app/public/' . $category->image) }}" alt="{{ $category->name }}" width="280"
                                        height="240" style="width: 100%; height: 240px; object-fit: contain;" />
                                </figure>
                                <div class="category-content">
                                    <h3>{{ $category->name }}</h3>
                                    <span>
                                        <mark class="count">{{ $category->products_count }}</mark> {{ app()->getLocale() == 'ar' ? 'منتجات' : 'products' }}
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endforeach

                @else

                    {{-- ❌ Static Categories (UNCHANGED HTML) --}}
                    <div class="product-category appear-animate" data-animation-name="fadeInUpShorter">
                        <a href="{{ route('category.index') }}">
                            <figure>
                                <img src="{{ asset('assets/images/demoes/demo4/products/categories/category-1.jpg') }}"
                                    alt="category" width="280" height="240" />
                            </figure>
                            <div class="category-content">
                                <h3>Stationery</h3>
                                <span><mark class="count">3</mark> {{ app()->getLocale() == 'ar' ? 'منتجات' : 'products' }}</span>
                            </div>
                        </a>
                    </div>

                    <div class="product-category appear-animate" data-animation-name="fadeInUpShorter">
                        <a href="{{ route('category.index') }}">
                            <figure>
                                <img src="{{ asset('assets/images/demoes/demo4/products/categories/category-2.jpg') }}"
                                    alt="category" width="220" height="220" />
                            </figure>
                            <div class="category-content">
                                <h3>Promotional</h3>
                                <span><mark class="count">3</mark> {{ app()->getLocale() == 'ar' ? 'منتجات' : 'products' }}</span>
                            </div>
                        </a>
                    </div>

                    <div class="product-category appear-animate" data-animation-name="fadeInUpShorter">
                        <a href="{{ route('category.index') }}">
                            <figure>
                                <img src="{{ asset('assets/images/demoes/demo4/products/categories/category-3.jpg') }}"
                                    alt="category" width="220" height="220" />
                            </figure>
                            <div class="category-content">
                                <h3>Packaging & Boxes</h3>
                                <span><mark class="count">3</mark> {{ app()->getLocale() == 'ar' ? 'منتجات' : 'products' }}</span>
                            </div>
                        </a>
                    </div>

                    <div class="product-category appear-animate" data-animation-name="fadeInUpShorter">
                        <a href="{{ route('category.index') }}">
                            <figure>
                                <img src="{{ asset('assets/images/demoes/demo4/products/categories/category-4.jpg') }}"
                                    alt="category" width="220" height="220" />
                            </figure>
                            <div class="category-content">
                                <h3>Event Branding</h3>
                                <span><mark class="count">3</mark> {{ app()->getLocale() == 'ar' ? 'منتجات' : 'products' }}</span>
                            </div>
                        </a>
                    </div>

                    <div class="product-category appear-animate" data-animation-name="fadeInUpShorter">
                        <a href="{{ route('category.index') }}">
                            <figure>
                                <img src="{{ asset('assets/images/demoes/demo4/products/categories/category-6.jpg') }}"
                                    alt="category" width="220" height="220" />
                            </figure>
                            <div class="category-content">
                                <h3>Large Printing</h3>
                                <span><mark class="count">3</mark> {{ app()->getLocale() == 'ar' ? 'منتجات' : 'products' }}</span>
                            </div>
                        </a>
                    </div>

                    <div class="product-category appear-animate" data-animation-name="fadeInUpShorter">
                        <a href="{{ route('category.index') }}">
                            <figure>
                                <img src="{{ asset('assets/images/demoes/demo4/products/categories/category-5.jpg') }}"
                                    alt="category" width="220" height="220" />
                            </figure>
                            <div class="category-content">
                                <h3>Marketing Materials</h3>
                                <span><mark class="count">3</mark> {{ app()->getLocale() == 'ar' ? 'منتجات' : 'products' }}</span>
                            </div>
                        </a>
                    </div>

                @endif

            </div>
        </div>
    </section>

    <section class="featured-products-section">
        <div class="container">
            <h2 class="section-title heading-border ls-20 border-0">{{ __('home.featured_products') }}</h2>

            <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center"
                data-owl-options="{ 'rtl': {{ app()->getLocale() == 'ar' ? 'true' : 'false' }},
                            'dots': false,
                            'nav': true,
                            'smartSpeed': 300
                        }">
                @if(isset($featuredProducts) && $featuredProducts->count() > 0)
                    @foreach($featuredProducts as $product)
                        <div class="product-default">
                             <figure>
                                <a
                                    href="{{ route('product.show', [$product->category->slug, $product->subcategory->slug ?? 'no-sub', $product->slug]) }}">
                                    <img src="{{ asset('storage/app/public/' . $product->image) }}" width="280" height="280"
                                        alt="{{ $product->name }}">
                                    @if($product->images && count($product->images) > 0)
                                        <img src="{{ asset('storage/app/public/' . $product->images[0]) }}" width="280" height="280"
                                            alt="{{ $product->name }}">
                                    @endif
                                </a>
                                @php
                                    $hasActiveDiscount = false;
                                    if ($product->discount_price > 0) {
                                        if (is_null($product->discount_end_date) || \Carbon\Carbon::parse($product->discount_end_date)->isFuture() || \Carbon\Carbon::parse($product->discount_end_date)->isToday()) {
                                            $hasActiveDiscount = true;
                                        }
                                    }
                                @endphp
                                <div class="label-group">
                                    @if($product->is_featured)
                                        <div class="product-label label-hot">{{ __('home.hot') }}</div>
                                    @endif
                                    @if($hasActiveDiscount && $product->discount_price > 0)
                                        @php
                                            $discount = round(($product->discount_price / $product->price) * 100);
                                        @endphp
                                        @if($discount > 0)
                                            <div class="product-label label-sale">{{ $discount }}% {{ __('home.off') }}</div>
                                        @endif
                                    @endif
                                </div>
                            </figure>
                            <div class="product-details">
                                <div class="category-list">
                                    @if($product->category)
                                        <a href="{{ route('category.show', $product->category->slug) }}"
                                            class="product-category">{{ $product->category->name }}</a>
                                    @else
                                        <a href="#" class="product-category">{{ __('home.uncategorized') }}</a>
                                    @endif
                                </div>
                                <h3 class="product-title">
                                    <a
                                        href="{{ route('product.show', [$product->category->slug, $product->subcategory->slug ?? 'no-sub', $product->slug]) }}">{{ $product->name }}</a>
                                </h3>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:100%"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                </div>
                                <div class="price-box">
                                    @if($hasActiveDiscount && $product->discount_price > 0)
                                        <del class="old-price">{{ format_price($product->price) }}</del>
                                        <span class="product-price">{{ format_price($product->price - $product->discount_price) }}</span>
                                    @else
                                        <span class="product-price">{{ format_price($product->price) }}</span>
                                    @endif
                                </div>
                                <div class="product-action">
                                    <a href="#" class="btn-icon-wish" title="wishlist" data-wishlist-id="{{ $product->id }}" data-wishlist-type="product"><i class="icon-heart"></i></a>
                                    <a href="{{ $product->subcategory ? route('subcategory.show', [$product->category->slug, $product->subcategory->slug]) : route('products.index') }}"
                                        class="btn-icon btn-add-cart"><i
                                            class="fa fa-arrow-right"></i><span>{{ __('home.select_options') }}</span></a>
                                    <a href="{{ route('product.show', [$product->category->slug, $product->subcategory->slug ?? 'no-sub', $product->slug]) }}" class="btn-quickview" title="Quick View"><i
                                            class="fas fa-external-link-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                        <figure>
                            <a href="{{ route('products.index') }}">
                                <img src="{{ asset('assets/images/products/product-1.jpg') }}" width="280" height="280"
                                    alt="product">
                                <img src="{{ asset('assets/images/products/product-1-2.jpg') }}" width="280" height="280"
                                    alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-hot">{{ __('home.hot') }}</div>
                                <div class="product-label label-sale">20% {{ __('home.off') }}</div>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="#" class="product-category">{{ __('home.category') }}</a>
                            </div>
                            <h3 class="product-title">
                                <a href="#">{{ __('home.business_card_front_back') }}</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <del class="old-price">{{ format_price(200.00) }}</del>
                                <span class="product-price">{{ format_price(150.00) }}</span>
                            </div>
                            <!-- End .price-box -->
                            <!-- <div class="product-action">
                                        <a href="#" class="btn-icon-wish" title="wishlist"><i class="icon-heart"></i></a>
                                        <a href="#" class="btn-icon btn-add-cart"><i class="fa fa-arrow-right"></i><span>SELECT
                                                OPTIONS</span></a>
                                        <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i
                                                class="fas fa-external-link-alt"></i></a>
                                    </div> -->
                        </div>
                    </div>
                    <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                        <figure>
                            <a href="{{ route('products.index') }}">
                                <img src="{{ asset('assets/images/products/product-2.jpg') }}" width="280" height="280"
                                    alt="product">
                                <img src="{{ asset('assets/images/products/product-2-3.jpg') }}" width="280" height="280"
                                    alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-hot">{{ __('home.hot') }}</div>
                                <div class="product-label label-sale">30% {{ __('home.off') }}</div>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="#" class="product-category">{{ __('home.category') }}</a>
                            </div>
                            <h3 class="product-title">
                                <a href="#">{{ __('home.rollup_banner_design') }}</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <del class="old-price">{{ format_price(175.00) }}</del>
                                <span class="product-price">{{ format_price(150.00) }}</span>
                            </div>
                            <!-- End .price-box -->
                            <!-- <div class="product-action">
                                        <a href="#" class="btn-icon-wish" title="wishlist"><i class="icon-heart"></i></a>
                                        <a href="#" class="btn-icon btn-add-cart"><i class="fa fa-arrow-right"></i><span>SELECT
                                                OPTIONS</span></a>
                                        <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i
                                                class="fas fa-external-link-alt"></i></a>
                                    </div> -->
                        </div>
                    </div>
                    <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                        <figure>
                            <a href="{{ route('products.index') }}">
                                <img src="{{ asset('assets/images/products/product-3.jpg') }}" width="280" height="280"
                                    alt="product">
                                <img src="{{ asset('assets/images/products/product-3-2.jpg') }}" width="280" height="280"
                                    alt="product">
                            </a>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="#" class="product-category">{{ __('home.category') }}</a>
                            </div>
                            <h3 class="product-title">
                                <a href="#">{{ __('home.postcard_printing') }}</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <del class="old-price">{{ format_price(159.00) }}</del>
                                <span class="product-price">{{ format_price(149.00) }}</span>
                            </div>
                            <!-- End .price-box -->
                            <!-- <div class="product-action">
                                        <a href="#" class="btn-icon-wish" title="wishlist"><i class="icon-heart"></i></a>
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i><span>ADD TO CART</span></a>
                                        <a href="#" class="btn-quickview" title="Quick View"><i
                                                class="fas fa-external-link-alt"></i></a>
                                    </div> -->
                        </div>
                    </div>
                    <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                        <figure>
                            <a href="{{ route('products.index') }}">
                                <img src="{{ asset('assets/images/products/product-4.jpg') }}" width="280" height="280"
                                    alt="product">
                                <img src="{{ asset('assets/images/products/product-4-2.jpg') }}" width="280" height="280"
                                    alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-hot">{{ __('home.hot') }}</div>
                                <div class="product-label label-sale">40% {{ __('home.off') }}</div>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="#" class="product-category">{{ __('home.category') }}</a>
                            </div>
                            <h3 class="product-title">
                                <a href="#">{{ __('home.folder_flyer_printing') }}</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <del class="old-price">{{ format_price(159.00) }}</del>
                                <span class="product-price">{{ format_price(149.00) }}</span>
                            </div>
                            <!-- End .price-box -->
                            <!-- <div class="product-action">
                                        <a href="#" class="btn-icon-wish" title="wishlist"><i class="icon-heart"></i></a>
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i><span>ADD TO CART</span></a>
                                        <a href="#" class="btn-quickview" title="Quick View"><i
                                                class="fas fa-external-link-alt"></i></a>
                                    </div> -->
                        </div>
                    </div>
                    <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                        <figure>
                            <a href="{{ route('products.index') }}">
                                <img src="{{ asset('assets/images/products/product-5.jpg') }}" width="280" height="280"
                                    alt="product">
                                <img src="{{ asset('assets/images/products/product-5-2.jpg') }}" width="280" height="280"
                                    alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-hot">{{ __('home.hot') }}</div>
                                <div class="product-label label-sale">15% {{ __('home.off') }}</div>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="{{ route('category.index') }}" class="product-category">Category</a>
                            </div>
                            <h3 class="product-title">
                                <a href="{{ route('products.index') }}">{{ __('home.casual_spring_blue_shoes') }}</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>

                                    <span class="tooltiptext tooltip-top"></span>
                                </div>

                            </div>

                            <div class="price-box">
                                <del class="old-price">{{ format_price(59.00) }}</del>
                                <span class="product-price">{{ format_price(49.00) }}</span>
                            </div>

                            <!-- <div class="product-action">
                                        <a href="#" class="btn-icon-wish" title="wishlist"><i class="icon-heart"></i></a>
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i><span>ADD TO CART</span></a>
                                        <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i
                                                class="fas fa-external-link-alt"></i></a>
                                    </div> -->
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="new-products-section">
        <div class="container">
            <h2 class="section-title heading-border ls-20 border-0">{{ __('home.new_arrivals') }}</h2>

            <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center mb-2"
                data-owl-options="{ 'rtl': {{ app()->getLocale() == 'ar' ? 'true' : 'false' }},
                            'dots': false,
                            'nav': true,
                            'smartSpeed': 300,
                            'responsive': {
                                '992': {
                                    'items': 4
                                },
                                '1200': {
                                    'items': 5
                                }
                            }
                        }">
                @if(isset($newArrivals) && $newArrivals->count() > 0)
                    @foreach($newArrivals as $product)
                        <div class="product-default">
                            <figure>
                                <a
                                    href="{{ route('product.show', [$product->category->slug, $product->subcategory->slug ?? 'no-sub', $product->slug]) }}">
                                    <img src="{{ asset('storage/app/public/' . $product->image) }}" width="220" height="220"
                                        alt="{{ $product->name }}">
                                    @if($product->images && count($product->images) > 0)
                                        <img src="{{ asset('storage/app/public/' . $product->images[0]) }}" width="220" height="220"
                                            alt="{{ $product->name }}">
                                    @endif
                                </a>
                                @php
                                    $hasActiveDiscount = false;
                                    if ($product->discount_price > 0) {
                                        if (is_null($product->discount_end_date) || \Carbon\Carbon::parse($product->discount_end_date)->isFuture() || \Carbon\Carbon::parse($product->discount_end_date)->isToday()) {
                                            $hasActiveDiscount = true;
                                        }
                                    }
                                @endphp
                                <div class="label-group">
                                    @if($product->is_featured || $product->is_new_arrival)
                                        <div class="product-label label-hot">{{ __('home.hot') }}</div>
                                    @endif
                                    @if($hasActiveDiscount && $product->discount_price > 0)
                                        @php
                                            $discount = round(($product->discount_price / $product->price) * 100);
                                        @endphp
                                        @if($discount > 0)
                                            <div class="product-label label-sale">{{ $discount }}% {{ __('home.off') }}</div>
                                        @endif
                                    @endif
                                </div>
                            </figure>
                            <div class="product-details">
                                <div class="category-list">
                                    @if($product->category)
                                        <a href="{{ route('category.show', $product->category->slug) }}"
                                            class="product-category">{{ $product->category->name }}</a>
                                    @else
                                        <a href="#" class="product-category">{{ __('home.uncategorized') }}</a>
                                    @endif
                                </div>
                                <h3 class="product-title">
                                    <a
                                        href="{{ route('product.show', [$product->category->slug, $product->subcategory->slug ?? 'no-sub', $product->slug]) }}">{{ $product->name }}</a>
                                </h3>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:100%"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                </div>
                               <div class="price-box">
                                    @if($hasActiveDiscount && $product->discount_price > 0)
                                        <del class="old-price">{{ format_price($product->price) }}</del>
                                        <span class="product-price">{{ format_price($product->price - $product->discount_price) }}</span>
                                    @else
                                        <span class="product-price">{{ format_price($product->price) }}</span>
                                    @endif
                                </div>
                                <div class="product-action">
                                    <a href="#" class="btn-icon-wish" title="wishlist" data-wishlist-id="{{ $product->id }}" data-wishlist-type="product"><i class="icon-heart"></i></a>
                                    <a href="{{ $product->subcategory ? route('subcategory.show', [$product->category->slug, $product->subcategory->slug]) : route('products.index') }}"
                                        class="btn-icon btn-add-cart"><i
                                            class="fa fa-arrow-right"></i><span>{{ __('home.select_options') }}</span></a>
                                    <a href="{{ route('product.show', [$product->category->slug, $product->subcategory->slug ?? 'no-sub', $product->slug]) }}" class="btn-quickview" title="Quick View"><i
                                            class="fas fa-external-link-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                        <figure>
                            <a href="{{ route('products.index') }}">
                                <img src="{{ asset('assets/images/products/product-6.jpg') }}" width="220" height="220"
                                    alt="product">
                                <img src="{{ asset('assets/images/products/product-6-2.jpg') }}" width="220" height="220"
                                    alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-hot">{{ __('home.hot') }}</div>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="#" class="product-category">{{ __('home.category') }}</a>
                            </div>
                            <h3 class="product-title">
                                <a href="#">{{ __('home.award_shields') }}</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <del class="old-price">{{ format_price(159.00) }}</del>
                                <span class="product-price">{{ format_price(149.00) }}</span>
                            </div>
                            <!-- End .price-box -->
                            <!-- <div class="product-action">
                                        <a href="#" class="btn-icon-wish" title="wishlist"><i class="icon-heart"></i></a>
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i><span>ADD TO CART</span></a>
                                        <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i
                                                class="fas fa-external-link-alt"></i></a>
                                    </div> -->
                        </div>
                    </div>
                    <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                        <figure>
                            <a href="{{ route('products.index') }}">
                                <img src="{{ asset('assets/images/products/product-7.jpg') }}" width="220" height="220"
                                    alt="product">
                                <img src="{{ asset('assets/images/products/product-7-2.jpg') }}" width="220" height="220"
                                    alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-hot">{{ __('home.hot') }}</div>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="#" class="product-category">{{ __('home.category') }}</a>
                            </div>
                            <h3 class="product-title">
                                <a href="#">{{ __('home.signal_sign_board') }}</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <del class="old-price">{{ format_price(159.00) }}</del>
                                <span class="product-price">{{ format_price(149.00) }}</span>
                            </div>
                            <!-- End .price-box -->
                            <!-- <div class="product-action">
                                        <a href="#" class="btn-icon-wish" title="wishlist"><i class="icon-heart"></i></a>
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i><span>ADD TO CART</span></a>
                                        <a href="#" class="btn-quickview" title="Quick View"><i
                                                class="fas fa-external-link-alt"></i></a>
                                    </div> -->
                        </div>
                    </div>
                    <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                        <figure>
                            <a href="{{ route('products.index') }}">
                                <img src="{{ asset('assets/images/products/product-8.jpg') }}" width="220" height="220"
                                    alt="product">
                                <img src="{{ asset('assets/images/products/product-8-2.jpg') }}" width="220" height="220"
                                    alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-sale">20% {{ __('home.off') }}</div>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="#" class="product-category">{{ __('home.category') }}</a>
                            </div>
                            <h3 class="product-title">
                                <a href="#">{{ __('home.shop_sign_board') }}</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <del class="old-price">{{ format_price(159.00) }}</del>
                                <span class="product-price">{{ format_price(149.00) }}</span>
                            </div>
                            <!-- End .price-box -->
                            <!-- <div class="product-action">
                                        <a href="#" class="btn-icon-wish" title="wishlist"><i class="icon-heart"></i></a>
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i><span>ADD TO CART</span></a>
                                        <a href="#" class="btn-quickview" title="Quick View"><i
                                                class="fas fa-external-link-alt"></i></a>
                                    </div> -->
                        </div>
                    </div>
                    <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                        <figure>
                            <a href="{{ route('products.index') }}">
                                <img src="{{ asset('assets/images/products/product-9.jpg') }}" width="220" height="220"
                                    alt="product">
                                <img src="{{ asset('assets/images/products/product-9-2.jpg') }}" width="220" height="220"
                                    alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-sale">30% {{ __('home.off') }}</div>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="#" class="product-category">{{ __('home.category') }}</a>
                            </div>
                            <h3 class="product-title">
                                <a href="#">{{ __('home.signage') }}</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <del class="old-price">{{ format_price(159.00) }}</del>
                                <span class="product-price">{{ format_price(149.00) }}</span>
                            </div>
                            <!-- End .price-box -->
                            <!-- <div class="product-action">
                                        <a href="#" class="btn-icon-wish" title="wishlist"><i class="icon-heart"></i></a>
                                        <a href="#" class="btn-icon btn-add-cart"><i class="fa fa-arrow-right"></i><span>SELECT
                                                OPTIONS</span></a>
                                        <a href="#" class="btn-quickview" title="Quick View"><i
                                                class="fas fa-external-link-alt"></i></a>
                                    </div> -->
                        </div>
                    </div>
                    <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                        <figure>
                            <a href="{{ route('products.index') }}">
                                <img src="{{ asset('assets/images/products/product-10.jpg') }}" width="220" height="220"
                                    alt="product">
                                <img src="{{ asset('assets/images/products/product-10-2.jpg') }}" width="220" height="220"
                                    alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-hot">{{ __('home.hot') }}</div>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="#" class="product-category">{{ __('home.category') }}</a>
                            </div>
                            <h3 class="product-title">
                                <a href="#">{{ __('home.die_cut_business_cards') }}</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <del class="old-price">{{ format_price(159.00) }}</del>
                                <span class="product-price">{{ format_price(149.00) }}</span>
                            </div>
                            <!-- End .price-box -->
                            <!-- <div class="product-action">
                                        <a href="#" class="btn-icon-wish" title="wishlist"><i class="icon-heart"></i></a>
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i><span>ADD TO CART</span></a>
                                        <a href="#" class="btn-quickview" title="Quick View"><i
                                                class="fas fa-external-link-alt"></i></a>
                                    </div> -->
                        </div>
                    </div>
                    <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                        <figure>
                            <a href="{{ route('products.index') }}">
                                <img src="{{ asset('assets/images/products/product-11.jpg') }}" width="220" height="220"
                                    alt="product">
                                <img src="{{ asset('assets/images/products/product-11-2.jpg') }}" width="220" height="220"
                                    alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-sale">20% {{ __('home.off') }}</div>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="#" class="product-category">{{ __('home.category') }}</a>
                            </div>
                            <h3 class="product-title">
                                <a href="#">{{ __('home.men_sports_travel_bag') }}</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <del class="old-price">{{ format_price(59.00) }}</del>
                                <span class="product-price">{{ format_price(49.00) }}</span>
                            </div>
                            <!-- End .price-box -->
                            <!-- <div class="product-action">
                                        <a href="#" class="btn-icon-wish" title="wishlist"><i class="icon-heart"></i></a>
                                        <a href="#" class="btn-icon btn-add-cart"><i class="fa fa-arrow-right"></i><span>SELECT
                                                OPTIONS</span></a>
                                        <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i
                                                class="fas fa-external-link-alt"></i></a>
                                    </div> -->
                        </div>
                    </div>
                @endif
            </div>
            </section>

            @if(isset($printingTechnologies) && $printingTechnologies->count() > 0)
                <section class="printing-technologies-section">
                    <div class="container">
                        <h2 class="section-title categories-section-title heading-border border-0 ls-0 appear-animate"
                            data-animation-delay="100" data-animation-name="fadeInUpShorter">
                            {{ app()->getLocale() == 'ar' ? 'تقنيات الطباعة' : 'Printing Technologies' }}
                        </h2>
                        
                        <div class="row justify-content-center">
                            @foreach($printingTechnologies as $tech)
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-4">
                                    <div class="product-category appear-animate" data-animation-name="fadeInUpShorter" style="background: #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border-radius: 8px; overflow: hidden; padding-bottom: 20px; transition: all 0.3s ease;">
                                        <a href="#" style="pointer-events: none; cursor: default;">
                                            @if($tech->image)
                                                <figure style="margin-bottom: 15px; height: 220px; overflow: hidden;">
                                                    <img src="{{ asset('storage/app/public/' . $tech->image) }}" alt="{{ $tech->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s;" />
                                                </figure>
                                            @endif
                                            <div class="category-content" style="position: static; padding: 0 15px; transform: none; text-align: center; width: 100%;">
                                                <h3 style="font-size: 1.8rem; font-weight: 700; color: #222; margin-bottom: 8px;">{{ $tech->title }}</h3>
                                                @if($tech->description)
                                                    <span style="font-size: 1.3rem; color: #777; font-weight: 400; line-height: 1.6; display: block; text-transform: none;">{{ $tech->description }}</span>
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                <style>
                .new-products-section{
                    background-color: #2596be;
                }
                    .printing-technologies-section {
                        padding-top: 1.5rem !important;
                        padding-bottom: 0.5rem !important;
                    }
                    .printing-technologies-section .product-category:hover figure img {
                        transform: scale(1.08);
                    }
                    .printing-technologies-section .product-category:hover {
                        transform: translateY(-5px);
                        box-shadow: 0 12px 25px rgba(0,0,0,0.1) !important;
                    }
                </style>
            @endif

            @if(isset($industries) && $industries->count() > 0)
                <section class="industries-serve-section">
                    <div class="container">
                        <h2 class="section-title categories-section-title heading-border border-0 ls-0 appear-animate"
                            data-animation-delay="100" data-animation-name="fadeInUpShorter">
                            {{ app()->getLocale() == 'ar' ? 'القطاعات التي نخدمها' : 'Industries We Serve' }}
                        </h2>
                        
                        <div class="row justify-content-center">
                            @foreach($industries as $ind)
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-4">
                                    <div class="product-category appear-animate" data-animation-name="fadeInUpShorter" style="background: #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border-radius: 8px; overflow: hidden; padding-bottom: 20px; transition: all 0.3s ease;">
                                        <a href="#" style="pointer-events: none; cursor: default;">
                                            @if($ind->image)
                                                <figure style="margin-bottom: 15px; height: 220px; overflow: hidden;">
                                                    <img src="{{ asset('storage/app/public/' . $ind->image) }}" alt="{{ $ind->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s;" />
                                                </figure>
                                            @endif
                                            <div class="category-content" style="position: static; padding: 0 15px; transform: none; text-align: center; width: 100%;">
                                                <h3 style="font-size: 1.8rem; font-weight: 700; color: #222; margin-bottom: 8px;">{{ $ind->title }}</h3>
                                                @if($ind->description)
                                                    <span style="font-size: 1.3rem; color: #777; font-weight: 400; line-height: 1.6; display: block; text-transform: none;">{{ $ind->description }}</span>
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                <style>
                    .industries-serve-section {
                        padding-top: 1.5rem !important;
                        padding-bottom: 0.5rem !important;
                    }
                    .industries-serve-section .product-category:hover figure img {
                        transform: scale(1.08);
                    }
                    .industries-serve-section .product-category:hover {
                        transform: translateY(-5px);
                        box-shadow: 0 12px 25px rgba(0,0,0,0.1) !important;
                    }
                </style>
            @endif

            {{-- ✅ Our Clients Section --}}
            @if(isset($clients) && $clients->count() > 0)
                <section class="our-clients-section">
                    <div class="container">
                        <h2 class="section-title categories-section-title heading-border border-0 ls-0 appear-animate"
                            data-animation-delay="100" data-animation-name="fadeInUpShorter">
                            {{ app()->getLocale() == 'ar' ? 'عملاؤنا' : 'Our Clients' }}
                        </h2>
                        <div class="clients-slider owl-carousel owl-theme appear-animate" data-animation-name="fadeInUpShorter"
                            data-owl-options="{
                                'rtl': {{ app()->getLocale() == 'ar' ? 'true' : 'false' }},
                                'dots': false,
                                'nav': false,
                                'loop': true,
                                'autoplay': true,
                                'autoplayTimeout': 2500,
                                'autoplayHoverPause': true,
                                'responsive': {
                                    '0':   { 'items': 2 },
                                    '480': { 'items': 3 },
                                    '768': { 'items': 4 },
                                    '992': { 'items': 5 },
                                    '1200':{ 'items': 6 }
                                }
                            }">
                            @foreach($clients as $client)
                                <div class="client-logo-item">
                                    @if($client->website)
                                        <a href="{{ $client->website }}" target="_blank" rel="noopener">
                                    @else
                                        <span>
                                    @endif
                                        @if($client->image)
                                            <img src="{{ asset('storage/app/public/' . $client->image) }}" alt="{{ $client->name }}" />
                                        @else
                                            <div class="client-name-fallback">{{ $client->name }}</div>
                                        @endif
                                    @if($client->website)
                                        </a>
                                    @else
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                <style>
                    .our-clients-section {
                        padding-top: 2rem !important;
                        padding-bottom: 1rem !important;
                        background: #f9f9f9;
                    }
                    .client-logo-item {
                        display: flex !important;
                        align-items: center;
                        justify-content: center;
                        padding: 15px 20px;
                        height: 100px;
                    }
                    .client-logo-item a,
                    .client-logo-item span {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        width: 100%;
                        height: 100%;
                        transition: opacity 0.3s;
                        opacity: 0.7;
                    }
                    .client-logo-item a:hover {
                        opacity: 1;
                    }
                    .client-logo-item img {
                        max-width: 130px;
                        max-height: 65px;
                        width: auto;
                        height: auto;
                        object-fit: contain;
                        filter: grayscale(100%);
                        transition: filter 0.3s;
                    }
                    .client-logo-item a:hover img {
                        filter: grayscale(0%);
                    }
                    .client-name-fallback {
                        font-size: 1.4rem;
                        font-weight: 600;
                        color: #555;
                        text-align: center;
                    }
                </style>
            @endif

            {{-- ✅ Customer Reviews / Testimonials Section --}}
            @if(isset($testimonials) && $testimonials->count() > 0)
                <section class="testimonials-section">
                    <div class="container">
                        <h2 class="section-title categories-section-title heading-border border-0 ls-0 appear-animate"
                            data-animation-delay="100" data-animation-name="fadeInUpShorter">
                            {{ app()->getLocale() == 'ar' ? 'آراء العملاء' : 'Customer Reviews' }}
                        </h2>
                        <div class="testimonials-slider owl-carousel owl-theme appear-animate" data-animation-name="fadeInUpShorter"
                            data-owl-options="{
                                'rtl': {{ app()->getLocale() == 'ar' ? 'true' : 'false' }},
                                'dots': true,
                                'nav': false,
                                'loop': true,
                                'autoplay': true,
                                'autoplayTimeout': 5000,
                                'autoplayHoverPause': true,
                                'responsive': {
                                    '0':   { 'items': 1 },
                                    '768': { 'items': 2 },
                                    '992': { 'items': 3 }
                                }
                            }">
                            @foreach($testimonials as $testimonial)
                                <div class="testimonial-card">
                                    {{-- Stars --}}
                                    <div class="testimonial-stars">
                                        @for($s = 1; $s <= 5; $s++)
                                            <i class="fas fa-star {{ $s <= $testimonial->rating ? 'star-filled' : 'star-empty' }}"></i>
                                        @endfor
                                    </div>
                                    {{-- Review Text --}}
                                    <p class="testimonial-text">"{{ $testimonial->review }}"</p>
                                    {{-- Client Info --}}
                                    <div class="testimonial-client">
                                        @if($testimonial->client_image)
                                            <img src="{{ asset('storage/app/public/' . $testimonial->client_image) }}" alt="{{ $testimonial->client_name }}" class="testimonial-avatar">
                                        @else
                                            <div class="testimonial-avatar-placeholder">
                                                {{ strtoupper(substr($testimonial->client_name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div class="testimonial-meta">
                                            <strong>{{ $testimonial->client_name }}</strong>
                                            @if($testimonial->client_position || $testimonial->client_company)
                                                <span>{{ implode(', ', array_filter([$testimonial->client_position, $testimonial->client_company])) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                <style>
                  
                        .categories-section{
                            background-color: #2596be;
                        }
    
                    .testimonials-section {
                        padding-top: 2rem !important;
                        padding-bottom: 2rem !important;
                        background: #fff;
                    }
                    .testimonial-card {
                        background: #fff;
                        border: 1px solid #eee;
                        border-radius: 10px;
                        padding: 25px 22px 20px;
                        margin: 10px 8px 20px;
                        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
                        transition: box-shadow 0.3s, transform 0.3s;
                        min-height: 220px;
                        display: flex;
                        flex-direction: column;
                        justify-content: space-between;
                    }
                    .testimonial-card:hover {
                        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
                        transform: translateY(-4px);
                    }
                    .testimonial-stars {
                        margin-bottom: 12px;
                    }
                    .testimonial-stars .star-filled { color: #f5a623; font-size: 1.3rem; }
                    .testimonial-stars .star-empty  { color: #ddd; font-size: 1.3rem; }
                    .testimonial-text {
                        font-size: 1.35rem;
                        color: #555;
                        line-height: 1.7;
                        flex: 1;
                        margin-bottom: 18px;
                        font-style: italic;
                    }
                    .testimonial-client {
                        display: flex;
                        align-items: center;
                        gap: 12px;
                        border-top: 1px solid #f0f0f0;
                        padding-top: 14px;
                    }
                    .testimonial-avatar {
                        width: 48px;
                        height: 48px;
                        border-radius: 50%;
                        object-fit: cover;
                        flex-shrink: 0;
                    }
                    .testimonial-avatar-placeholder {
                        width: 48px;
                        height: 48px;
                        border-radius: 50%;
                        background: linear-gradient(135deg, #2A95CB, #1a6fa0);
                        color: #fff;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 1.8rem;
                        font-weight: 700;
                        flex-shrink: 0;
                    }
                    .testimonial-meta {
                        display: flex;
                        flex-direction: column;
                    }
                    .testimonial-meta strong {
                        font-size: 1.35rem;
                        color: #222;
                        font-weight: 700;
                    }
                    .testimonial-meta span {
                        font-size: 1.2rem;
                        color: #888;
                    }
                </style>
            @endif

            @php
                $locale = app()->getLocale();
                $isRtl = $locale == 'ar';
            @endphp
            @if(isset($bigSaleBanner) && $bigSaleBanner)
            <div class="banner banner-big-sale appear-animate" data-animation-delay="200"
                data-animation-name="fadeInUpShorter"
                style="background: #2A95CB center/cover url({{ asset('storage/app/public/' . $bigSaleBanner->image) }});">
                <div class="banner-content row align-items-center mx-0">
                    <div class="col-md-9 col-sm-8">
                        <h2 class="text-white {{ $isRtl ? 'text-sm-right' : 'text-sm-left' }} ls-n-20 mb-md-0 px-4">
                            @if($isRtl)
                                <b class="d-inline-block {{ $isRtl ? 'ml-3' : 'mr-3' }} mb-1 mb-md-0">{{ $bigSaleBanner->title_ar ?? 'تخفيضات كبيرة' }}</b> {{ $bigSaleBanner->description_ar ?? 'جميع العلامات التجارية الجديدة للأزياء خصم يصل إلى 70%' }}
                                <small class="text-transform-none align-middle">{{ $bigSaleBanner->subtitle_ar ?? 'المشتريات عبر الإنترنت فقط' }}</small>
                            @else
                                <b class="d-inline-block mr-3 mb-1 mb-md-0">{{ $bigSaleBanner->title_en ?? 'Big Sale' }}</b> {{ $bigSaleBanner->description_en ?? 'All new fashion brands items up to 70% off' }}
                                <small class="text-transform-none align-middle">{{ $bigSaleBanner->subtitle_en ?? 'Online Purchases Only' }}</small>
                            @endif
                        </h2>
                    </div>
                    <div class="col-md-3 col-sm-4 text-center {{ $isRtl ? 'text-sm-left' : 'text-sm-right' }}">
                        <a class="btn btn-light btn-white btn-lg" href="{{ $bigSaleBanner->link ?? route('category.index') }}">{{ $bigSaleBanner->button_text ?? ($isRtl ? 'عرض التخفيضات' : 'View Sale') }}</a>
                    </div>
                </div>
            </div>
            @else
            <div class="banner banner-big-sale appear-animate" data-animation-delay="200"
                data-animation-name="fadeInUpShorter"
                style="background: #2A95CB center/cover url({{ asset('assets/images/demoes/demo4/banners/banner-4.jpg') }});">
                <div class="banner-content row align-items-center mx-0">
                    <div class="col-md-9 col-sm-8">
                        <h2 class="text-white {{ $isRtl ? 'text-sm-right' : 'text-sm-left' }} ls-n-20 mb-md-0 px-4">
                            @if($isRtl)
                                <b class="d-inline-block {{ $isRtl ? 'ml-3' : 'mr-3' }} mb-1 mb-md-0">تخفيضات كبيرة</b> جميع العلامات التجارية الجديدة للأزياء خصم يصل إلى 70%
                                <small class="text-transform-none align-middle">المشتريات عبر الإنترنت فقط</small>
                            @else
                                <b class="d-inline-block mr-3 mb-1 mb-md-0">Big Sale</b> All new fashion brands items up to 70%
                                off
                                <small class="text-transform-none align-middle">Online Purchases Only</small>
                            @endif
                        </h2>
                    </div>
                    <div class="col-md-3 col-sm-4 text-center {{ $isRtl ? 'text-sm-left' : 'text-sm-right' }}">
                        <a class="btn btn-light btn-white btn-lg" href="{{ route('category.index') }}">{{ $isRtl ? 'عرض التخفيضات' : 'View Sale' }}</a>
                    </div>
                </div>
            </div>
            @endif



        </div>
    </section>

    <section class="feature-boxes-container">
        <div class="container appear-animate" data-animation-name="fadeInUpShorter">
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-box px-sm-5 feature-box-simple text-center">
                        <div class="feature-box-icon">
                            <i class="icon-earphones-alt"></i>
                        </div>

                        <div class="feature-box-content p-0">
                            <h3>{{ __('home.customer_support') }}</h3>
                            <h5>{{ __('home.wont_be_alone') }}</h5>
                            <p>{{ __('home.support_text') }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-box px-sm-5 feature-box-simple text-center">
                        <div class="feature-box-icon">
                            <i class="icon-credit-card"></i>
                        </div>

                        <div class="feature-box-content p-0">
                            <h3>{{ __('home.fully_customizable') }}</h3>
                            <h5>{{ __('home.tons_of_options') }}</h5>
                            <p>{{ __('home.customizable_text') }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-box px-sm-5 feature-box-simple text-center">
                        <div class="feature-box-icon">
                            <i class="icon-action-undo"></i>
                        </div>
                        <div class="feature-box-content p-0">
                            <h3>{{ __('home.powerful_admin') }}</h3>
                            <h5>{{ __('home.made_to_help') }}</h5>
                            <p>{{ __('home.admin_text') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(isset($promoBanner) && $promoBanner)
    <section class="promo-section bg-dark" data-parallax="{'speed': 2, 'enableOnMobile': true}"
        data-image-src="{{ asset('storage/app/public/' . $promoBanner->image) }}">
        <div class="promo-banner banner container text-uppercase">
            <div class="banner-content row align-items-center text-center">
                @php
                    $locale = app()->getLocale();
                    $isRtl = $locale == 'ar';
                @endphp
                <div class="col-md-4 {{ $isRtl ? 'mr-xl-auto text-md-left' : 'ml-xl-auto text-md-right' }} appear-animate"
                    data-animation-name="{{ $isRtl ? 'fadeInLeftShorter' : 'fadeInRightShorter' }}"
                    data-animation-delay="600">
                    <h2 class="mb-md-0 text-white">
                        @if($isRtl)
                            {{ $promoBanner->title_ar ?? 'أفضل عروض<br>الأزياء' }}
                        @else
                            {{ $promoBanner->title_en ?? 'Top Fashion<br>Deals' }}
                        @endif
                    </h2>
                </div>
                <div class="col-md-4 col-xl-3 pb-4 pb-md-0 appear-animate" data-animation-name="fadeIn"
                    data-animation-delay="300">
                    <a href="{{ $promoBanner->link ?? route('category.index') }}" class="btn btn-dark btn-black ls-10">{{ $promoBanner->button_text ?? ($isRtl ? 'عرض التخفيضات' : 'View Sale') }}</a>
                </div>
                <div class="col-md-4 {{ $isRtl ? 'ml-xl-auto text-md-right' : 'mr-xl-auto text-md-left' }} appear-animate"
                    data-animation-name="{{ $isRtl ? 'fadeInRightShorter' : 'fadeInLeftShorter' }}"
                    data-animation-delay="600">
                    <h4 class="mb-1 mt-1 font1 coupon-sale-text p-0 d-block ls-n-10 text-transform-none">
                        <b>{{ $promoBanner->subtitle ?? ($isRtl ? 'كوبون حصري' : 'Exclusive COUPON') }}</b>
                    </h4>
                    <h5 class="mb-1 coupon-sale-text text-white ls-10 p-0"><i class="ls-0">{{ $promoBanner->description ?? ($isRtl ? 'خصم يصل إلى' : 'UP TO') }}</i><b
                            class="text-white bg-secondary ls-n-10">{{ $promoBanner->discount_amount ? format_price($promoBanner->discount_amount) : format_price(100) }}</b> {{ $promoBanner->discount_text ?? ($isRtl ? 'فقط' : 'OFF') }}</h5>
                </div>
            </div>
        </div>
    </section>
    @else
    <section class="promo-section bg-dark" data-parallax="{'speed': 2, 'enableOnMobile': true}"
        data-image-src="assets/images/demoes/demo4/banners/banner-5.jpg">
        <div class="promo-banner banner container text-uppercase">
            <div class="banner-content row align-items-center text-center">
                @php
                    $locale = app()->getLocale();
                    $isRtl = $locale == 'ar';
                @endphp
                <div class="col-md-4 {{ $isRtl ? 'mr-xl-auto text-md-left' : 'ml-xl-auto text-md-right' }} appear-animate"
                    data-animation-name="{{ $isRtl ? 'fadeInLeftShorter' : 'fadeInRightShorter' }}"
                    data-animation-delay="600">
                    <h2 class="mb-md-0 text-white">
                        @if($isRtl)
                            أفضل عروض<br>الأزياء
                        @else
                            Top Fashion<br>Deals
                        @endif
                    </h2>
                </div>
                <div class="col-md-4 col-xl-3 pb-4 pb-md-0 appear-animate" data-animation-name="fadeIn"
                    data-animation-delay="300">
                    <a href="{{ route('category.index') }}" class="btn btn-dark btn-black ls-10">{{ $isRtl ? 'عرض التخفيضات' : 'View Sale' }}</a>
                </div>
                <div class="col-md-4 {{ $isRtl ? 'ml-xl-auto text-md-right' : 'mr-xl-auto text-md-left' }} appear-animate"
                    data-animation-name="{{ $isRtl ? 'fadeInRightShorter' : 'fadeInLeftShorter' }}"
                    data-animation-delay="600">
                    <h4 class="mb-1 mt-1 font1 coupon-sale-text p-0 d-block ls-n-10 text-transform-none">
                        <b>{{ $isRtl ? 'كوبون حصري' : 'Exclusive COUPON' }}</b>
                    </h4>
                    <h5 class="mb-1 coupon-sale-text text-white ls-10 p-0"><i class="ls-0">{{ $isRtl ? 'خصم يصل إلى' : 'UP TO' }}</i><b
                            class="text-white bg-secondary ls-n-10">{{ format_price(100) }}</b> {{ $isRtl ? 'فقط' : 'OFF' }}</h5>
                </div>
            </div>
        </div>
    </section>
    @endif
    </div>
@endsection