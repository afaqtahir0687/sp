@extends('frontend.layouts.master')

@section('title', $category->name)
@section('meta_description', 'Explore our ' . $category->name . ' collection. High-quality professional printing services for ' . $category->name . ' and more at Crelogics.')
@section('meta_keywords', $category->name . ', printing, advertisement, customized ' . $category->name . ', professional printing')

@section('content')
    <main class="main">
        <div class="category-banner-container bg-gray">
            <div class="category-banner banner text-uppercase"
                style="background: no-repeat 60%/cover url('{{ $isSubcategory && $category->banner_image ? asset('storage/app/public/' . $category->banner_image) : ($bannerCategory->image ? asset('storage/app/public/' . $bannerCategory->image) : asset('assets/images/banners/banner-top.jpg')) }}'); min-height: 300px; display: flex; align-items: center;">
                <div class="container position-relative">
                    <div class="row">
                        <div class="pb-5 pb-md-0 col-sm-10 col-xl-8 col-lg-8 mb-4">
                            <h3
                                style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; word-break: break-word;{{ ($isSubcategory && $category->banner_text_color) ? ' color: ' . $category->banner_text_color . ';' : '' }}">
                                @if($isSubcategory && $category->banner_title)
                                    {{ $category->banner_title }}
                                @else
                                    {{ $category->name }}
                                @endif
                            </h3>
                            <a href="{{ ($isSubcategory && $category->banner_button_link) ? $category->banner_button_link : '#products-grid' }}" class="btn btn-dark">
                                @if($isSubcategory && $category->banner_button_text)
                                    {{ $category->banner_button_text }}
                                @else
                                    {{ __('category.get_yours') }}
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('category.index') }}">{{ __('category.categories') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-lg-9 main-content">
                    @if($showProductsGrid)
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
                                        <option value="default" {{ $sort == 'default' || !$sort ? 'selected' : '' }}>{{ __('category.default_sorting') }}</option>
                                        <option value="newest" {{ $sort == 'newest' ? 'selected' : '' }}>{{ __('category.sort_by_newness') }}</option>
                                        <option value="oldest" {{ $sort == 'oldest' ? 'selected' : '' }}>{{ __('category.sort_by_oldest') }}</option>
                                        <option value="price-asc" {{ $sort == 'price-asc' ? 'selected' : '' }}>{{ __('category.sort_by_price_low_high') }}</option>
                                        <option value="price-desc" {{ $sort == 'price-desc' ? 'selected' : '' }}>{{ __('category.sort_by_price_high_low') }}</option>
                                        <option value="name-asc" {{ $sort == 'name-asc' ? 'selected' : '' }}>{{ __('category.sort_by_name_a_z') }}</option>
                                        <option value="name-desc" {{ $sort == 'name-desc' ? 'selected' : '' }}>{{ __('category.sort_by_name_z_a') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="toolbox-right">
                            <div class="toolbox-item toolbox-show">
                                <label>{{ __('category.show') }}</label>

                                <div class="select-custom">
                                    <select name="count" class="form-control" id="perPageSelect">
                                        <option value="12" {{ $perPage == 12 ? 'selected' : '' }}>12</option>
                                        <option value="24" {{ $perPage == 24 ? 'selected' : '' }}>24</option>
                                        <option value="36" {{ $perPage == 36 ? 'selected' : '' }}>36</option>
                                        <option value="48" {{ $perPage == 48 ? 'selected' : '' }}>48</option>
                                    </select>
                                </div>
                            </div>

                            <div class="toolbox-item layout-modes">
                                <a href="#" class="layout-btn btn-grid active" id="gridViewBtn" onclick="setGridView(event)"
                                    title="Grid">
                                    <i class="icon-mode-grid"></i>
                                </a>
                                <a href="#" class="layout-btn btn-list" id="listViewBtn" onclick="setListView(event)"
                                    title="List">
                                    <i class="icon-mode-list"></i>
                                </a>
                            </div>
                        </div>
                    </nav>
                    @endif

                    @if($subcategories->count() > 0)
                        <div class="subcategories-section mb-4">
                            <h3 class="section-title mb-3">Subcategories</h3>
                            <div class="row">
                                @foreach($subcategories as $subcategory)
                                    <div class="col-6 col-md-4 col-lg-3 mb-3">
                                        <a href="{{ route('subcategory.show', [$category->slug, $subcategory->slug]) }}" class="subcategory-card">
                                            <div class="card h-100 text-center">
                                                @if($subcategory->image)
                                                    <img src="{{ asset('storage/app/public/' . $subcategory->image) }}" class="card-img-top"
                                                        alt="{{ $subcategory->name }}" style="height: 150px; object-fit: cover;">
                                                @else
                                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                                        style="height: 150px;">
                                                        <i class="icon-category" style="font-size: 3rem; color: #ccc;"></i>
                                                    </div>
                                                @endif
                                                <div class="card-body">
                                                    <h5 class="card-title mb-1">{{ $subcategory->name }}</h5>
                                                    <p class="text-muted mb-0"><small>{{ $subcategory->products_count }} Products</small></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($showProductsGrid)
                    <div class="row" id="products-grid">
                        @forelse($products as $product)
                            <div class="col-6 col-sm-4">
                                <div class="product-default">
                                    <figure>
                                        <a
                                            href="{{ route('product.show', [$category->slug, $product->subcategory ? $product->subcategory->slug : 'no-sub', $product->slug]) }}">
                                            @if($product->image)
                                                <img src="{{ asset('storage/app/public/' . $product->image) }}" width="280" height="280"
                                                    alt="{{ $product->name }}" />
                                            @else
                                                <img src="{{ asset('assets/images/products/product-1.jpg') }}" width="280"
                                                    height="280" alt="{{ $product->name }}" />
                                            @endif

                                            @if($product->images && count($product->images) > 0)
                                                <img src="{{ asset('storage/app/public/' . $product->images[0]) }}" width="280" height="280"
                                                    alt="{{ $product->name }}" />
                                            @endif
                                        </a>

                                        <div class="label-group">
                                            @if($product->is_featured)
                                                <div class="product-label label-hot">HOT</div>
                                            @endif
                                            @if($product->discount_percent)
                                                <div class="product-label label-sale">{{ $product->discount_percent }}% off</div>
                                            @endif
                                        </div>
                                    </figure>

                                    <!-- Small Image for Popup (List View Only, Between Image and Text) -->
                                    <div class="list-view-thumbnail-container">
                                        <a href="javascript:void(0)" class="open-image-modal" data-img="{{ $product->image ? asset('storage/app/public/' . $product->image) : asset('assets/images/products/product-1.jpg') }}" data-title="{{ $product->name }}" title="View Full Image">
                                            <img src="{{ $product->image ? asset('storage/app/public/' . $product->image) : asset('assets/images/products/product-1.jpg') }}" alt="Thumbnail" style="width: 55px; height: 55px; object-fit: cover; border-radius: 6px; border: 2px solid #eaeaea; cursor: pointer; transition: all 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.1);" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                        </a>
                                    </div>

                                    <div class="product-details">
                                        <div class="category-list">
                                            <a href="{{ route('category.show', $category->slug) }}"
                                                class="product-category">{{ $category->name }}</a>
                                        </div>
                                        <h3 class="product-title">
                                            <a
                                                href="{{ route('product.show', [$category->slug, $product->subcategory ? $product->subcategory->slug : 'no-sub', $product->slug]) }}">{{ $product->name }}</a>
                                        </h3>
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:0%"></span> <!-- Placeholder for ratings -->
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                        </div>
                                        
                                        <!-- Product List Details (Visible only in List View) -->
                                        <div class="product-list-content">
                                            @if($product->sku)
                                                <div class="product-sku mb-1 text-muted"><small><strong>SKU:</strong> {{ $product->sku }}</small></div>
                                            @endif
                                            
                                            @if($product->description)
                                                <p class="mb-2">{{ \Illuminate\Support\Str::limit(strip_tags($product->description), 150) }}</p>
                                            @endif
                                            
                                            <ul class="product-features list-unstyled mb-0">
                                                @php
                                                    $localizedMaterials = $product->getLocalizedMaterials();
                                                    $localizedSizes = $product->getLocalizedSizes();
                                                @endphp
                                                @if(isset($localizedMaterials) && is_array($localizedMaterials) && count($localizedMaterials) > 0)
                                                    <li><i class="fa fa-check text-primary mr-1"></i> <strong>{{ __('product.materials') }}</strong> {{ implode(', ', array_slice($localizedMaterials, 0, 3)) }}{{ count($localizedMaterials) > 3 ? '...' : '' }}</li>
                                                @endif
                                                @if(isset($localizedSizes) && is_array($localizedSizes) && count($localizedSizes) > 0)
                                                    <li><i class="fa fa-check text-primary mr-1"></i> <strong>{{ __('product.sizes') }}</strong> {{ implode(', ', array_slice($localizedSizes, 0, 3)) }}{{ count($localizedSizes) > 3 ? '...' : '' }}</li>
                                                @endif
                                                @if(isset($product->production_days))
                                                    <li><i class="fa fa-clock text-primary mr-1"></i> <strong>{{ __('product.production') }}</strong> {{ $product->production_days }} {{ __('product.days') }}</li>
                                                @endif
                                            </ul>
                                        </div>

                                        <div class="price-box">
                                            @if($product->old_price)
                                                <del class="old-price">{{ format_price($product->old_price) }}</del>
                                            @endif
                                            <span class="product-price">{{ format_price($product->price) }}</span>
                                        </div>
                                        <div class="product-action">
                                            <a href="#" class="btn-icon-wish" title="wishlist" data-wishlist-id="{{ $product->id }}" data-wishlist-type="product"><i class="icon-heart"></i></a>
                                            <a href="{{ $product->subcategory ? route('subcategory.show', [$category->slug, $product->subcategory->slug]) : route('products.index') }}"
                                                class="btn-icon btn-add-cart"><i class="fa fa-arrow-right" style="padding: 1px 6px;"></i><span>{{ __('home.select_options') }}</span></a>
                                            <a href="{{ route('product.show', [$category->slug, $product->subcategory ? $product->subcategory->slug : 'no-sub', $product->slug]) }}" class="btn-quickview" title="Quick View"><i
                                                    class="fas fa-external-link-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">
                                    No products found in this category.
                                </div>
                            </div>
                        @endforelse
                    </div>

                    @if($products->hasPages())
                        <nav class="toolbox toolbox-pagination">
                            {{ $products->appends(['sort' => $sort, 'per_page' => $perPage])->links('pagination::bootstrap-4') }}
                        </nav>
                    @endif
                    @endif
                </div>

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
                                        <!-- Show all categories -->
                                        @foreach(\App\Models\Category::where('status', 'active')->get() as $cat)
                                            <li class="{{ $cat->id == $category->id ? 'active' : '' }}">
                                                <a href="{{ route('category.show', $cat->slug) }}">
                                                    {{ $cat->name }} <span
                                                        class="products-count">({{ $cat->getAllProducts()->count() }})</span>
                                                </a>
                                                @if($cat->subcategories()->where('status', 'active')->count() > 0)
                                                    <ul class="cat-sublist">
                                                        @foreach($cat->subcategories()->where('status', 'active')->get() as $subcat)
                                                            <li>
                                                                <a href="{{ route('subcategory.show', [$cat->slug, $subcat->slug]) }}">
                                                                    {{ $subcat->name }} <span
                                                                        class="products-count">({{ $subcat->products()->count() }})</span>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="widget widget-block">
                            <h3 class="widget-title">{{ __('category.printing_services') }}</h3>
                            <h5>{{ __('category.professional_reliable_print_solutions') }}</h5>
                            <p>
                                {{ __('category.printing_services_description') }}
                            </p>
                        </div>
                    </div>
                </aside>
            </div>
        </div>

        <div class="mb-4"></div>
    </main>

    <style>
        /* Professional List View Styles */
        .list-view .product-default {
            display: flex;
            align-items: flex-start;
            margin-bottom: 2rem;
            border: 1px solid #eaeaea;
            padding: 20px;
            border-radius: 10px;
            transition: all 0.3s ease;
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
            margin-bottom: 0;
            position: relative;
            overflow: hidden;
            border-radius: 8px;
        }

        /* Subcategory list content only shows in list view */
        .subcategory-list-content {
            display: none;
        }
        .list-view .subcategory-list-content {
            display: block;
            margin-bottom: 10px;
        }

        /* List view thumbnail container */
        .list-view-thumbnail-container {
            display: none;
        }
        
        .list-view .list-view-thumbnail-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-right: 20px;
            padding-top: 5px;
            flex: 0 0 55px;
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
        
        .list-view .product-default .category-list {
            margin-bottom: 8px;
        }
        
        .list-view .product-default .product-title {
            font-size: 1.6rem;
            margin-bottom: 12px;
            font-weight: 600;
        }
        
        .list-view .product-default .price-box {
            justify-content: flex-start;
            margin-bottom: 15px;
            font-size: 1.8rem;
            font-weight: 700;
            color: #333;
        }
        
        .list-view .product-default .product-action {
            justify-content: flex-start;
            margin-top: 20px;
            gap: 10px;
        }
        
        .list-view .product-default .btn-add-cart {
            font-weight: 600;
            background-color: #222;
            color: #fff;
            transition: 0.3s;
        }
        
        .list-view .product-default .btn-add-cart:hover {
            background-color: #000;
        }

        /* Hidden product details in grid view */
        .product-list-content {
            display: none;
        }
        
        /* Show product details in list view */
        .list-view .product-list-content {
            display: block;
            margin-bottom: 15px;
            font-size: 1.4rem;
            color: #666;
            line-height: 1.6;
        }
        
        .list-view .product-list-content .product-features li {
            margin-bottom: 5px;
            font-size: 1.3rem;
        }
        
        .list-view .product-default .product-details {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .list-view .product-default .price-box {
            margin-top: auto;
        }

        /* Responsive adjustment for list view on mobile */
        @media (max-width: 767px) {
            .list-view .product-default {
                flex-direction: column;
                text-align: center;
                padding: 15px;
            }
            .list-view .product-default figure {
                margin-right: 0;
                margin-bottom: 20px;
                max-width: 100%;
            }
            .list-view .product-default figure img {
                height: auto;
                max-height: 300px;
            }
            .list-view .product-default .product-details {
                text-align: center;
            }
            .list-view .product-default .price-box,
            .list-view .product-default .product-action {
                justify-content: center;
            }
            
        }
    </style>

    <!-- Bootstrap Card Modal for Image -->
    <div class="modal fade" id="imageCardModal" tabindex="-1" role="dialog" aria-labelledby="imageCardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document" style="max-width: 350px;">
            <div class="modal-content" style="border-radius: 15px; border: none; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
                <div class="modal-header" style="border-bottom: 1px solid #f0f0f0; background: #fff; padding: 15px 25px;">
                    <h5 class="modal-title" id="imageCardModalLabel" style="font-weight: 600; font-size: 1.6rem; margin: 0; color: #333;">Product Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding: 15px 25px; margin: -15px -25px -15px auto; outline: none;">
                        <span aria-hidden="true" style="font-size: 2.2rem; line-height: 1;">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 25px; background: #f8f9fa; text-align: center;">
                    <img src="" id="modalCardImage" style="max-width: 100%; height: auto; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function fetchProducts(url) {
                document.getElementById('products-grid').style.opacity = '0.5';

                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
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

                // Change product columns to grid layout
                const products = document.querySelectorAll('#products-grid > div');
                products.forEach(product => {
                    product.classList.remove('col-12');
                    product.classList.add('col-6', 'col-sm-4');
                });
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

                // Change product columns to list layout
                const products = document.querySelectorAll('#products-grid > div');
                products.forEach(product => {
                    product.classList.remove('col-6', 'col-sm-4');
                    product.classList.add('col-12');
                });
            }

            // Restore view mode from localStorage on page load
            document.addEventListener('DOMContentLoaded', function () {
                const viewMode = localStorage.getItem('viewMode');
                if (viewMode === 'list') {
                    setListView({ preventDefault: function () { } });
                }

                // Wire up sort and per-page selects via JS (more robust than inline onchange)
                const sortSelect = document.getElementById('sortSelect');
                const perPageSelect = document.getElementById('perPageSelect');
                if (sortSelect) sortSelect.addEventListener('change', handleSort);
                if (perPageSelect) perPageSelect.addEventListener('change', handlePerPage);

                // Setup AJAX pagination links on initial load
                setupAjaxPagination();
            });

            // Handle image card modal opening
            document.addEventListener('click', function(e) {
                let target = e.target.closest('.open-image-modal');
                if (target) {
                    e.preventDefault();
                    let imgSrc = target.getAttribute('data-img');
                    let title = target.getAttribute('data-title');
                    
                    document.getElementById('imageCardModalLabel').textContent = title;
                    document.getElementById('modalCardImage').setAttribute('src', imgSrc);
                    
                    $('#imageCardModal').modal('show');
                }
            });

            // Save view mode to localStorage when changed
            const originalSetGridView = setGridView;
            const originalSetListView = setListView;

            setGridView = function (event) {
                originalSetGridView(event);
                localStorage.setItem('viewMode', 'grid');
            };

            setListView = function (event) {
                originalSetListView(event);
                localStorage.setItem('viewMode', 'list');
            };
        </script>
    @endpush
@endsection
