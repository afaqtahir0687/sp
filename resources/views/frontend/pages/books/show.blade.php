@extends('frontend.layouts.master')

@section('title', $book->name)
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($book->description), 160))
@section('meta_keywords', $book->name . ', books, reading, literature')

@section('content')
    <style>
        .breadcrumb-item, .breadcrumb-item a {
            text-transform: none !important;
        }

        /* RTL fixes for product gallery */
        @if(app()->getLocale() == 'ar')
            .product-single-carousel .owl-stage-outer {
                direction: ltr !important;
            }
            .product-single-carousel .owl-stage {
                direction: ltr !important;
            }
            .product-single-carousel .owl-item {
                direction: ltr !important;
            }
            .prod-thumbnail .owl-dots {
                direction: ltr !important;
            }
            .prod-thumbnail .owl-dot {
                direction: ltr !important;
            }

            /* RTL fixes for Related Products carousel */
            .products-slider .owl-stage-outer {
                direction: ltr !important;
            }
            .products-slider .owl-stage {
                direction: ltr !important;
            }
            .products-slider .owl-item {
                direction: ltr !important;
            }
            .products-slider .owl-dots {
                direction: ltr !important;
                left: 0 !important;
                right: auto !important;
            }
            .products-slider .owl-dot {
                direction: ltr !important;
            }
            .products-slider .owl-nav {
                direction: ltr !important;
            }
            .products-slider .owl-prev,
            .products-slider .owl-next {
                direction: ltr !important;
            }
        @endif
    </style>
    <main class="main">
        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('books.index') }}">{{ __('books.books') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $book->name }}</li>
                </ol>
            </nav>

            <div class="product-single-container product-single-default">
                <div class="row">
                    <div class="col-lg-5 col-md-6 product-single-gallery">
                        <div class="product-slider-container">
                            <div class="label-group">
                                @if($book->is_featured)
                                    <div class="product-label label-hot">{{ __('books.featured') }}</div>
                                @endif
                            </div>

                           <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                @if($book->images && count($book->images) > 0)
                                    @foreach($book->images as $image)
                                        <div class="product-item">
                                            <img class="product-single-image"
                                                src="{{ asset('storage/app/public/' . $image) }}"
                                                alt="{{ $book->name }}"
                                                data-zoom-image="{{ asset('storage/app/public/' . $image) }}">
                                        </div>
                                    @endforeach
                                @else
                                    <div class="product-item">
                                        <img class="product-single-image"
                                            src="{{ asset('assets/images/products/product-1.jpg') }}"
                                            alt="{{ $book->name }}">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7 col-md-6 product-single-details">
                        <h1 class="product-title">{{ $book->name }}</h1>

                        <div class="product-price">
                            <span class="product-price">{{ number_format($book->price, 2) }}</span>
                        </div>

                        <div class="product-desc">
                            <p>{{ $book->description }}</p>
                        </div>

                        <div class="product-details-info">
                            <ul>
                                @if($book->author)
                                    <li>
                                        <strong>{{ __('books.author') }}:</strong>
                                        <span>{{ $book->author->name }}</span>
                                    </li>
                                @endif
                                @if($book->publisher)
                                    <li>
                                        <strong>{{ __('books.publisher') }}:</strong>
                                        <span>{{ $book->publisher->name }}</span>
                                    </li>
                                @endif
                                @if($book->bookCategory)
                                    <li>
                                        <strong>{{ __('books.category') }}:</strong>
                                        <span>{{ $book->bookCategory->name }}</span>
                                    </li>
                                @endif
                                @if($book->pages)
                                    <li>
                                        <strong>{{ __('books.pages') }}:</strong>
                                        <span>{{ $book->pages }}</span>
                                    </li>
                                @endif
                                @if($book->language)
                                    <li>
                                        <strong>{{ __('books.language') }}:</strong>
                                        <span>{{ $book->language }}</span>
                                    </li>
                                @endif
                                @if($book->published_year)
                                    <li>
                                        <strong>{{ __('books.published_year') }}:</strong>
                                        <span>{{ $book->published_year }}</span>
                                    </li>
                                @endif
                                @if($book->isbn)
                                    <li>
                                        <strong>{{ __('books.isbn') }}:</strong>
                                        <span>{{ $book->isbn }}</span>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        <div class="product-action">
                            <div class="product-single-qty">
                                <label>{{ __('blank_products.quantity') ?? 'Quantity' }}:</label>
                                <input type="number" id="quantity" class="form-control" value="1" min="1" max="100">
                            </div>
                            <button id="addToCartBtn" class="btn btn-primary btn-add-cart">{{ __('blank_products.add_to_cart') ?? 'Add to Cart' }}</button>
                        </div>
                    </div>
                </div>
            </div>

            @if($relatedBooks && $relatedBooks->count() > 0)
                <section class="section related-products-section">
                    <h2 class="section-title">{{ __('books.related_books') }}</h2>
                    <div class="products-slider owl-carousel owl-theme">
                        @foreach($relatedBooks as $relatedBook)
                            <div class="product-default">
                                <figure>
                                    <a href="{{ route('books.show', $relatedBook->slug) }}">
                                        @if($relatedBook->images && count($relatedBook->images) > 0)
                                            <img src="{{ asset('storage/app/public/' . $relatedBook->images[0]) }}" width="280" height="280"
                                                alt="{{ $relatedBook->name }}" />
                                        @else
                                            <img src="{{ asset('assets/images/products/product-1.jpg') }}" width="280"
                                                height="280" alt="{{ $relatedBook->name }}" />
                                        @endif
                                    </a>

                                    <div class="label-group">
                                        @if($relatedBook->is_featured)
                                            <div class="product-label label-hot">{{ __('books.featured') }}</div>
                                        @endif
                                    </div>
                                </figure>

                                <div class="product-details">
                                    <h3 class="product-title">
                                        <a href="{{ route('books.show', $relatedBook->slug) }}">{{ $relatedBook->name }}</a>
                                    </h3>
                                    <div class="price-box">
                                        <span class="product-price">{{ number_format($relatedBook->price, 2) }}</span>
                                    </div>
                                    <div class="product-action">
                                        <a href="{{ route('books.show', $relatedBook->slug) }}" class="btn-icon btn-add-cart">
                                            <i class="icon-shopping-cart"></i>
                                        </a>
                                        <a href="{{ route('books.show', $relatedBook->slug) }}" class="btn-icon btn-wishlist">
                                            <i class="icon-heart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </main>

    @push('scripts')
    <script>
        $(document).ready(function() {
            // Quantity validation
            $('#quantity').on('input change', function() {
                let qty = parseInt($(this).val());
                if (isNaN(qty) || qty < 1) $(this).val(1);
            });

            // Add to cart functionality
            $('#addToCartBtn').click(function(e) {
                e.preventDefault();

                const quantity = parseInt($('#quantity').val()) || 1;
                const data = {
                    quantity: quantity,
                    type: 'book'
                };

                // Show loading state
                const btn = $(this);
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Adding...');

                let url = "{{ route('cart.add', ':id') }}";
                url = url.replace(':id', {{ $book->id }});

                $.ajax({
                    url: url,
                    type: 'GET',
                    data: data,
                    success: function(response) {
                        btn.prop('disabled', false).html('Add to Cart');
                        if (typeof showToast === 'function') {
                            const message = response.message || (window.translations && window.translations.messages ? window.translations.messages.product_added_to_cart : 'Book added to cart successfully!');
                            showToast(message, "success");
                        }
                        if (response.cartCount !== undefined) {
                            $('.cart-count').text(response.cartCount);
                        }
                        if (typeof refreshCartDropdown === 'function') {
                            refreshCartDropdown();
                        }
                    },
                    error: function(xhr) {
                        btn.prop('disabled', false).html('Add to Cart');
                        if (xhr.status === 401 && xhr.responseJSON && xhr.responseJSON.redirect) {
                            if(typeof showToast === 'function') {
                                showToast(xhr.responseJSON.message, 'warning');
                            }
                            setTimeout(function() {
                                window.location.href = xhr.responseJSON.redirect;
                            }, 1500);
                            return;
                        }
                        if (typeof showToast === 'function') {
                            const message = window.translations && window.translations.messages ? window.translations.messages.error_adding_to_cart : 'Error adding book to cart.';
                            showToast(message, "error");
                        }
                    }
                });
            });

            $('.product-single-carousel').owlCarousel({
                items: 1,
                loop: false,
                margin: 0,
                nav: true,
                dots: false,
                navText: ['<i class="icon-angle-left"></i>', '<i class="icon-angle-right"></i>'],
                rtl: {{ app()->getLocale() == 'ar' ? 'true' : 'false' }}
            });

            $('.products-slider').owlCarousel({
                items: 4,
                loop: false,
                margin: 20,
                nav: true,
                dots: true,
                navText: ['<i class="icon-angle-left"></i>', '<i class="icon-angle-right"></i>'],
                responsive: {
                    0: { items: 1 },
                    576: { items: 2 },
                    768: { items: 3 },
                    992: { items: 4 }
                },
                rtl: {{ app()->getLocale() == 'ar' ? 'true' : 'false' }}
            });
        });
    </script>
    @endpush
@endsection
