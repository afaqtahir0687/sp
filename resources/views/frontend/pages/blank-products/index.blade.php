@extends('frontend.layouts.master')

@section('title', __('blank_products.title'))
@section('meta_description', __('blank_products.meta_description'))
@section('meta_keywords', __('blank_products.meta_keywords'))

@section('content')
    <main class="main">
        <div class="category-banner-container bg-gray">
            <div class="category-banner banner text-uppercase"
                style="background: no-repeat 60%/cover url('{{ asset('assets/images/banners/banner-top.jpg') }}'); min-height: 300px; display: flex; align-items: center;">
                <div class="container position-relative">
                    <div class="row">
                        <div class="pb-5 pb-md-0 col-sm-10 col-xl-8 col-lg-8 mb-4">
                            <h3>{{ __('blank_products.blank_products') }}</h3>
                            <a href="#products-grid" class="btn btn-dark">{{ __('blank_products.shop_now') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('blank_products.blank_products') }}</li>
                </ol>
            </nav>

            <div class="row">
                <div class="sidebar-overlay"></div>
                <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                    <div class="sidebar-wrapper">
                        <div class="widget">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-body-filter" role="button" aria-expanded="true"
                                    aria-controls="widget-body-filter">{{ __('blank_products.filters') }}</a>
                            </h3>

                            <div class="collapse show" id="widget-body-filter">
                                <div class="widget-body">
                                    <div class="filter-category mb-4">
                                        <h4 class="widget-subtitle">{{ __('blank_products.categories') }}</h4>
                                        <ul class="category-list" style="list-style: none; padding-left: 0;">
                                            <li>
                                                <label class="filter-checkbox-label">
                                                    <input type="checkbox"
                                                        name="category"
                                                        value="all"
                                                        class="filter-checkbox category-checkbox"
                                                        id="category-all"
                                                        @checked(!request()->has('category') || (request()->has('category') && request()->get('category') === 'all'))
                                                        onclick="handleCategoryFilter(this)">
                                                    <span class="checkbox-text">{{ __('blank_products.all_categories') }}</span>
                                                </label>
                                            </li>
                                            @foreach($categories as $cat)
                                                <li class="mt-2">
                                                    <label class="filter-checkbox-label">
                                                        <input type="checkbox"
                                                            name="category"
                                                            value="{{ $cat->slug }}"
                                                            class="filter-checkbox category-checkbox"
                                                            id="category-{{ $cat->slug }}"
                                                            @checked(request()->has('category') && in_array($cat->slug, explode(',', request()->get('category'))))
                                                            onclick="handleCategoryFilter(this)">
                                                        <span class="checkbox-text">{{ $cat->name }}</span>
                                                    </label>
                                                    @if($cat->blankSubcategories && $cat->blankSubcategories->count() > 0)
                                                        <ul class="subcategory-list" id="subcategories-{{ $cat->slug }}" style="list-style: none; padding-left: 15px; margin-top: 5px; display: none;">
                                                            @foreach($cat->blankSubcategories as $sub)
                                                                <li>
                                                                    <label class="filter-checkbox-label">
                                                                        <input type="checkbox"
                                                                            name="subcategory"
                                                                            value="{{ $sub->slug }}"
                                                                            class="filter-checkbox subcategory-checkbox"
                                                                            data-category="{{ $cat->slug }}"
                                                                            @checked(request()->has('subcategory') && in_array($sub->slug, explode(',', request()->get('subcategory'))))
                                                                            onclick="handleSubcategoryFilter()">
                                                                        <span class="checkbox-text">{{ $sub->name_en ?? $sub->name }}</span>
                                                                    </label>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <hr>



                                    <div class="mt-4">
                                        <button type="button" class="btn btn-outline-secondary btn-sm btn-block mt-2" onclick="clearFilters()">{{ __('blank_products.clear_filters') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="widget widget-block mt-4">
                            <h3 class="widget-title">{{ __('blank_products.sidebar_title') }}</h3>
                            <h5>{{ __('blank_products.sidebar_subtitle') }}</h5>
                            <p>{{ __('blank_products.sidebar_text') }}</p>
                        </div>
                    </div>
                </aside>

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
                                <span>{{ __('blank_products.filter') }}</span>
                            </a>

                            <div class="toolbox-item toolbox-sort">
                                <label>{{ __('blank_products.sort_by') }}</label>

                                <div class="select-custom">
                                    <select name="orderby" class="form-control" id="sortSelect">
                                        <option value="default">{{ __('blank_products.default_sorting') }}</option>
                                        <option value="newest">{{ __('blank_products.sort_newest') }}</option>
                                        <option value="oldest">{{ __('blank_products.sort_oldest') }}</option>
                                        <option value="price-asc">{{ __('blank_products.sort_price_asc') }}</option>
                                        <option value="price-desc">{{ __('blank_products.sort_price_desc') }}</option>
                                        <option value="name-asc">{{ __('blank_products.sort_name_asc') }}</option>
                                        <option value="name-desc">{{ __('blank_products.sort_name_desc') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="toolbox-right">
                            <div class="toolbox-item toolbox-show">
                                <label>{{ __('blank_products.show') }}</label>

                                <div class="select-custom">
                                    <select name="count" class="form-control" id="perPageSelect">
                                        <option value="12">12</option>
                                        <option value="24">24</option>
                                        <option value="36">36</option>
                                        <option value="48">48</option>
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

                    <div class="row" id="products-grid">
                        @forelse($blankProducts as $blankProduct)
                            <div class="col-6 col-sm-4">
                                <div class="product-default">
                                    <figure>
                                        <a href="{{ route('blank-products.show', $blankProduct->slug) }}">
                                            @if($blankProduct->image)
                                                <img src="{{ asset('storage/app/public/' . $blankProduct->image) }}" width="280" height="280"
                                                    alt="{{ $blankProduct->name }}" />
                                            @else
                                                <img src="{{ asset('assets/images/products/product-1.jpg') }}" width="280"
                                                    height="280" alt="{{ $blankProduct->name }}" />
                                            @endif

                                            @if($blankProduct->images && count($blankProduct->images) > 0)
                                                <img src="{{ asset('storage/app/public/' . $blankProduct->images[0]) }}" width="280" height="280"
                                                    alt="{{ $blankProduct->name }}" />
                                            @endif
                                        </a>

                                        <div class="label-group">
                                            @if($blankProduct->is_featured)
                                                <div class="product-label label-hot">{{ __('blank_products.hot') }}</div>
                                            @endif
                                            @if($blankProduct->is_new_arrival)
                                                <div class="product-label label-new">{{ __('blank_products.new') }}</div>
                                            @endif
                                            @if($blankProduct->discount_price)
                                                @php
                                                    $percentage = round((($blankProduct->price - $blankProduct->discount_price) / $blankProduct->price) * 100);
                                                @endphp
                                                <div class="product-label label-sale">{{ $percentage }}% {{ __('blank_products.off') }}</div>
                                            @endif
                                        </div>
                                    </figure>

                                    <!-- Small Image for Popup (List View Only, Between Image and Text) -->
                                    <!-- <div class="list-view-thumbnail-container">
                                        <a href="javascript:void(0)" class="open-image-modal" data-img="{{ $blankProduct->image ? asset('storage/app/public/' . $blankProduct->image) : asset('assets/images/products/product-1.jpg') }}" data-title="{{ $blankProduct->name }}" title="View Full Image">
                                            <img src="{{ $blankProduct->image ? asset('storage/app/public/' . $blankProduct->image) : asset('assets/images/products/product-1.jpg') }}" alt="Thumbnail" style="width: 55px; height: 55px; object-fit: cover; border-radius: 6px; border: 2px solid #eaeaea; cursor: pointer; transition: all 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.1);" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                        </a>
                                    </div> -->

                                    <div class="product-details">
                                        <div class="category-list">
                                            <a href="{{ route('blank-products.index') }}" class="product-category">{{ __('blank_products.blank_products') }}</a>
                                        </div>
                                        <h3 class="product-title">
                                            <a href="{{ route('blank-products.show', $blankProduct->slug) }}">{{ $blankProduct->name }}</a>
                                        </h3>
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:0%"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                        </div>

                                        <div class="price-box">
                                            @if($blankProduct->discount_price)
                                                <del class="old-price">{{ format_price($blankProduct->price) }}</del>
                                            @endif
                                            <span class="product-price">{{ format_price($blankProduct->discount_price ?? $blankProduct->price) }}</span>
                                        </div>
                                        <div class="product-action">
                                            <a href="#" class="btn-icon-wish" title="wishlist" data-wishlist-id="{{ $blankProduct->id }}" data-wishlist-type="blank"><i class="icon-heart"></i></a>
                                            <a href="#" class="btn-icon btn-add-cart"><i class="fa fa-arrow-right" style="padding: 1px 6px;"></i><span>{{ __('blank_products.select_options') }}</span></a>
                                            <a href="{{ route('blank-products.show', $blankProduct->slug) }}" class="btn-quickview" title="{{ __('blank_products.quick_view') }}"><i
                                                    class="fas fa-external-link-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">
                                    @if(request()->has('size') || request()->has('color'))
                                        {{ __('blank_products.no_products_filter') }}
                                    @elseif(request()->has('category'))
                                        No products found in this category.
                                    @else
                                        {{ __('blank_products.no_products') }}
                                    @endif
                                </div>
                            </div>
                        @endforelse
                    </div>

                    @if($blankProducts->hasPages())
                        <nav class="toolbox toolbox-pagination">
                            {{ $blankProducts->links('pagination::bootstrap-4') }}
                        </nav>
                    @endif
                </div>
            </div>
        </div>
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
            margin-bottom: 15px;
        }
        
        .list-view .product-default .product-action {
            margin-top: 15px;
        }
    </style>

    <script>
        function handleCategoryFilter(checkbox) {
            const allCheckbox = document.querySelector('input[name="category"][value="all"]');
            const categoryCheckboxes = document.querySelectorAll('input[name="category"]:not([value="all"])');
            
            const categorySlug = checkbox ? checkbox.value : null;
            
            if (categorySlug === 'all' && checkbox.checked) {
                // If "All" was checked, uncheck all specific categories
                categoryCheckboxes.forEach(cb => {
                    cb.checked = false;
                    const subList = document.getElementById('subcategories-' + cb.value);
                    if (subList) {
                        subList.style.display = 'none';
                        const subs = subList.querySelectorAll('input[type="checkbox"]');
                        subs.forEach(s => s.checked = false);
                    }
                });
            } else if (categorySlug !== 'all' && checkbox.checked) {
                // If a specific category was checked, uncheck "All"
                if (allCheckbox) allCheckbox.checked = false;
                const subcategoryList = document.getElementById('subcategories-' + categorySlug);
                if (subcategoryList) {
                    subcategoryList.style.display = 'block';
                }
            } else if (categorySlug !== 'all' && !checkbox.checked) {
                // If a specific category was unchecked, hide its subcategories
                const subcategoryList = document.getElementById('subcategories-' + categorySlug);
                if (subcategoryList) {
                    subcategoryList.style.display = 'none';
                    const subs = subcategoryList.querySelectorAll('input[type="checkbox"]');
                    subs.forEach(s => s.checked = false);
                }
            }
            
            // If no category is checked at all, check "All"
            let anyCategoryChecked = false;
            categoryCheckboxes.forEach(cb => {
                if (cb.checked) {
                    anyCategoryChecked = true;
                }
            });
            
            if (!anyCategoryChecked && allCheckbox) {
                allCheckbox.checked = true;
            }
            
            applyFilters();
        }

        function handleSubcategoryFilter() {
            applyFilters();
        }

        function applyFilters() {
            const selectedCategories = [];
            const selectedSubcategories = [];
            
            document.querySelectorAll('input[name="category"]:checked').forEach(checkbox => {
                selectedCategories.push(checkbox.value);
            });
            
            document.querySelectorAll('input[name="subcategory"]:checked').forEach(checkbox => {
                selectedSubcategories.push(checkbox.value);
            });
            
            const url = new URL(window.location.href);
            url.searchParams.delete('page');
            
            if (selectedCategories.length > 0 && !selectedCategories.includes('all')) {
                url.searchParams.set('category', selectedCategories.join(','));
            } else {
                url.searchParams.delete('category');
            }
            
            if (selectedSubcategories.length > 0) {
                url.searchParams.set('subcategory', selectedSubcategories.join(','));
            } else {
                url.searchParams.delete('subcategory');
            }
            
            fetchProducts(url.toString());
        }

        function clearFilters() {
            document.querySelectorAll('input[name="category"]').forEach(checkbox => {
                checkbox.checked = false;
            });
            
            // Check "All" categories by default
            const allCheckbox = document.querySelector('input[name="category"][value="all"]');
            if (allCheckbox) allCheckbox.checked = true;
            
            document.querySelectorAll('input[name="subcategory"]').forEach(checkbox => {
                checkbox.checked = false;
            });
            
            const url = new URL(window.location.href);
            url.searchParams.delete('category');
            url.searchParams.delete('subcategory');
            url.searchParams.delete('page');
            
            fetchProducts(url.toString());
        }

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
            
            // Initialize subcategory visibility based on selected categories
            const selectedCategories = [];
            document.querySelectorAll('input[name="category"]:checked').forEach(cb => {
                if (cb.value !== 'all') {
                    selectedCategories.push(cb.value);
                }
            });
            
            selectedCategories.forEach(categorySlug => {
                const subcategoryList = document.getElementById('subcategories-' + categorySlug);
                if (subcategoryList) {
                    subcategoryList.style.display = 'block';
                }
            });
        });



        function toggleFilters(type) {

    let hiddenItems = document.querySelectorAll('.extra-' + type + '.d-none');
    let button = document.getElementById(type === 'size' ? 'toggleSizes' : 'toggleColors');

    if (hiddenItems.length > 0) {

        // Show next 5
        let count = 0;

        hiddenItems.forEach(item => {
            if (count < 5) {
                item.classList.remove('d-none');
                count++;
            }
        });

        // If no more hidden items
        if (document.querySelectorAll('.extra-' + type + '.d-none').length === 0) {
            button.innerHTML = button.getAttribute('data-show-less');
        }

    } else {

        // Hide all except first 5
        let items = document.querySelectorAll('.' + type + '-item');

        items.forEach((item, index) => {
            if (index >= 5) {
                item.classList.add('d-none');
            }
        });

        button.innerHTML = button.getAttribute('data-show-more');
    }
}
    </script>

    <style>
        .filter-checkbox-label {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            margin-bottom: 5px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #eaeaea;
        }

        .filter-checkbox-label:hover {
            background-color: #f8f8f8;
            border-color: #d0d0d0;
        }

        .filter-checkbox-label input[type="checkbox"] {
            margin-right: 10px;
            accent-color: #2596be;
        }

        .filter-checkbox-label .checkbox-text {
            font-size: 14px;
            color: #333;
            font-weight: 500;
            pointer-events: none;
        }

        .filter-checkbox-label input[type="checkbox"]:checked + .checkbox-text {
            color: #2596be;
            font-weight: 600;
        }

        .filter-checkbox-label input[type="checkbox"]:checked ~ .checkbox-text {
            color: #2596be;
        }

        .config-size-list {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .widget-subtitle {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
            border-bottom: 2px solid #2596be;
            padding-bottom: 8px;
        }

        .widget-block {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #2596be;
        }

        .widget-block h3 {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }

        .widget-block h5 {
            font-size: 14px;
            font-weight: 600;
            color: #666;
            margin-bottom: 10px;
        }

        .widget-block p {
            font-size: 13px;
            color: #777;
            line-height: 1.6;
            margin-bottom: 0;
        }
        #toggleSizes,
        #toggleColors {
            display: inline-block;
            margin-top: 8px;
            color: #2596be;
            font-size: 14px;
            font-weight: 500;
            text-decoration: underline;
            cursor: pointer;
            background: transparent;
            border: none;
        }

        #toggleSizes:hover,
        #toggleColors:hover {
            color: #b10b76;
            text-decoration: underline;
        }
    </style>
@endsection

