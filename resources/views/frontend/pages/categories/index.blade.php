@extends('frontend.layouts.master')
@section('title', isset($isDiscountOffers) && $isDiscountOffers ? (app()->getLocale() == 'ar' ? 'عروض الخصم' : 'Discount Offers') : __('category.browse_categories'))
@section('meta_description', __('category.meta_description'))
@section('meta_keywords', __('category.meta_keywords'))
@section('content')
    <main class="main">
        <div class="category-banner-container bg-gray">
            <div class="category-banner banner text-uppercase"
                style="background: no-repeat 60%/cover url('assets/images/banners/banner-top.jpg');">
                <div class="container position-relative">
                    <div class="row">
                        <div class="pl-lg-5 pb-5 pb-md-0 col-sm-5 col-xl-4 col-lg-4 offset-1">
                            @if(isset($isDiscountOffers) && $isDiscountOffers)
                                <h3>{{ app()->getLocale() == 'ar' ? 'عروض الخصم الحصرية' : 'Exclusive Discount Offers' }}</h3>
                                <p class="text-white mb-2" style="font-size: 14px; text-transform: none;">{{ app()->getLocale() == 'ar' ? 'اكتشف أفضل المنتجات بأسعار مخفضة ولفترة محدودة.' : 'Discover top products with active discounts for a limited time.' }}</p>
                            @else
                                <h3>{{ __('category.printing_deals') }}</h3>
                                <a href="{{ route('products.index') }}" class="btn btn-dark">{{ __('category.get_yours') }}</a>
                            @endif
                        </div>
                        <div class="pl-lg-3 col-sm-4 offset-sm-0 offset-1 pt-3">
                            <div class="coupon-sale-content">
                                <h4 class="m-b-1 coupon-sale-text bg-white text-transform-none">{{ __('category.exclusive_coupon') }}</h4>
                                <h5 class="mb-2 coupon-sale-text d-block ls-10 p-0">
                                    <i class="ls-0">{{ __('category.up_to') }}</i><b class="text-dark">{{ format_price(100) }}</b> {{ __('category.off') }}
                                </h5>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    @if(isset($isDiscountOffers) && $isDiscountOffers)
                        <li class="breadcrumb-item"><a href="{{ route('category.index') }}">{{ __('category.categories') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ app()->getLocale() == 'ar' ? 'عروض الخصم' : 'Discount Offers' }}</li>
                    @else
                        <li class="breadcrumb-item"><a href="#">{{ __('category.business_cards') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('category.categories') }}</li>
                    @endif
                </ol>
            </nav>

            <div class="row">
                <div class="col-lg-9 main-content">
                    <nav class="toolbox sticky-header" data-sticky-options="{'mobile': true}">
                        <div class="toolbox-left">
                            <a href="#" class="sidebar-toggle">
                                <svg data-name="Layer 3" id="Layer_3" viewBox="0 0 32 32"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <line x1="15" x2="26" y1="9" y2="9" class="cls-1"></line>
                                    <line x1="6" x2="9" y1="9" y2="9" class="cls-1"></line>
                                    <line x1="23" x2="26" y1="16" y2="16" class="cls-1"></line>
                                    <line x1="6" x2="17" y1="16" y2="16" class="cls-1"></line>
                                    <line x1="17" x2="26" y1="23" y2="23" class="cls-1"></line>
                                    <line x1="6" x2="11" y1="23" y2="23" class="cls-1"></line>
                                    <path d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z"
                                        class="cls-2"></path>
                                    <path d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                                    <path d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" class="cls-3"></path>
                                    <path d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z"
                                        class="cls-2"></path>
                                </svg>
                                <span>{{ __('category.filter') }}</span>
                            </a>

                            <div class="toolbox-item toolbox-sort">
                                <label>{{ __('category.sort_by') }}</label>

                                <div class="select-custom">
                                    <select name="orderby" class="form-control" id="sortSelect">
                                        <option value="newest" {{ $sort == 'newest' ? 'selected' : '' }}>{{ __('category.sort_by_newness') }}</option>
                                        <option value="oldest" {{ $sort == 'oldest' ? 'selected' : '' }}>{{ __('category.sort_by_oldest') }}</option>
                                        <option value="price-asc" {{ $sort == 'price-asc' ? 'selected' : '' }}>{{ __('category.sort_by_price_low_high') }}</option>
                                        <option value="price-desc" {{ $sort == 'price-desc' ? 'selected' : '' }}>{{ __('category.sort_by_price_high_low') }}</option>
                                        <option value="name-asc" {{ $sort == 'name-asc' ? 'selected' : '' }}>{{ __('category.sort_by_name_asc') }}</option>
                                        <option value="name-desc" {{ $sort == 'name-desc' ? 'selected' : '' }}>{{ __('category.sort_by_name_desc') }}</option>
                                    </select>
                                </div>
                                <!-- End .select-custom -->


                            </div>
                            <!-- End .toolbox-item -->
                        </div>
                        <!-- End .toolbox-left -->

                        <div class="toolbox-right">
                            <div class="toolbox-item toolbox-show">
                                <label>{{ __('category.show') }}</label>

                                <div class="select-custom">
                                    <select name="count" class="form-control" id="perPageSelect">
                                        <option value="12" {{ $perPage == '12' ? 'selected' : '' }}>12</option>
                                        <option value="24" {{ $perPage == '24' ? 'selected' : '' }}>24</option>
                                        <option value="36" {{ $perPage == '36' ? 'selected' : '' }}>36</option>
                                    </select>
                                </div>
                                <!-- End .select-custom -->
                            </div>
                            <!-- End .toolbox-item -->

                            <div class="toolbox-item layout-modes">
                                <a href="#" class="layout-btn btn-grid active" id="gridViewBtn" onclick="setGridView(event)" title="Grid">
                                    <i class="icon-mode-grid"></i>
                                </a>
                                <a href="#" class="layout-btn btn-list" id="listViewBtn" onclick="setListView(event)" title="List">
                                    <i class="icon-mode-list"></i>
                                </a>
                            </div>
                            <!-- End .layout-modes -->
                        </div>
                        <!-- End .toolbox-right -->
                    </nav>

                    <div class="row" id="products-grid">
                        @forelse($products as $product)
                            <div class="col-6 col-sm-4">
                                <div class="product-default">
                                    <figure>
                                        <a href="{{ route('product.show', [$product->category->slug, $product->subcategory->slug ?? 'no-sub', $product->slug]) }}">
                                            @if($product->image)
                                                <img src="{{ asset('storage/app/public/' . $product->image) }}" width="280" height="280" alt="{{ $product->name }}" />
                                            @else
                                                <img src="{{ asset('assets/images/products/product-1.jpg') }}" width="280" height="280" alt="{{ $product->name }}" />
                                            @endif

                                            @if($product->images && count($product->images) > 0)
                                                <img src="{{ asset('storage/app/public/' . $product->images[0]) }}" width="280" height="280" alt="{{ $product->name }}" />
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
                                            @if($hasActiveDiscount && $product->discount_price > 0)
                                                @php
                                                    $percentage = round(($product->discount_price / $product->price) * 100);
                                                @endphp
                                                @if($percentage > 0)
                                                    <div class="product-label label-sale">-{{ $percentage }}%</div>
                                                @endif
                                            @endif
                                        </div>
                                    </figure>

                                    <div class="product-details">
                                        <h3 class="product-title">
                                            <a href="{{ route('product.show', [$product->category->slug, $product->subcategory->slug ?? 'no-sub', $product->slug]) }}">{{ $product->name }}</a>
                                        </h3>
                                        <div class="price-box">
                                            @if($hasActiveDiscount && $product->discount_price > 0)
                                                <del class="old-price">{{ format_price($product->price) }}</del>
                                                <span class="product-price">{{ format_price($product->price - $product->discount_price) }}</span>
                                            @else
                                                <span class="product-price">{{ format_price($product->price) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">
                                    {{ isset($isDiscountOffers) && $isDiscountOffers ? (app()->getLocale() == 'ar' ? 'لا توجد منتجات عليها خصم نشط حالياً.' : 'No active discount offers found at the moment.') : 'No products found.' }}
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <!-- End .row -->
                    <nav class="toolbox toolbox-pagination">
                        {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </nav>
                </div>
                <!-- End .col-lg-9 -->

                <div class="sidebar-overlay"></div>
                <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                    <div class="sidebar-wrapper">
                        <div class="widget">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true"
                                    aria-controls="widget-body-2">Categories</a>
                            </h3>

                            <div class="collapse show" id="widget-body-2">
                                <div class="widget-body">
                                    <ul class="cat-list">
                                        @foreach($categories as $category)
                                            <li>
                                                @if($category->subcategories->count() > 0)
                                                    <a href="#widget-category-{{ $category->id }}" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="widget-category-{{ $category->id }}">
                                                        {{ $category->name }} <span class="products-count">({{ $category->subcategories->count() }})</span>
                                                        <span class="toggle"></span>
                                                    </a>
                                                    <div class="collapse" id="widget-category-{{ $category->id }}">
                                                        <ul class="cat-sublist">
                                                            @foreach($category->subcategories as $subcategory)
                                                                <li><a href="{{ route('subcategory.show', [$category->slug, $subcategory->slug]) }}">{{ $subcategory->name }}</a> <span class="products-count">({{ $subcategory->products->count() }})</span></li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @else
                                                    <a href="{{ route('category.show', $category->slug) }}">
                                                        {{ $category->name }} <span class="products-count">({{ $category->products->count() }})</span>
                                                    </a>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                                <!-- End .widget-body -->
                            </div>
                            <!-- End .collapse -->
                        </div>

                        <!-- End .widget -->

                        {{-- <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true" aria-controls="widget-body-3">Price</a>
                        </h3>

                        <div class="collapse show" id="widget-body-3">
                            <div class="widget-body pb-0">
                                <form action="#">
                                    <div class="price-slider-wrapper">
                                        <div id="price-slider"></div>
                                        <!-- End #price-slider -->
                                    </div>
                                    <!-- End .price-slider-wrapper -->

                                    <div class="filter-price-action d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="filter-price-text">
                                            Price:
                                            <span id="filter-price-range"></span>
                                        </div>
                                        <!-- End .filter-price-text -->

                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                    <!-- End .filter-price-action -->
                                </form>
                            </div>
                            <!-- End .widget-body -->
                        </div>
                        <!-- End .collapse -->
                    </div> --}}
                        <!-- End .widget -->

                        {{-- <div class="widget widget-color">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true" aria-controls="widget-body-4">Color</a>
                        </h3>

                        <div class="collapse show" id="widget-body-4">
                            <div class="widget-body pb-0">
                                <ul class="config-swatch-list">
                                    <li class="active">
                                        <a href="#" style="background-color: #000;"></a>
                                    </li>
                                    <li>
                                        <a href="#" style="background-color: #0188cc;"></a>
                                    </li>
                                    <li>
                                        <a href="#" style="background-color: #81d742;"></a>
                                    </li>
                                    <li>
                                        <a href="#" style="background-color: #6085a5;"></a>
                                    </li>
                                    <li>
                                        <a href="#" style="background-color: #ab6e6e;"></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- End .widget-body -->
                        </div>
                        <!-- End .collapse -->
                    </div> --}}
                        <!-- End .widget -->

                        {{-- <div class="widget widget-size">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-5" role="button" aria-expanded="true" aria-controls="widget-body-5">Sizes</a>
                        </h3>

                        <div class="collapse show" id="widget-body-5">
                            <div class="widget-body pb-0">
                                <ul class="config-size-list">
                                    <li class="active"><a href="#">XL</a></li>
                                    <li><a href="#">L</a></li>
                                    <li><a href="#">M</a></li>
                                    <li><a href="#">S</a></li>
                                </ul>
                            </div>
                            <!-- End .widget-body -->
                        </div>
                        <!-- End .collapse -->
                    </div> --}}
                        <!-- End .widget -->

                        <div class="widget widget-featured">
                            <h3 class="widget-title">Featured</h3>

                            <div class="widget-body">
                                <div class="owl-carousel widget-featured-products">
                                    <div class="featured-col">
                                        <div class="product-default left-details product-widget">
                                            <figure>
                                                <a href="{{ route('products.index') }}">

                                                    <img src="{{ asset('assets/images/products/product-1.jpg') }}"
                                                        width="75" height="74" alt="product">
                                                    <img src="{{ asset('assets/images/products/product-1-2.jpg') }}"
                                                        width="75" height="75" alt="product">
                                                </a>
                                            </figure>
                                            <div class="product-details">
                                                <h3 class="product-title"> <a
                                                        href="{{ route('products.index') }}">Business Card Front &
                                                        Back</a> </h3>
                                                <div class="ratings-container">
                                                    <div class="product-ratings">
                                                        <span class="ratings" style="width:100%"></span>
                                                        <!-- End .ratings -->
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <!-- End .product-ratings -->
                                                </div>
                                                <!-- End .product-container -->
                                                <div class="price-box">
                                                    <span class="product-price">{{ format_price(150.00) }}</span>
                                                </div>
                                                <!-- End .price-box -->
                                            </div>
                                            <!-- End .product-details -->
                                        </div>
                                        <div class="product-default left-details product-widget">
                                            <figure>
                                                <a href="{{ route('products.index') }}">
                                                    <img src="{{ asset('assets/images/products/product-2.jpg') }}"
                                                        width="75" height="75" alt="product">
                                                    <img src="{{ asset('assets/images/products/product-2-3.jpg') }}"
                                                        width="75" height="75" alt="product">
                                                </a>
                                            </figure>
                                            <div class="product-details">
                                                <h3 class="product-title"> <a href="{{ route('products.index') }}">Brown
                                                        Women Casual
                                                        HandBag</a> </h3>
                                                <div class="ratings-container">
                                                    <div class="product-ratings">
                                                        <span class="ratings" style="width:100%"></span>
                                                        <!-- End .ratings -->
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <!-- End .product-ratings -->
                                                </div>
                                                <!-- End .product-container -->
                                                <div class="price-box">
                                                    <span class="product-price">$150.00</span>
                                                </div>
                                                <!-- End .price-box -->
                                            </div>
                                            <!-- End .product-details -->
                                        </div>
                                        <div class="product-default left-details product-widget">
                                            <figure>
                                                <a href="{{ route('products.index') }}">
                                                    <img src="{{ asset('assets/images/products/product-3.jpg') }}"
                                                        width="75" height="75" alt="product">
                                                    <img src="{{ asset('assets/images/products/product-3-2.jpg') }}"
                                                        width="75" height="75" alt="product">
                                                </a>
                                            </figure>
                                            <div class="product-details">
                                                <h3 class="product-title"> <a
                                                        href="{{ route('products.index') }}">Postcard Printing</a> </h3>
                                                <div class="ratings-container">
                                                    <div class="product-ratings">
                                                        <span class="ratings" style="width:100%"></span>
                                                        <!-- End .ratings -->
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <!-- End .product-ratings -->
                                                </div>
                                                <!-- End .product-container -->
                                                <div class="price-box">
                                                    <span class="product-price">{{ format_price(149.00) }}</span>
                                                </div>
                                                <!-- End .price-box -->
                                            </div>
                                            <!-- End .product-details -->
                                        </div>
                                    </div>
                                    <!-- End .featured-col -->

                                    <div class="featured-col">
                                        <div class="product-default left-details product-widget">
                                            <figure>
                                                <a href="{{ route('products.index') }}">

                                                    <img src="{{ asset('assets/images/products/product-1.jpg') }}"
                                                        width="75" height="74" alt="product">
                                                    <img src="{{ asset('assets/images/products/product-1-2.jpg') }}"
                                                        width="75" height="75" alt="product">
                                                </a>
                                            </figure>
                                            <div class="product-details">
                                                <h3 class="product-title"> <a
                                                        href="{{ route('products.index') }}">Business Card Front &
                                                        Back</a> </h3>
                                                <div class="ratings-container">
                                                    <div class="product-ratings">
                                                        <span class="ratings" style="width:100%"></span>
                                                        <!-- End .ratings -->
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <!-- End .product-ratings -->
                                                </div>
                                                <!-- End .product-container -->
                                                <div class="price-box">
                                                    <span class="product-price">$150.00</span>
                                                </div>
                                                <!-- End .price-box -->
                                            </div>
                                            <!-- End .product-details -->
                                        </div>
                                        <div class="product-default left-details product-widget">
                                            <figure>
                                                <a href="{{ route('products.index') }}">
                                                    <img src="{{ asset('assets/images/products/product-2.jpg') }}"
                                                        width="75" height="75" alt="product">
                                                    <img src="{{ asset('assets/images/products/product-2-3.jpg') }}"
                                                        width="75" height="75" alt="product">
                                                </a>
                                            </figure>
                                            <div class="product-details">
                                                <h3 class="product-title"> <a href="{{ route('products.index') }}">Brown
                                                        Women Casual
                                                        HandBag</a> </h3>
                                                <div class="ratings-container">
                                                    <div class="product-ratings">
                                                        <span class="ratings" style="width:100%"></span>
                                                        <!-- End .ratings -->
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <!-- End .product-ratings -->
                                                </div>
                                                <!-- End .product-container -->
                                                <div class="price-box">
                                                    <span class="product-price">$150.00</span>
                                                </div>
                                                <!-- End .price-box -->
                                            </div>
                                            <!-- End .product-details -->
                                        </div>
                                        <div class="product-default left-details product-widget">
                                            <figure>
                                                <a href="{{ route('products.index') }}">
                                                    <img src="{{ asset('assets/images/products/product-3.jpg') }}"
                                                        width="75" height="75" alt="product">
                                                    <img src="{{ asset('assets/images/products/product-3-2.jpg') }}"
                                                        width="75" height="75" alt="product">
                                                </a>
                                            </figure>
                                            <div class="product-details">
                                                <h3 class="product-title"> <a
                                                        href="{{ route('products.index') }}">Postcard Printing</a> </h3>
                                                <div class="ratings-container">
                                                    <div class="product-ratings">
                                                        <span class="ratings" style="width:100%"></span>
                                                        <!-- End .ratings -->
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <!-- End .product-ratings -->
                                                </div>
                                                <!-- End .product-container -->
                                                <div class="price-box">
                                                    <span class="product-price">$149.00</span>
                                                </div>
                                                <!-- End .price-box -->
                                            </div>
                                            <!-- End .product-details -->
                                        </div>
                                    </div>
                                    <!-- End .featured-col -->
                                </div>
                                <!-- End .widget-featured-slider -->
                            </div>
                            <!-- End .widget-body -->
                        </div>
                        <!-- End .widget -->

                        <div class="widget widget-block">
                            <h3 class="widget-title">{{ __('category.printing_services') }}</h3>
                            <h5>{{ __('category.printing_services_subtitle') }}</h5>
                            <p>
                                {{ __('category.printing_services_text') }}
                            </p>
                        </div>

                        <!-- End .widget -->
                    </div>
                    <!-- End .sidebar-wrapper -->
                </aside>
                <!-- End .col-lg-3 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->

        <div class="mb-4"></div>
        <!-- margin -->
    </main>

    <style>
        /* Professional List View Styles */
        .list-view .product-default {
            display: flex;
            align-items: flex-start;
            margin-bottom: 2rem;
            padding: 20px;
            border: 1px solid #eee;
            border-radius: 8px;
            background: #fff;
        }
        
        .list-view .product-default:hover {
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            border-color: #ddd;
        }
        
        .list-view .product-default figure {
            flex: 0 0 280px;
            max-width: 280px;
            margin-right: 15px;
        }

        .list-view .product-default figure img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            border-radius: 8px;
        }
        
        .list-view .product-default .product-details {
            flex: 1;
            text-align: left;
            padding: 0;
        }
        
        .list-view .product-default .product-title {
            font-size: 1.6rem;
            margin-bottom: 12px;
            font-weight: 600;
        }
        
        .list-view .product-default .price-box {
            margin-bottom: 15px;
        }

        /* RTL Arrow Fix for Categories Sidebar */
        [dir="rtl"] .cat-list .toggle {
            transform: rotate(180deg);
        }
    </style>

    <script>
        function fetchProducts(url) {
            document.getElementById('products-grid').style.opacity = '0.5';
            
            fetch(url)
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                
                const newProductsGrid = doc.getElementById('products-grid');
                if (newProductsGrid) {
                    document.getElementById('products-grid').innerHTML = newProductsGrid.innerHTML;
                    
                    const viewMode = localStorage.getItem('viewMode');
                    if (viewMode === 'list') {
                        setListView({ preventDefault: function() {} });
                    } else {
                        setGridView({ preventDefault: function() {} });
                    }
                }
                
                const newPagination = doc.querySelector('.toolbox-pagination');
                const currentPagination = document.querySelector('.toolbox-pagination');
                
                if (newPagination && currentPagination) {
                    currentPagination.innerHTML = newPagination.innerHTML;
                } else if (newPagination && !currentPagination) {
                    const mainContent = document.querySelector('.main-content');
                    mainContent.insertAdjacentHTML('beforeend', `<nav class="toolbox toolbox-pagination">${newPagination.innerHTML}</nav>`);
                } else if (!newPagination && currentPagination) {
                    currentPagination.remove();
                }

                window.history.pushState({}, '', url);
                document.getElementById('products-grid').style.opacity = '1';
                setupAjaxPagination();
            })
            .catch(error => {
                console.error('Error fetching products:', error);
                document.getElementById('products-grid').style.opacity = '1';
            });
        }

        function handleSort() {
            const sortValue = document.getElementById('sortSelect').value;
            const url = new URL(window.location.href);
            url.searchParams.set('sort', sortValue);
            url.searchParams.delete('page');
            fetchProducts(url.toString());
        }

        function handlePerPage() {
            const perPageValue = document.getElementById('perPageSelect').value;
            const url = new URL(window.location.href);
            url.searchParams.set('per_page', perPageValue);
            url.searchParams.delete('page');
            fetchProducts(url.toString());
        }

        function setupAjaxPagination() {
            const paginationLinks = document.querySelectorAll('.toolbox-pagination a');
            paginationLinks.forEach(link => {
                const newLink = link.cloneNode(true);
                link.parentNode.replaceChild(newLink, link);
                
                newLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    fetchProducts(this.href);
                });
            });
        }

        function setGridView(event) {
            if(event && event.preventDefault) event.preventDefault();
            const gridBtn = document.getElementById('gridViewBtn');
            const listBtn = document.getElementById('listViewBtn');
            const productsGrid = document.getElementById('products-grid');

            if(gridBtn) gridBtn.classList.add('active');
            if(listBtn) listBtn.classList.remove('active');
            if(productsGrid) {
                productsGrid.classList.remove('list-view');
                productsGrid.classList.add('grid-view');
            }

            const products = document.querySelectorAll('#products-grid > div');
            products.forEach(product => {
                product.classList.remove('col-12');
                product.classList.add('col-6', 'col-sm-4');
            });
            
            localStorage.setItem('viewMode', 'grid');
        }

        function setListView(event) {
            if(event && event.preventDefault) event.preventDefault();
            const gridBtn = document.getElementById('gridViewBtn');
            const listBtn = document.getElementById('listViewBtn');
            const productsGrid = document.getElementById('products-grid');

            if(listBtn) listBtn.classList.add('active');
            if(gridBtn) gridBtn.classList.remove('active');
            if(productsGrid) {
                productsGrid.classList.remove('grid-view');
                productsGrid.classList.add('list-view');
            }

            const products = document.querySelectorAll('#products-grid > div');
            products.forEach(product => {
                product.classList.remove('col-6', 'col-sm-4');
                product.classList.add('col-12');
            });
            
            localStorage.setItem('viewMode', 'list');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const viewMode = localStorage.getItem('viewMode');
            if (viewMode === 'list') {
                setListView({ preventDefault: function () { } });
            }

            const sortSelect = document.getElementById('sortSelect');
            const perPageSelect = document.getElementById('perPageSelect');
            if (sortSelect) sortSelect.addEventListener('change', handleSort);
            if (perPageSelect) perPageSelect.addEventListener('change', handlePerPage);

            setupAjaxPagination();
        });
    </script>
@endsection

