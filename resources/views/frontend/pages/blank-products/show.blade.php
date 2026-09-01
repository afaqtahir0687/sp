@extends('frontend.layouts.master')

@section('title', $blankProduct->name)
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($blankProduct->description), 160))
@section('meta_keywords', $blankProduct->name . ', blank products, products without print, merchandise')

@section('content')
    <style>
        .breadcrumb-item, .breadcrumb-item a {
            text-transform: none !important;
        }
        .product-variations {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .variation-item {
            position: relative;
        }
        .variation-label {
            display: inline-block;
            padding: 8px 20px;
            border: 2px solid #ddd;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
            background: #fff;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .variation-label:hover {
            border-color: #2596be;
            color: #2596be;
        }
        .variation-item input:checked + .variation-label {
            background: #2596be;
            color: #fff;
            border-color: #2596be;
        }
        /* Color swatch styles */
        .color-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border: 2px solid #ddd;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
            background: #fff;
            font-size: 14px;
            font-weight: 600;
        }
        .color-label:hover {
            border-color: #2596be;
            color: #2596be;
        }
        .variation-item input:checked + .color-label {
            border-color: #2596be;
            color: #2596be;
            box-shadow: 0 0 0 3px rgba(217,13,145,0.15);
        }
        .color-dot {
            display: inline-block;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            border: 1px solid rgba(0,0,0,0.2);
            flex-shrink: 0;
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
                    <li class="breadcrumb-item"><a href="{{ route('blank-products.index') }}">Blank Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $blankProduct->name }}</li>
                </ol>
            </nav>

            <div class="product-single-container product-single-default">
                <div class="row">
                    <div class="col-lg-5 col-md-6 product-single-gallery">
                        <div class="product-slider-container">
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

                           <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                @if($blankProduct->image)
                                    <div class="product-item">
                                        <img class="product-single-image"
                                             src="{{ url('storage/app/public/' . $blankProduct->image) }}"
                                             data-zoom-image="{{ url('storage/app/public/' . $blankProduct->image) }}"
                                             width="468"
                                             height="468"
                                             alt="{{ $blankProduct->name }}" />
                                    </div>
                                @endif

                                @if($blankProduct->images)
                                    @foreach($blankProduct->images as $image)
                                        <div class="product-item">
                                            <img class="product-single-image"
                                                 src="{{ url('storage/app/public/' . $image) }}"
                                                 data-zoom-image="{{ url('storage/app/public/' . $image) }}"
                                                 width="468"
                                                 height="468"
                                                 alt="product gallery" />
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <span class="prod-full-screen">
                                <i class="icon-plus"></i>
                            </span>
                        </div>

                        <div class="prod-thumbnail owl-dots">
                        @if($blankProduct->image)
                            <div class="owl-dot">
                                <img src="{{ url('storage/app/public/' . $blankProduct->image) }}"
                                     width="110" height="110"
                                     alt="product-thumbnail" />
                            </div>
                        @endif

                        @if($blankProduct->images)
                            @foreach($blankProduct->images as $image)
                                <div class="owl-dot">
                                    <img src="{{ url('storage/app/public/' . $image) }}"
                                         width="110" height="110"
                                         alt="product-thumbnail" />
                                </div>
                            @endforeach
                        @endif
                    </div>
                    </div><!-- End .product-single-gallery -->

                    <div class="col-lg-7 col-md-6 product-single-details">
                        <h1 class="product-title">{{ $blankProduct->name }}</h1>

                        <div class="product-sku">
                            <span>{{ __('blank_products.sku') }}: </span>{{ $blankProduct->sku ?? 'N/A' }}
                        </div>

                        <div class="product-price mb-3">
                            @if($blankProduct->discount_price)
                                <span class="product-price">{{ format_price($blankProduct->discount_price) }}</span>
                                <span class="old-price">{{ format_price($blankProduct->price) }}</span>
                            @else
                                <span class="product-price">{{ format_price($blankProduct->price) }}</span>
                            @endif
                        </div>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:0%"></span>
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                        </div>

                        @if($blankProduct->short_description)
                        <div class="product-short-description mb-3">
                            <p>{{ $blankProduct->short_description }}</p>
                        </div>
                        @endif

                        @if($blankProduct->sizes && count($blankProduct->sizes) > 0)
                        <div class="product-options mb-3">
                            <label class="font-weight-bold">{{ __('blank_products.select_size') }}: <span id="selectedSizeLabel" class="text-muted font-weight-normal"></span></label>
                            <div class="product-variations">
                                @foreach($blankProduct->sizes as $size)
                                    <div class="variation-item">
                                        <input type="radio" name="size" id="size_{{ $loop->index }}" value="{{ $size }}" class="d-none size-radio" @if($loop->first) checked @endif>
                                        <label for="size_{{ $loop->index }}" class="variation-label">{{ $size }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @if($blankProduct->colors && count($blankProduct->colors) > 0)
                        <div class="product-options mb-3">
                            <label class="font-weight-bold">{{ __('blank_products.select_color') }}: <span id="selectedColorLabel" class="text-muted font-weight-normal"></span></label>
                            <div class="product-variations">
                                @foreach($blankProduct->colors as $color)
                                    @php
                                        // Comprehensive color map for better color matching
                                        $colorMap = [
                                            'white' => '#ffffff', 'black' => '#1a1a1a', 'red' => '#e53e3e',
                                            'blue' => '#3182ce', 'green' => '#38a169', 'yellow' => '#d69e2e',
                                            'orange' => '#dd6b20', 'purple' => '#805ad5', 'pink' => '#d53f8c',
                                            'gray' => '#718096', 'grey' => '#718096', 'brown' => '#744210',
                                            'navy' => '#1a365d', 'maroon' => '#822727', 'teal' => '#2c7a7b',
                                            'beige' => '#d4a96a', 'cream' => '#fffff0', 'gold' => '#d4af37',
                                            'silver' => '#c0c0c0', 'khaki' => '#c3b091', 'cyan' => '#00bcd4',
                                            'magenta' => '#ff00ff', 'lime' => '#32cd32', 'olive' => '#808000',
                                            'indigo' => '#4b0082', 'violet' => '#ee82ee', 'turquoise' => '#40e0d0',
                                            'coral' => '#ff7f50', 'salmon' => '#fa8072', 'crimson' => '#dc143c',
                                            'lavender' => '#e6e6fa', 'plum' => '#dda0dd', 'azure' => '#007fff',
                                            'ivory' => '#fffff0', 'champagne' => '#f7e7ce', 'charcoal' => '#36454f',
                                            // Compound colors
                                            'navy blue' => '#1a365d', 'dark blue' => '#00008b', 'light blue' => '#add8e6',
                                            'sky blue' => '#87ceeb', 'royal blue' => '#4169e1', 'baby blue' => '#89cff0',
                                            'dark green' => '#006400', 'light green' => '#90ee90', 'forest green' => '#228b22',
                                            'sea green' => '#2e8b57', 'olive green' => '#6b8e23', 'lime green' => '#32cd32',
                                            'dark red' => '#8b0000', 'light red' => '#ff6347', 'rose red' => '#c21e56',
                                            'dark purple' => '#4b0082', 'light purple' => '#d8bfd8', 'lavender purple' => '#967bb6',
                                            'dark brown' => '#3e2723', 'light brown' => '#a1887f', 'coffee' => '#6f4e37',
                                            'dark gray' => '#404040', 'light gray' => '#d3d3d3', 'dark grey' => '#404040',
                                            'light grey' => '#d3d3d3', 'steel gray' => '#4682b4', 'slate gray' => '#708090',
                                            'dark orange' => '#ff8c00', 'light orange' => '#ffcc99', 'peach' => '#ffdab9',
                                            'dark yellow' => '#b8860b', 'light yellow' => '#ffffe0', 'golden' => '#ffd700',
                                            'dark pink' => '#c71585', 'light pink' => '#ffb6c1', 'hot pink' => '#ff69b4',
                                            'dark cyan' => '#008b8b', 'light cyan' => '#e0ffff', 'turquoise blue' => '#00ced1',
                                        ];
                                        
                                        $colorLower = strtolower(trim($color));
                                        $swatchColor = '#cccccc'; // Default gray
                                        
                                        // First try exact match
                                        if (isset($colorMap[$colorLower])) {
                                            $swatchColor = $colorMap[$colorLower];
                                        } else {
                                            // Try partial match - check if color name contains known color words
                                            foreach ($colorMap as $key => $hex) {
                                                if (strpos($colorLower, $key) !== false) {
                                                    $swatchColor = $hex;
                                                    break;
                                                }
                                            }
                                        }
                                    @endphp
                                    <div class="variation-item">
                                        <input type="radio" name="color" id="color_{{ $loop->index }}" value="{{ $color }}" class="d-none color-radio" @if($loop->first) checked @endif>
                                        <label for="color_{{ $loop->index }}" class="color-label">
                                            <span class="color-dot" style="background-color: {{ $swatchColor }};"></span>
                                            {{ $color }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <div class="product-stock mb-3">
                            @if($blankProduct->stock > 0)
                                <span class="text-success">{{ __('blank_products.in_stock') }}: {{ $blankProduct->stock }}</span>
                            @else
                                <span class="text-danger">{{ __('blank_products.out_of_stock') }}</span>
                            @endif
                        </div>

                        <div class="product-action">
                            <div class="product-single-qty">
                                <label>{{ __('blank_products.quantity') }}:</label>
                                <input type="number" id="quantity" class="form-control" value="1" min="1" max="{{ $blankProduct->stock }}">
                            </div>
                            <button id="addToCartBtn" class="btn btn-primary btn-add-cart">{{ __('blank_products.add_to_cart') }}</button>
                        </div>
                    </div><!-- End .product-single-details -->
                </div><!-- End .row -->
            </div><!-- End .product-single-container -->

            @push('scripts')
            <script>
                $(document).ready(function() {
                    const basePrice = {{ $blankProduct->discount_price ?? $blankProduct->price }};

                    // Update selected size/color label display
                    function updateSelectionLabels() {
                        const selectedSize = $('input[name="size"]:checked').val();
                        const selectedColor = $('input[name="color"]:checked').val();
                        if (selectedSize && $('#selectedSizeLabel').length) {
                            $('#selectedSizeLabel').text('— ' + selectedSize);
                        }
                        if (selectedColor && $('#selectedColorLabel').length) {
                            $('#selectedColorLabel').text('— ' + selectedColor);
                        }
                    }

                    // Init labels
                    updateSelectionLabels();

                    $('.size-radio, .color-radio').change(function() {
                        updateSelectionLabels();
                    });

                    // Quantity validation
                    $('#quantity').on('input change', function() {
                        let qty = parseInt($(this).val());
                        if (isNaN(qty) || qty < 1) $(this).val(1);
                        @if($blankProduct->stock > 0)
                        if (qty > {{ $blankProduct->stock }}) $(this).val({{ $blankProduct->stock }});
                        @endif
                    });

                    // Add to cart functionality
                    $('#addToCartBtn').click(function(e) {
                        e.preventDefault();

                        @if(!$blankProduct->sizes || count($blankProduct->sizes) === 0)
                            // no sizes required
                        @else
                            let selectedSize = $('input[name="size"]:checked').val();
                            if (!selectedSize) {
                                if (typeof showToast === 'function') {
                                    const message = window.translations && window.translations.messages ? window.translations.messages.please_select_size : 'Please select a size.';
                                    showToast(message, "error");
                                }
                                return;
                            }
                        @endif

                        @if(!$blankProduct->colors || count($blankProduct->colors) === 0)
                            // no colors required
                        @else
                            let selectedColor = $('input[name="color"]:checked').val();
                            if (!selectedColor) {
                                if (typeof showToast === 'function') {
                                    const message = window.translations && window.translations.messages ? window.translations.messages.please_select_color : 'Please select a color.';
                                    showToast(message, "error");
                                }
                                return;
                            }
                        @endif

                        const selectedSizeFinal = $('input[name="size"]:checked').val() || null;
                        const selectedColorFinal = $('input[name="color"]:checked').val() || null;
                        const quantity = parseInt($('#quantity').val()) || 1;

                        const data = {
                            quantity: quantity,
                            price: basePrice,
                            original_price: {{ $blankProduct->price }},
                            type: 'blank'
                        };

                        if (selectedSizeFinal) data.size = selectedSizeFinal;
                        if (selectedColorFinal) data.color = selectedColorFinal;

                        // Show loading state
                        const btn = $(this);
                        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Adding...');

                        let url = "{{ route('cart.add', ':id') }}";
                        url = url.replace(':id', {{ $blankProduct->id }});

                        $.ajax({
                            url: url,
                            type: 'GET',
                            data: data,
                            success: function(response) {
                                btn.prop('disabled', false).html('Add to Cart');
                                if (typeof showToast === 'function') {
                                    const message = response.message || (window.translations && window.translations.messages ? window.translations.messages.product_added_to_cart : 'Product added to cart successfully!');
                                    showToast(message, "success");
                                }
                                if (response.cartCount !== undefined) {
                                    $('.cart-count').text(response.cartCount);
                                }
                                // Refresh cart dropdown
                                refreshCartDropdown();
                            },
                            error: function(xhr) {
                                btn.prop('disabled', false).html('Add to Cart');
                                if (xhr.status === 401 && xhr.responseJSON && xhr.responseJSON.redirect) {
                                    window.location.href = xhr.responseJSON.redirect;
                                    return;
                                }
                                if (typeof showToast === 'function') {
                                    const message = window.translations && window.translations.messages ? window.translations.messages.error_adding_to_cart_try_again : 'Error adding product to cart. Please try again.';
                                    showToast(message, "error");
                                }
                            }
                        });
                    });
                });
            </script>
            @endpush

            <div class="product-single-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab">{{ __('blank_products.description') }}</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel">
                        <div class="product-desc-content">{!! $blankProduct->description !!}</div>
                    </div>
                </div>
            </div>

            <div class="products-section pt-0">
                <h2 class="section-title">{{ __('blank_products.related_products') }}</h2>
                <div class="products-slider owl-carousel owl-theme dots-top dots-small">
                    @foreach($relatedBlankProducts as $related)
                    <div class="product-default">
                        <figure>
                            <a href="{{ route('blank-products.show', $related->slug) }}">
                                <img src="{{ asset('storage/app/public/' . $related->image) }}"
                                     width="280" height="280"
                                     alt="{{ $related->name }}">
                                @if($related->images && count($related->images) > 0)
                                    <img src="{{ asset('storage/app/public' . $related->images[0]) }}"
                                         width="280" height="280"
                                         alt="{{ $related->name }}">
                                @endif
                            </a>
                            <div class="label-group">
                                @if($related->is_featured)
                                    <div class="product-label label-hot">HOT</div>
                                @endif
                                @if($related->is_new_arrival)
                                    <div class="product-label label-new">NEW</div>
                                @endif
                                @if($related->discount_price)
                                    @php
                                        $relatedPercentage = round((($related->price - $related->discount_price) / $related->price) * 100);
                                    @endphp
                                    <div class="product-label label-sale">{{ $relatedPercentage }}% off</div>
                                @endif
                            </div>
                        </figure>
                        <div class="product-details">
                            <h3 class="product-title"><a href="{{ route('blank-products.show', $related->slug) }}">{{ $related->name }}</a></h3>
                            <div class="price-box">
                                @if($related->discount_price)
                                    <del class="old-price">{{ format_price($related->price) }}</del>
                                @endif
                                <span class="product-price">{{ format_price($related->discount_price ?? $related->price) }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection

