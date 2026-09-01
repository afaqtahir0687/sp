@extends('frontend.layouts.master')

@section('title', __('books.title'))
@section('meta_description', __('books.meta_description'))
@section('meta_keywords', __('books.meta_keywords'))

@section('content')
    <main class="main">
        <div class="category-banner-container bg-gray">
            <div class="category-banner banner text-uppercase"
                style="background: no-repeat 60%/cover url('{{ asset('assets/images/banners/banner-top.jpg') }}'); min-height: 300px; display: flex; align-items: center;">
                <div class="container position-relative">
                    <div class="row">
                        <div class="pb-5 pb-md-0 col-sm-10 col-xl-8 col-lg-8 mb-4">
                            <h3>{{ __('books.books') }}</h3>
                            <a href="#books-grid" class="btn btn-dark">{{ __('books.shop_now') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('books.books') }}</li>
                </ol>
            </nav>

            <div class="row">
                <div class="sidebar-overlay"></div>
                <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                    <div class="sidebar-wrapper">
                        <div class="widget">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-body-filter" role="button" aria-expanded="true"
                                    aria-controls="widget-body-filter">{{ __('books.filters') }}</a>
                            </h3>

                            <div class="collapse show" id="widget-body-filter">
                                <div class="widget-body">
                                    <div class="filter-category mb-4">
                                        <h4 class="widget-subtitle">{{ __('books.categories') }}</h4>
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
                                                    <span class="checkbox-text">{{ __('books.all_categories') }}</span>
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
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <hr>

                                    <div class="filter-category mb-4">
                                        <h4 class="widget-subtitle">{{ __('books.authors') }}</h4>
                                        <ul class="category-list" style="list-style: none; padding-left: 0;">
                                            <li>
                                                <label class="filter-checkbox-label">
                                                    <input type="checkbox"
                                                        name="author"
                                                        value="all"
                                                        class="filter-checkbox author-checkbox"
                                                        id="author-all"
                                                        @checked(!request()->has('author') || (request()->has('author') && request()->get('author') === 'all'))
                                                        onclick="handleAuthorFilter(this)">
                                                    <span class="checkbox-text">{{ __('books.all_authors') }}</span>
                                                </label>
                                            </li>
                                            @foreach($authors as $author)
                                                <li class="mt-2">
                                                    <label class="filter-checkbox-label">
                                                        <input type="checkbox"
                                                            name="author"
                                                            value="{{ $author->slug }}"
                                                            class="filter-checkbox author-checkbox"
                                                            id="author-{{ $author->slug }}"
                                                            @checked(request()->has('author') && in_array($author->slug, explode(',', request()->get('author'))))
                                                            onclick="handleAuthorFilter(this)">
                                                        <span class="checkbox-text">{{ $author->name }}</span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <hr>

                                    <div class="filter-category mb-4">
                                        <h4 class="widget-subtitle">{{ __('books.publishers') }}</h4>
                                        <ul class="category-list" style="list-style: none; padding-left: 0;">
                                            <li>
                                                <label class="filter-checkbox-label">
                                                    <input type="checkbox"
                                                        name="publisher"
                                                        value="all"
                                                        class="filter-checkbox publisher-checkbox"
                                                        id="publisher-all"
                                                        @checked(!request()->has('publisher') || (request()->has('publisher') && request()->get('publisher') === 'all'))
                                                        onclick="handlePublisherFilter(this)">
                                                    <span class="checkbox-text">{{ __('books.all_publishers') }}</span>
                                                </label>
                                            </li>
                                            @foreach($publishers as $publisher)
                                                <li class="mt-2">
                                                    <label class="filter-checkbox-label">
                                                        <input type="checkbox"
                                                            name="publisher"
                                                            value="{{ $publisher->slug }}"
                                                            class="filter-checkbox publisher-checkbox"
                                                            id="publisher-{{ $publisher->slug }}"
                                                            @checked(request()->has('publisher') && in_array($publisher->slug, explode(',', request()->get('publisher'))))
                                                            onclick="handlePublisherFilter(this)">
                                                        <span class="checkbox-text">{{ $publisher->name }}</span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="mt-4">
                                        <button type="button" class="btn btn-outline-secondary btn-sm btn-block mt-2" onclick="clearFilters()">{{ __('books.clear_filters') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="widget widget-block mt-4">
                            <h3 class="widget-title">{{ __('books.sidebar_title') }}</h3>
                            <h5>{{ __('books.sidebar_subtitle') }}</h5>
                            <p>{{ __('books.sidebar_text') }}</p>
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
                                <span>{{ __('books.filter') }}</span>
                            </a>

                            <div class="toolbox-item toolbox-sort">
                                <label>{{ __('books.sort_by') }}</label>

                                <div class="select-custom">
                                    <select name="orderby" class="form-control" id="sortSelect">
                                        <option value="default">{{ __('books.default_sorting') }}</option>
                                        <option value="newest">{{ __('books.sort_newest') }}</option>
                                        <option value="oldest">{{ __('books.sort_oldest') }}</option>
                                        <option value="price-asc">{{ __('books.sort_price_asc') }}</option>
                                        <option value="price-desc">{{ __('books.sort_price_desc') }}</option>
                                        <option value="name-asc">{{ __('books.sort_name_asc') }}</option>
                                        <option value="name-desc">{{ __('books.sort_name_desc') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="toolbox-right">
                            <div class="toolbox-item toolbox-show">
                                <label>{{ __('books.show') }}</label>

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

                    <div class="row" id="books-grid">
                        @forelse($books as $book)
                            <div class="col-6 col-sm-4">
                                <div class="product-default">
                                    <figure>
                                        <a href="{{ route('books.show', $book->slug) }}">
                                            @if($book->images && count($book->images) > 0)
                                                <img src="{{ asset('storage/app/public/' . $book->images[0]) }}" width="280" height="280"
                                                    alt="{{ $book->name }}" />
                                            @else
                                                <img src="{{ asset('assets/images/products/product-1.jpg') }}" width="280"
                                                    height="280" alt="{{ $book->name }}" />
                                            @endif
                                        </a>

                                        <div class="label-group">
                                            @if($book->is_featured)
                                                <div class="product-label label-hot">{{ __('books.featured') }}</div>
                                            @endif
                                        </div>
                                    </figure>

                                    <div class="product-details">
                                        <h3 class="product-title">
                                            <a href="{{ route('books.show', $book->slug) }}">{{ $book->name }}</a>
                                        </h3>
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings"></span>
                                            </div>
                                        </div>
                                        <div class="price-box">
                                            <span class="product-price">{{ format_price($book->price) }}</span>
                                        </div>
                                        <div class="product-action">
                                            <a href="{{ route('books.show', $book->slug) }}" class="btn-icon btn-add-cart"><i class="fa fa-arrow-right" style="padding: 1px 6px;"></i><span>Select Options</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-center">{{ __('books.no_books_found') }}</p>
                            </div>
                        @endforelse
                    </div>

                    <nav aria-label="Page navigation" class="pagination-tool mt-4">
                        {{ $books->appends(request()->query())->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </main>

    <style>
        .filter-checkbox-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 5px 0;
        }

        .filter-checkbox-label input[type="checkbox"] {
            margin-right: 10px;
            accent-color: #D90D91;
        }

        .filter-checkbox-label .checkbox-text {
            font-size: 14px;
            color: #333;
            font-weight: 500;
            pointer-events: none;
        }

        .filter-checkbox-label input[type="checkbox"]:checked + .checkbox-text {
            color: #D90D91;
            font-weight: 600;
        }

        .filter-checkbox-label input[type="checkbox"]:checked ~ .checkbox-text {
            color: #D90D91;
        }
    </style>

    <script>
        function handleCategoryFilter(checkbox) {
            const allCheckbox = document.querySelector('input[name="category"][value="all"]');
            const categoryCheckboxes = document.querySelectorAll('input[name="category"]:not([value="all"])');
            
            const categorySlug = checkbox ? checkbox.value : null;
            
            if (categorySlug === 'all' && checkbox.checked) {
                categoryCheckboxes.forEach(cb => {
                    cb.checked = false;
                });
            } else if (categorySlug !== 'all' && checkbox.checked) {
                if (allCheckbox) allCheckbox.checked = false;
            } else if (categorySlug !== 'all' && !checkbox.checked) {
                // If a specific category was unchecked
            }
            
            let anyCategoryChecked = false;
            categoryCheckboxes.forEach(cb => {
                if (cb.checked) {
                    anyCategoryChecked = true;
                    if (allCheckbox) allCheckbox.checked = false;
                }
            });
            
            if (!anyCategoryChecked && allCheckbox) {
                allCheckbox.checked = true;
            }
            
            applyFilters();
        }

        function handleAuthorFilter(checkbox) {
            const allCheckbox = document.querySelector('input[name="author"][value="all"]');
            const authorCheckboxes = document.querySelectorAll('input[name="author"]:not([value="all"])');
            
            const authorSlug = checkbox ? checkbox.value : null;
            
            if (authorSlug === 'all' && checkbox.checked) {
                authorCheckboxes.forEach(cb => {
                    cb.checked = false;
                });
            } else if (authorSlug !== 'all' && checkbox.checked) {
                if (allCheckbox) allCheckbox.checked = false;
            }
            
            let anyAuthorChecked = false;
            authorCheckboxes.forEach(cb => {
                if (cb.checked) {
                    anyAuthorChecked = true;
                    if (allCheckbox) allCheckbox.checked = false;
                }
            });
            
            if (!anyAuthorChecked && allCheckbox) {
                allCheckbox.checked = true;
            }
            
            applyFilters();
        }

        function handlePublisherFilter(checkbox) {
            const allCheckbox = document.querySelector('input[name="publisher"][value="all"]');
            const publisherCheckboxes = document.querySelectorAll('input[name="publisher"]:not([value="all"])');
            
            const publisherSlug = checkbox ? checkbox.value : null;
            
            if (publisherSlug === 'all' && checkbox.checked) {
                publisherCheckboxes.forEach(cb => {
                    cb.checked = false;
                });
            } else if (publisherSlug !== 'all' && checkbox.checked) {
                if (allCheckbox) allCheckbox.checked = false;
            }
            
            let anyPublisherChecked = false;
            publisherCheckboxes.forEach(cb => {
                if (cb.checked) {
                    anyPublisherChecked = true;
                    if (allCheckbox) allCheckbox.checked = false;
                }
            });
            
            if (!anyPublisherChecked && allCheckbox) {
                allCheckbox.checked = true;
            }
            
            applyFilters();
        }

        function applyFilters() {
            const selectedCategories = [];
            const selectedAuthors = [];
            const selectedPublishers = [];
            
            document.querySelectorAll('input[name="category"]:checked').forEach(checkbox => {
                selectedCategories.push(checkbox.value);
            });
            
            document.querySelectorAll('input[name="author"]:checked').forEach(checkbox => {
                selectedAuthors.push(checkbox.value);
            });
            
            document.querySelectorAll('input[name="publisher"]:checked').forEach(checkbox => {
                selectedPublishers.push(checkbox.value);
            });
            
            const url = new URL(window.location.href);
            url.searchParams.delete('page');
            
            if (selectedCategories.length > 0 && !selectedCategories.includes('all')) {
                url.searchParams.set('category', selectedCategories.join(','));
            } else {
                url.searchParams.delete('category');
            }
            
            if (selectedAuthors.length > 0 && !selectedAuthors.includes('all')) {
                url.searchParams.set('author', selectedAuthors.join(','));
            } else {
                url.searchParams.delete('author');
            }
            
            if (selectedPublishers.length > 0 && !selectedPublishers.includes('all')) {
                url.searchParams.set('publisher', selectedPublishers.join(','));
            } else {
                url.searchParams.delete('publisher');
            }
            
            window.location.href = url.toString();
        }

        function clearFilters() {
            document.querySelectorAll('input[name="category"]').forEach(checkbox => {
                checkbox.checked = false;
            });
            
            document.querySelectorAll('input[name="author"]').forEach(checkbox => {
                checkbox.checked = false;
            });
            
            document.querySelectorAll('input[name="publisher"]').forEach(checkbox => {
                checkbox.checked = false;
            });
            
            // Check all "all" checkboxes
            document.getElementById('category-all').checked = true;
            document.getElementById('author-all').checked = true;
            document.getElementById('publisher-all').checked = true;
            
            const url = new URL(window.location.href);
            url.searchParams.delete('category');
            url.searchParams.delete('author');
            url.searchParams.delete('publisher');
            url.searchParams.delete('page');
            
            window.location.href = url.toString();
        }

        function setGridView(event) {
            event.preventDefault();
            document.getElementById('gridViewBtn').classList.add('active');
            document.getElementById('listViewBtn').classList.remove('active');
            document.getElementById('books-grid').classList.remove('list-view');
        }

        function setListView(event) {
            event.preventDefault();
            document.getElementById('listViewBtn').classList.add('active');
            document.getElementById('gridViewBtn').classList.remove('active');
            document.getElementById('books-grid').classList.add('list-view');
        }
    </script>
@endsection
