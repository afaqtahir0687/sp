@extends('frontend.layouts.master')
@section('title', $product->name)
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($product->description), 160))
@section('meta_keywords', $product->name . ', ' . ($product->category ? $product->category->name . ', ' : '') . 'printing, customized products, Crelogics')
@section('content')
    <style>
        .breadcrumb-item, .breadcrumb-item a {
            text-transform: none !important;
        }
        /* Magnific Popup Fade Effect */
        .mfp-fade.mfp-bg {
            opacity: 0;
            -webkit-transition: all 0.15s ease-out;
            -moz-transition: all 0.15s ease-out;
            transition: all 0.15s ease-out;
        }
        .mfp-fade.mfp-bg.mfp-ready {
            opacity: 0.8;
        }
        .mfp-fade.mfp-bg.mfp-removing {
            opacity: 0;
        }
        .mfp-fade.mfp-wrap .mfp-content {
            opacity: 0;
            -webkit-transition: all 0.15s ease-out;
            -moz-transition: all 0.15s ease-out;
            transition: all 0.15s ease-out;
        }
        .mfp-fade.mfp-wrap.mfp-ready .mfp-content {
            opacity: 1;
        }
        .mfp-fade.mfp-wrap.mfp-removing .mfp-content {
            opacity: 0;
        }
        .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #007bff;
            border-color: #007bff;
        }
        .custom-control-input:checked ~ .custom-control-label::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3e%3c/svg%3e");
        }
              .toggle-box {
            padding: 0 !important;
            margin: 0 0 8px 0 !important;
        }

        .toggle-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: auto !important;
            padding: 6px !important;
            margin: 0 !important;
        }

        .toggle-header .custom-control {
            margin-bottom: 0 !important;
            min-height: auto !important;
            padding-top: 0 !important;
        }

        .custom-switch {
            padding-left: 2.25rem !important;
            margin-bottom: 0 !important;
        }

        .custom-control-label {
            margin-bottom: 0 !important;
        }

        #laminationOptions,
        #dieOptions {
        padding: 6px !important;
        }

        /* RTL Carousel Controls */
        [dir="rtl"] .carousel-control-prev {
            right: 20px;
            left: auto;
        }
        [dir="rtl"] .carousel-control-next {
            left: 20px;
            right: auto;
        }
        [dir="rtl"] .carousel-control-prev-icon {
            transform: scaleX(-1);
        }
        [dir="rtl"] .carousel-control-next-icon {
            transform: scaleX(-1);
        }
        .owl-carousel .owl-stage-outer,
        .owl-carousel .owl-stage,
        .owl-carousel .owl-item {
            direction: ltr;
        }

        /* RTL Owl Carousel Dots - Position on left side */
        [dir="rtl"] .owl-dots {
            direction: ltr;
            text-align: left !important;
            left: 0 !important;
            right: auto !important;
        }
        [dir="rtl"] .owl-nav {
            direction: ltr;
        }
        [dir="rtl"] .dots-top .owl-dots {
            left: 0 !important;
            right: auto !important;
        }

        /* Premium Right Box Text & Alignment Styling */
        .right-box {
            background: #fdfdfd;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
        }
        .right-box p {
            font-size: 14px;
            color: #495057;
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .right-box p strong {
            font-weight: 600;
            color: #212529;
        }
        .right-box #discount_deduction_row strong,
        .right-box #discount_deduction_row span {
            color: #0eb10e !important; /* Vibrant green discount */
        }
        .right-box .total-price {
            border-top: 1px dashed #dee2e6;
            margin-top: 15px;
            padding-top: 15px;
            font-size: 18px;
            color: #212529;
        }
        .right-box .total-price strong {
            font-size: 18px;
            font-weight: 700;
        }
        .right-box .total-price #finalPrice_display {
            font-size: 20px;
            font-weight: 800;
            color: #007bff; /* Accent color matching your theme */
        }
        .right-box .badge-discount-end {
            background-color: #fff5f5;
            color: #e53e3e;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            border: 1px solid #feb2b2;
            display: inline-block;
        }
        @keyframes blinker {
            50% { opacity: 0.3; }
        }
        .discount-timer-wrapper:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(229, 62, 62, 0.08) !important;
        }
    </style>
    <main class="main">
        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>

                    @if($product->subcategory)
                        @php
                            $path = $product->subcategory->getFullPath();
                            $cat = $path->first();
                            $sub = $path->last();
                        @endphp
                        <li class="breadcrumb-item"><a href="{{ route('category.show', $cat->slug) }}">{{ $cat->name }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('subcategory.show', [$cat->slug, $sub->slug]) }}">{{ $sub->name }}</a></li>
                    @elseif($product->category)
                        @foreach($product->category->getFullPath() as $cat)
                            <li class="breadcrumb-item"><a href="{{ route('category.show', $cat->slug) }}">{{ $cat->name }}</a></li>
                        @endforeach
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                </ol>
            </nav>

            <div class="product-single-container product-single-default">
                <div class="row">
                    <div class="col-lg-5 col-md-6 product-single-gallery">
                        <div class="product-slider-container">
                            <div class="label-group">
                                @if($product->is_new_arrival)
                                    <div class="product-label label-hot">{{ __('product.new') }}</div>
                                @endif
                                @php
                                    $hasActiveDiscount = false;
                                    if ($product->discount_price > 0) {
                                        if (is_null($product->discount_end_date) || \Carbon\Carbon::parse($product->discount_end_date)->isFuture() || \Carbon\Carbon::parse($product->discount_end_date)->isToday()) {
                                            $hasActiveDiscount = true;
                                        }
                                    }
                                @endphp
                                @if($hasActiveDiscount)
                                    @php
                                        $percentage = round(($product->discount_price / $product->price) * 100);
                                    @endphp
                                    @if($percentage > 0)
                                        <div class="product-label label-sale">{{ $percentage }}% {{ __('product.off_percent') }}</div>
                                    @endif
                                @endif
                            </div>

                           <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                @if($product->image)
                                    <div class="product-item">
                                        <img class="product-single-image"
                                             src="{{ url('storage/app/public/' . $product->image) }}"
                                             data-zoom-image="{{ url('storage/app/public/' . $product->image) }}"
                                             width="468"
                                             height="468"
                                             alt="{{ $product->name }}" />
                                    </div>
                                @endif

                                @if($product->images)
                                    @foreach($product->images as $image)
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
                        @if($product->image)
                            <div class="owl-dot">
                                <img src="{{ url('storage/app/public/' . $product->image) }}"
                                     width="110" height="110"
                                     alt="product-thumbnail" />
                            </div>
                        @endif

                        @if($product->images)
                            @foreach($product->images as $image)
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
                        <h1 class="product-title">{{ $product->name }}</h1>

                        <div class="product-sku">
                            <span>{{ __('product.sku') }}: </span>{{ $product->sku ?? 'N/A' }}
                        </div>

                        <div class="product-customization">
                            <h4 class="customization-title">{{ __('product.customize_your_product') }}</h4>

                            <form id="product-customization-form" action="{{ route('cart.add', $product->id) }}" method="GET">
                                @if($product->getLocalizedSide1Colors())
                                    <div class="form-group">
                                        <label for="side1Color">{{ __('product.side_1_color') }}</label>
                                        <select class="form-control" id="side1Color" name="side_1_color" required>
                                            @foreach($product->getLocalizedSide1Colors() as $option)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                @if($product->getLocalizedSizes())
                                    <div class="form-group">
                                        <label for="size">{{ __('product.size') }}</label>
                                        <div id="sizeWrapper">
                                            <select class="form-control" id="size" name="size" required>
                                                @foreach($product->getLocalizedSizes() as $option)
                                                    <option value="{{ $option }}">{{ $option }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mt-1 custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customSize">
                                            <label class="custom-control-label" for="customSize">{{ __('product.custom') }}</label>
                                        </div>
                                    </div>
                                @endif

                                @if($product->getLocalizedSidesOptions())
                                    <div class="form-group">
                                        <label for="sides">{{ __('product.sides') }}</label>
                                        <select class="form-control" id="sides" name="sides" required>
                                            @foreach($product->getLocalizedSidesOptions() as $option)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                @if($product->getLocalizedMaterials())
                                    <div class="form-group">
                                        <label for="material">{{ __('product.selected_material') }}</label>
                                        <div id="materialWrapper">
                                            <select class="form-control" id="material" name="material" required>
                                                @foreach($product->getLocalizedMaterials() as $option)
                                                    <option value="{{ $option }}">{{ $option }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mt-1 custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customMaterial">
                                            <label class="custom-control-label" for="customMaterial">{{ __('product.custom') }}</label>
                                        </div>
                                    </div>
                                @endif

                                @if($product->getLocalizedLaminationTypes())
                                    <div class="toggle-box" id="laminationBox">
                                        <div class="toggle-header" style="padding-bottom: 0; margin-bottom: 0;">
                                            <span class="toggle-label">{{ __('product.lamination') }}</span>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="laminationToggle" name="lamination">
                                                <label class="custom-control-label" for="laminationToggle"></label>
                                            </div>
                                        </div>
                                        <div id="laminationOptions" class="d-none">
                                            <label for="lamination_type">{{ __('product.lamination_type') }}</label>
                                            <select class="form-control" id="lamination_type" name="lamination_type">
                                                @foreach($product->getLocalizedLaminationTypes() as $option)
                                                    <option value="{{ $option }}">{{ $option }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                @if($product->getLocalizedDieCuttingOptions())
                                    <div class="toggle-box">
                                        <div class="toggle-header">
                                            <span class="toggle-label">{{ __('product.die_cutting') }} <span id="dieStatus" class="toggle-status">✓</span></span>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="dieToggle" name="die_cutting">
                                                <label class="custom-control-label" for="dieToggle"></label>
                                            </div>
                                        </div>
                                        <div id="dieOptions" class="d-none">
                                            <select class="form-control" id="die_cutting_type" name="die_cutting_type">
                                                @foreach($product->getLocalizedDieCuttingOptions() as $option)
                                                    <option value="{{ $option }}">{{ $option }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="productMemo">{{ __('product.product_memo') }}</label>
                                    <input type="text" class="form-control" id="productMemo" name="memo" placeholder="{{ __('product.enter_product_memo') }}">
                                </div>

                                @if($product->allow_round_corners)
                                    <!-- Round Corner Toggle -->
                                    <div class="toggle-box">
                                        <div class="toggle-header">
                                            <span class="toggle-label">
                                                {{ __('product.round_corners') }}
                                                <span id="roundStatus" class="toggle-status">✓</span>
                                            </span>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="roundToggle">
                                                <label class="custom-control-label" for="roundToggle"></label>
                                            </div>
                                        </div>

                                        <div id="roundOptions" class="d-none" style="padding: 6px;">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="option-box" data-corner="upper-left">
                                                        {{ __('product.upper_left') }}
                                                        <span class="check-icon">✓</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="option-box" data-corner="upper-right">
                                                        {{ __('product.upper_right') }}
                                                        <span class="check-icon">✓</span>
                                                    </div>
                                                </div>
                                                <div class="col-6 mt-2">
                                                    <div class="option-box" data-corner="lower-left">
                                                        {{ __('product.lower_left') }}
                                                        <span class="check-icon">✓</span>
                                                    </div>
                                                </div>
                                                <div class="col-6 mt-2">
                                                    <div class="option-box" data-corner="lower-right">
                                                        {{ __('product.lower_right') }}
                                                        <span class="check-icon">✓</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="toggle-box clickable-box" id="shareLinkBox">
                                    <div class="toggle-header">
                                        <strong>{{ __('product.share_a_link') }}</strong>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="shareLinkToggle">
                                            <label class="custom-control-label" for="shareLinkToggle"></label>
                                        </div>
                                    </div>
                                    <div id="shareLinkOptions" class="d-none" style="padding: 6px;">
                                        <input type="url" class="form-control" placeholder="https://example.com/design-link">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- End .product-single-details -->
                </div><!-- End .row -->
            </div><!-- End .product-single-container -->

            <div class="order-box">
                <div class="order-header">
                    <h5>{{ __('product.your_order_details') }}</h5>
                </div>
                <div class="order-content container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="left-box">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="label-title">{{ __('product.number_of_designs') }}</label>
                                        <input type="number" class="form-control" id="num_designs" value="1">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="label-title">{{ __('product.quantity_label') }}</label>
                                        <div id="quantityWrapper">
                                            <select class="form-control" id="quantityField">
                                                @if($product->quantities && count($product->quantities) > 0)
                                                    @foreach($product->quantities as $qty)
                                                        <option value="{{ $qty }}">{{ $qty }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="1">1</option>
                                                @endif
                                            </select>
                                        </div>
                                        @if($product->allow_custom_quantity && $product->quantities && count($product->quantities) > 0)
                                            <div class="mt-1 custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customQuantity">
                                                <label class="custom-control-label" for="customQuantity">{{ __('product.custom') }}</label>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="table-responsive mt-3">
                                    <table class="table table-order">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>{{ __('product.urgency') }}</th>
                                                <th>{{ __('product.price') }}</th>
                                                <th>{{ __('product.production') }}</th>
                                                <th>{{ __('product.delivery') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr data-urgency="regular">
                                                <td><input type="radio" name="urgency" value="regular" checked></td>
                                                <td>{{ __('product.regular') }}</td>
                                                <td id="price-regular">{{ format_price($product->price) }}</td>
                                                <td id="days-production-regular">{{ $product->production_days ?? 3 }} {{ __('product.days') }}</td>
                                                <td id="days-delivery-regular">{{ $product->delivery_days ?? 1 }} {{ __('product.day') }}</td>
                                            </tr>
                                            @if($product->flexible_rate)
                                                <tr data-urgency="flexible">
                                                    <td><input type="radio" name="urgency" value="flexible"></td>
                                                    <td>{{ __('product.flexible') }}</td>
                                                    <td id="price-flexible">{{ format_price($product->flexible_rate) }}</td>
                                                    <td id="days-production-flexible">{{ $product->flexible_production_days ?? 5 }} {{ __('product.days') }}</td>
                                                    <td id="days-delivery-flexible">{{ $product->delivery_days ?? 1 }} {{ __('product.day') }}</td>
                                                </tr>
                                            @endif
                                            @if($product->urgent_rate)
                                                <tr data-urgency="urgent">
                                                    <td><input type="radio" name="urgency" value="urgent"></td>
                                                    <td>{{ __('product.urgent') }}</td>
                                                    <td id="price-urgent">{{ format_price($product->urgent_rate) }}</td>
                                                    <td id="days-production-urgent">{{ $product->urgent_production_days ?? 1 }} {{ __('product.day') }}</td>
                                                    <td id="days-delivery-urgent">{{ $product->delivery_days ?? 1 }} {{ __('product.day') }}</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="right-box">
                                <p><strong>Before discount:</strong> <span class="float-right"><span id="subtotal_display">{{ format_price(0.00) }}</span></span></p>

                                <p id="discount_deduction_row" style="display: none;">
                                    <strong class="text-success">Total discount:</strong>
                                    <span class="float-right text-success font-weight-bold"><span id="discount_deduction_display"></span></span>
                                </p>
                                <p id="no_discount_row">
                                    <strong class="text-muted">Total discount:</strong>
                                    <span class="float-right text-muted">0</span>
                                </p>

                                <p><strong>Total tax (15.00%):</strong> <span class="float-right"><span id="tax_display">{{ format_price(0.00) }}</span></span></p>

                                <div id="discount_ends_row" class="discount-timer-wrapper mt-2 mb-2" style="display: none; background: #fff5f5; border: 1px solid #feb2b2; border-radius: 8px; padding: 12px; box-shadow: 0 4px 6px rgba(229, 62, 62, 0.05); transition: all 0.3s ease;">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <strong class="text-danger d-flex align-items-center" style="font-size: 13px; font-weight: 700; text-transform: none;">
                                            <i class="icon-clock mr-1" style="font-size: 15px; animation: pulse 1.5s infinite;"></i> Discount Ends In:
                                        </strong>
                                        <span class="badge-discount-end" style="font-size: 10px; font-weight: 700; background: #e53e3e; color: #fff; padding: 2px 6px; border-radius: 4px; border: none; text-transform: uppercase;">OFFER</span>
                                    </div>
                                    <div class="d-flex justify-content-between text-center mt-2" id="countdown_timer">
                                        <div class="countdown-unit" style="flex: 1; margin: 0 2px; padding: 6px; background: #fff; border-radius: 4px; border: 1px solid #fed7d7;">
                                            <span id="timer_days" style="font-size: 15px; font-weight: 800; color: #e53e3e; display: block; line-height: 1;">00</span>
                                            <small style="font-size: 9px; color: #718096; font-weight: 600; text-transform: uppercase;">Days</small>
                                        </div>
                                        <div class="countdown-unit" style="flex: 1; margin: 0 2px; padding: 6px; background: #fff; border-radius: 4px; border: 1px solid #fed7d7;">
                                            <span id="timer_hours" style="font-size: 15px; font-weight: 800; color: #e53e3e; display: block; line-height: 1;">00</span>
                                            <small style="font-size: 9px; color: #718096; font-weight: 600; text-transform: uppercase;">Hrs</small>
                                        </div>
                                        <div class="countdown-unit" style="flex: 1; margin: 0 2px; padding: 6px; background: #fff; border-radius: 4px; border: 1px solid #fed7d7;">
                                            <span id="timer_minutes" style="font-size: 15px; font-weight: 800; color: #e53e3e; display: block; line-height: 1;">00</span>
                                            <small style="font-size: 9px; color: #718096; font-weight: 600; text-transform: uppercase;">Mins</small>
                                        </div>
                                        <div class="countdown-unit" style="flex: 1; margin: 0 2px; padding: 6px; background: #fff; border-radius: 4px; border: 1px solid #fed7d7; min-width: 45px;">
                                            <span id="timer_seconds" style="font-size: 15px; font-weight: 800; color: #e53e3e; display: block; line-height: 1; animation: blinker 1s linear infinite;">00</span>
                                            <small style="font-size: 9px; color: #718096; font-weight: 600; text-transform: uppercase;">Secs</small>
                                        </div>
                                    </div>
                                    <input type="hidden" id="discount_end_timestamp" value="{{ ($hasActiveDiscount && $product->discount_end_date) ? \Carbon\Carbon::parse($product->discount_end_date)->endOfDay()->toIso8601String() : '' }}">
                                </div>

                                <p class="total-price"><strong>Price:</strong> <span class="float-right"><span id="finalPrice_display">{{ format_price(0.00) }}</span></span></p>
                                <button id="addToCartBtn" class="btn btn-primary btn-block btn-lg">{{ __('product.add_to_cart_button') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-single-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab">{{ __('product.description') }}</a>
                    </li>
                    @if($product->size_guide)
                        <li class="nav-item">
                            <a class="nav-link" id="product-tab-size" data-toggle="tab" href="#product-size-content" role="tab">{{ __('product.size_guide') }}</a>
                        </li>
                    @endif
                    @if($product->additional_info)
                        <li class="nav-item">
                            <a class="nav-link" id="product-tab-tags" data-toggle="tab" href="#product-tags-content" role="tab">{{ __('product.additional_information') }}</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" id="product-tab-details" data-toggle="tab" href="#product-details-content" role="tab">{{ __('product.all_information') }}</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel">
                        <div class="product-desc-content">{!! $product->description !!}</div>
                    </div>
                    @if($product->size_guide)
                        <div class="tab-pane fade" id="product-size-content" role="tabpanel">
                            <div class="product-size-content">{!! $product->size_guide !!}</div>
                        </div>
                    @endif
                    @if($product->additional_info)
                        <div class="tab-pane fade" id="product-tags-content" role="tabpanel">
                            <div class="product-tags-content">{!! $product->additional_info !!}</div>
                        </div>
                    @endif
                    <div class="tab-pane fade" id="product-details-content" role="tabpanel">
                        <div class="product-details-list pt-3 pl-2">
                            <div class="selection-summary-container">
                                <h4 class="text-primary font-weight-bold mb-3">Your Selection</h4>
                                <div class="row" id="selection-summary-content">
                                    <div class="col-12"><p class="text-muted italic">Configure your product above to see the summary here.</p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="products-section pt-0">
                <h2 class="section-title">{{ __('product.related_products') }}</h2>
                <div class="products-slider owl-carousel owl-theme dots-top dots-small">
                    @foreach($relatedProducts as $related)
                        <div class="product-default">
                            <figure>
                                <a href="{{ route('product.show', [$related->category->slug, $related->subcategory ? $related->subcategory->slug : 'no-sub', $related->slug]) }}">
                                    <img src="{{ url('storage/app/public/' . $related->image) }}"
                                         width="280" height="280"
                                         alt="{{ $related->name }}">

                                    @if($related->images && count($related->images) > 0)
                                        <img src="{{ url('storage/app/public/' . $related->images[0]) }}"
                                             width="280" height="280"
                                             alt="{{ $related->name }}">
                                    @endif
                                </a>
                            </figure>
                            <div class="product-details">
                                <h3 class="product-title"><a href="{{ route('product.show', [$related->category->slug, $related->subcategory ? $related->subcategory->slug : 'no-sub', $related->slug]) }}">{{ $related->name }}</a></h3>
                                <div class="price-box">
                                    <span class="product-price">{{ format_price($related->price) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @if(isset($portfolios) && count($portfolios) > 0)
            <div class="products-section pt-0">
                <h2 class="section-title">{{ __('product.our_portfolio_successful_projects') }}</h2>
                <div class="products-slider owl-carousel owl-theme dots-top dots-small">
                    @foreach($portfolios as $portfolio)
                        @if($portfolio->images && count($portfolio->images) > 0)
                            <div class="product-default" data-title="{{ $portfolio->title }}" data-description="{{ $portfolio->description }}">
                                <figure>
                                    <div class="portfolio-gallery-wrapper" data-portfolio-id="{{ $portfolio->id }}">
                                        @foreach($portfolio->images as $index => $img)
                                            <a href="javascript:void(0)" class="portfolio-popup-link {{ $index === 0 ? '' : 'd-none' }}" data-index="{{ $index }}" data-img="{{ url('storage/app/public/' . $img) }}" data-portfolio-id="{{ $portfolio->id }}">
                                                @if($index === 0)
                                                    <img src="{{ url('storage/app/public/' . $img) }}"
                                                         width="280" height="280"
                                                         alt="Portfolio Work">
                                                @endif
                                            </a>
                                        @endforeach
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <h3 class="product-title">{{ $portfolio->title }}</h3>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </main>

    <!-- Bootstrap Card Modal for Portfolio Gallery -->
    <div class="modal fade" id="imageCardModal" tabindex="-1" role="dialog" aria-labelledby="imageCardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="border-radius: 15px; border: none; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
                <div class="modal-header" style="border-bottom: 1px solid #f0f0f0; background: #fff; padding: 15px 25px;">
                    <h5 class="modal-title" id="imageCardModalLabel" style="font-weight: 600; font-size: 1.6rem; margin: 0; color: #333;">Portfolio Gallery</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding: 15px 25px; margin: -15px -25px -15px auto; outline: none;">
                        <span aria-hidden="true" style="font-size: 2.2rem; line-height: 1;">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 0; background: #000; text-align: center; position: relative;">
                    <div id="modalCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
                        <div class="carousel-inner" id="modalCarouselInner">
                            <!-- Images will be dynamically added here -->
                        </div>
                        <a class="carousel-control-prev" href="#modalCarousel" role="button" data-slide="prev" style="width: 50px; height: 50px; background: rgba(0,0,0,0.5); border-radius: 50%; top: 50%; transform: translateY(-50%); left: 20px;">
                            <span class="carousel-control-prev-icon" aria-hidden="true" style="width: 20px; height: 20px;"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#modalCarousel" role="button" data-slide="next" style="width: 50px; height: 50px; background: rgba(0,0,0,0.5); border-radius: 50%; top: 50%; transform: translateY(-50%); right: 20px;">
                            <span class="carousel-control-next-icon" aria-hidden="true" style="width: 20px; height: 20px;"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #f0f0f0; background: #fff; padding: 15px 25px; display: block;">
                    <h5 id="modalPortfolioTitle" style="margin: 0 0 10px 0; font-weight: 600; color: #333;"></h5>
                    <p id="modalPortfolioDescription" style="margin: 0; color: #666; font-size: 0.9rem;"></p>
                    <span id="imageCounter" style="color: #999; font-size: 0.8rem; display: block; margin-top: 10px;"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Card Modal for Product Gallery -->
    <div class="modal fade" id="productGalleryModal" tabindex="-1" role="dialog" aria-labelledby="productGalleryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 15px; border: none; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
                <div class="modal-header" style="border-bottom: 1px solid #f0f0f0; background: #fff; padding: 15px 25px;">
                    <h5 class="modal-title" id="productGalleryModalLabel" style="font-weight: 600; font-size: 1.6rem; margin: 0; color: #333;">{{ $product->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding: 15px 25px; margin: -15px -25px -15px auto; outline: none;">
                        <span aria-hidden="true" style="font-size: 2.2rem; line-height: 1;">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 0; background: #000; text-align: center; position: relative;">
                    <div id="productGalleryCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
                        <div class="carousel-inner" id="productGalleryCarouselInner">
                            @if($product->image)
                                <div class="carousel-item active">
                                     <img src="{{ url('storage/app/public/' . $product->image) }}" class="d-block w-100" alt="{{ $product->name }}" style="width: 100%; max-height: 550px; object-fit: contain; margin: auto; height: auto;">
                                </div>
                            @endif
                            @if($product->images)
                                @foreach($product->images as $image)
                                    <div class="carousel-item">
                                         <img src="{{ url('storage/app/public/' . $image) }}" class="d-block w-100" alt="product gallery" style="width: 100%; max-height: 550px; object-fit: contain; margin: auto; height: auto;">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <a class="carousel-control-prev" href="#productGalleryCarousel" role="button" data-slide="prev" style="width: 50px; height: 50px; background: rgba(0,0,0,0.5); border-radius: 50%; top: 50%; transform: translateY(-50%); left: 20px;">
                            <span class="carousel-control-prev-icon" aria-hidden="true" style="width: 20px; height: 20px;"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#productGalleryCarousel" role="button" data-slide="next" style="width: 50px; height: 50px; background: rgba(0,0,0,0.5); border-radius: 50%; top: 50%; transform: translateY(-50%); right: 20px;">
                            <span class="carousel-control-next-icon" aria-hidden="true" style="width: 20px; height: 20px;"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #f0f0f0; background: #fff; padding: 15px 25px; display: block;">
                    <span id="productImageCounter" style="color: #999; font-size: 0.8rem; display: block; margin-top: 10px;"></span>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Countdown Timer Logic
                function initCountdown() {
                    const endTimestampStr = $('#discount_end_timestamp').val();
                    if (!endTimestampStr) {
                        $('#discount_ends_row').hide();
                        return;
                    }

                    const endTime = new Date(endTimestampStr).getTime();
                    let timerInterval = null;

                    function updateTimer() {
                        const now = new Date().getTime();
                        const timeRemaining = endTime - now;

                        if (timeRemaining <= 0) {
                            $('#discount_ends_row').hide();
                            if (timerInterval) {
                                clearInterval(timerInterval);
                                timerInterval = null;
                            }
                            if (typeof discountRate !== 'undefined' && discountRate > 0) {
                                discountRate = 0;
                                if (typeof calculatePrice === 'function') {
                                    calculatePrice();
                                }
                            }
                            return;
                        }

                        const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

                        $('#timer_days').text(String(days).padStart(2, '0'));
                        $('#timer_hours').text(String(hours).padStart(2, '0'));
                        $('#timer_minutes').text(String(minutes).padStart(2, '0'));
                        $('#timer_seconds').text(String(seconds).padStart(2, '0'));
                    }

                    updateTimer();
                    const now = new Date().getTime();
                    if (endTime - now > 0) {
                        timerInterval = setInterval(updateTimer, 1000);
                    }
                }
                initCountdown();

                function updateSelectionsSummary() {
                    const selections = [];

                    // Side 1 Color
                    if ($('#side1Color').length) {
                        selections.push({ label: 'Side 1 Color', value: $('#side1Color').val() });
                    }
                    // Size
                    if ($('#size').length) {
                        selections.push({ label: 'Size', value: $('#size').val() });
                    }
                    // Sides
                    if ($('#sides').length) {
                        selections.push({ label: 'Sides', value: $('#sides').val() });
                    }
                    // Material
                    if ($('#material').length) {
                        selections.push({ label: 'Material', value: $('#material').val() });
                    }
                    // Lamination
                    if ($('#laminationToggle').length) {
                        const val = $('#laminationToggle').is(':checked') ? $('#lamination_type').val() : 'None';
                        selections.push({ label: 'Lamination', value: val });
                    }
                    // Die Cutting
                    if ($('#dieToggle').length) {
                        const val = $('#dieToggle').is(':checked') ? $('#die_cutting_type').val() : 'None';
                        selections.push({ label: 'Die Cutting', value: val });
                    }
                    // Memo
                    if ($('#productMemo').length && $('#productMemo').val()) {
                        selections.push({ label: 'Product Memo', value: $('#productMemo').val() });
                    }
                    // Round Corners
                    if ($('#roundToggle').length) {
                        if ($('#roundToggle').is(':checked')) {
                            let selectedCorners = [];
                            $('.option-box.active').each(function() {
                                selectedCorners.push($(this).text().trim().replace('✓', '').trim());
                            });
                            selections.push({ label: 'Round Corners', value: selectedCorners.length > 0 ? selectedCorners.join(', ') : 'None selected' });
                        } else {
                            selections.push({ label: 'Round Corners', value: 'None' });
                        }
                    }
                    // Designs
                    selections.push({ label: 'Number of Designs', value: $('#num_designs').val() });
                    // Quantity
                    selections.push({ label: 'Quantity', value: $('#quantityField').val() });
                    // Urgency
                    const urgency = $('input[name="urgency"]:checked').val();
                    selections.push({ label: 'Urgency', value: urgency ? urgency.charAt(0).toUpperCase() + urgency.slice(1) : 'Regular' });

                    // Generate HTML
                    let html = '';
                    selections.forEach(item => {
                        html += `
                            <div class="col-md-4 mb-3">
                                <h5 class="text-dark font-weight-bold mb-1">${item.label}</h5>
                                <p class="text-primary mb-0 font-weight-bold">${item.value}</p>
                            </div>
                        `;
                    });

                    $('#selection-summary-content').html(html);
                }

                function toggleSection(toggleId, optionIds, statusId = null) {
                    const toggle = document.getElementById(toggleId);
                    if(!toggle) return;

                    if (!Array.isArray(optionIds)) {
                        optionIds = [optionIds];
                    }

                    const status = statusId ? document.getElementById(statusId) : null;

                    function applyState() {
                        optionIds.forEach(id => {
                            const el = document.getElementById(id);
                            if (!el) return;

                            toggle.checked ? el.classList.remove('d-none') : el.classList.add('d-none');

                            if (!toggle.checked) {
                                el.querySelectorAll('.option-box').forEach(box => {
                                    box.classList.remove('active');
                                });
                            }
                        });

                        if (status) {
                            toggle.checked ? status.classList.add('active') : status.classList.remove('active');
                        }
                    }

                    toggle.addEventListener('change', applyState);
                    applyState();
                }

                toggleSection('laminationToggle', 'laminationOptions');
                toggleSection('dieToggle', 'dieOptions', 'dieStatus');
                toggleSection('roundToggle', 'roundOptions', 'roundStatus');
                $('#shareLinkToggle').change(function() { $('#shareLinkOptions').toggleClass('d-none', !this.checked); });

                $(document).on('click', '.option-box', function() {
                    $(this).toggleClass('active');
                    updateSelectionsSummary();
                });

                var defaultSizes = {!! json_encode($product->getLocalizedSizes() ?? []) !!};

                $('#customSize').change(function() {
                    if (this.checked) {
                        $('#sizeWrapper').html('<input type="text" id="size" name="size" class="form-control" placeholder="Enter custom size (e.g. 5x5)" required>');
                    } else {
                        var options = '';
                         if (defaultSizes.length > 0) {
                            $.each(defaultSizes, function(index, value) {
                                options += '<option value="'+value+'">'+value+'</option>';
                            });
                        }
                        $('#sizeWrapper').html('<select class="form-control" id="size" name="size" required>' + options + '</select>');
                    }
                    updateSelectionsSummary();
                    calculatePrice();
                });

                var defaultMaterials = {!! json_encode($product->getLocalizedMaterials() ?? []) !!};

                $('#customMaterial').change(function() {
                    if (this.checked) {
                        $('#materialWrapper').html('<input type="text" id="material" name="material" class="form-control" placeholder="Enter custom material" required>');
                    } else {
                        var options = '';
                        if (defaultMaterials.length > 0) {
                            $.each(defaultMaterials, function(index, value) {
                                options += '<option value="'+value+'">'+value+'</option>';
                            });
                        }
                        $('#materialWrapper').html('<select class="form-control" id="material" name="material" required>' + options + '</select>');
                    }
                    updateSelectionsSummary();
                    calculatePrice();
                });

                var defaultQuantities = {!! json_encode($product->quantities ?? []) !!};
                var minQty = defaultQuantities.length > 0 ? Math.min(...defaultQuantities) : 100;
                var maxQty = 5000;
 
                $('#customQuantity').change(function() {
                    if (this.checked) {
                        $('#quantityWrapper').html('<div>' +
                            '<input type="number" id="quantityField" class="form-control" value="' + minQty + '" min="' + minQty + '" max="' + maxQty + '">' +
                            '<div class="text-right mt-1">' +
                            '<small id="qtyError" class="font-weight-bold" style="color: #0eb10e !important; font-size: 11px;">Valid Range: (' + minQty + ' - ' + maxQty + ')</small>' +
                            '</div>' +
                            '</div>');
                    } else {
                        var options = '';
                         if (defaultQuantities.length > 0) {
                            $.each(defaultQuantities, function(index, value) {
                                options += '<option value="'+value+'">'+value+'</option>';
                            });
                        }
                        $('#quantityWrapper').html('<select class="form-control" id="quantityField">' + options + '</select>');
                        $('#addToCartBtn').prop('disabled', false);
                    }
                    calculatePrice();
                });
 
                $(document).on('input change', '#quantityField[type="number"]', function() {
                    let val = parseInt($(this).val()) || 0;
                    if (val > maxQty || val < minQty) {
                        $('#qtyError').attr('style', 'color: #dc3545 !important; font-size: 11px;');
                        $('#addToCartBtn').prop('disabled', true);
                    } else {
                        $('#qtyError').attr('style', 'color: #0eb10e !important; font-size: 11px;');
                        $('#addToCartBtn').prop('disabled', false);
                    }
                    calculatePrice();
                });

                @php
                    $currency = current_currency();
                    $rates = get_latest_currency_rates();
                    $symbols = ['USD' => '$', 'SAR' => 'SAR ', 'PKR' => 'Rs '];
                    $currentRate = $rates[$currency] ?? 1;
                    $currentSymbol = $symbols[$currency] ?? '$';
                    $hasActiveDiscount = false;
                    if ($product->discount_price > 0) {
                        if (is_null($product->discount_end_date) || \Carbon\Carbon::parse($product->discount_end_date)->isFuture() || \Carbon\Carbon::parse($product->discount_end_date)->isToday()) {
                            $hasActiveDiscount = true;
                        }
                    }
                @endphp
                const currentRate = {{ (float) $currentRate }};
                const currentSymbol = "{{ $currentSymbol }}";
                const baseRate = {{ (float) ($product->price ?? 0) }};
                let discountRate = {{ (float) ($hasActiveDiscount ? $product->discount_price : 0) }};
                const flexRate = {{ (float) ($product->flexible_rate ?? 0) }};
                const urgentRate = {{ (float) ($product->urgent_rate ?? 0) }};

                const baseProdDays = {
                    regular: {{ $product->production_days ?? 3 }},
                    flexible: {{ $product->flexible_production_days ?? 5 }},
                    urgent: {{ $product->urgent_production_days ?? 1 }}
                };
                const baseDeliveryDays = {{ $product->delivery_days ?? 1 }};

                function formatCurrency(amount) {
                    return currentSymbol + (amount * currentRate).toFixed(2);
                }

                function calculatePrice() {
                    let qty = parseInt($('#quantityField').val()) || 1;
                    let numDesigns = parseInt($('#num_designs').val()) || 1;
                    let urgency = $('input[name="urgency"]:checked').val() || 'regular';

                    // Price per unit: admin price = 1 unit ki qeemat
                    let regularPrice = qty * baseRate * numDesigns;
                    let flexiblePrice = qty * flexRate * numDesigns;
                    let urgentPrice = qty * urgentRate * numDesigns;

                    let discountAmount = discountRate > 0 ? qty * discountRate * numDesigns : 0;

                    let finalRegular = Math.max(0, regularPrice - discountAmount) * 1.15;
                    let finalFlexible = Math.max(0, flexiblePrice - discountAmount) * 1.15;
                    let finalUrgent = Math.max(0, urgentPrice - discountAmount) * 1.15;

                    let extraProdDays = 0;
                    let extraDeliveryDays = 0;

                    if (qty >= 1000) {
                        extraProdDays = Math.floor(qty / 1000);
                        extraDeliveryDays = Math.floor(qty / 2000);
                    }

                    let regProd = baseProdDays.regular + extraProdDays;
                    let flexProd = baseProdDays.flexible + extraProdDays;
                    let urgProd = baseProdDays.urgent + extraProdDays;

                    let delDays = baseDeliveryDays + extraDeliveryDays;

                    $('#price-regular').text(formatCurrency(finalRegular));
                    $('#days-production-regular').text(regProd + ' Days');
                    $('#days-delivery-regular').text(delDays + ' Day' + (delDays > 1 ? 's' : ''));

                    if (flexRate > 0) {
                         $('#price-flexible').text(formatCurrency(finalFlexible));
                         $('#days-production-flexible').text(flexProd + ' Days');
                         $('#days-delivery-flexible').text(delDays + ' Day' + (delDays > 1 ? 's' : ''));
                    }
                    if (urgentRate > 0) {
                         $('#price-urgent').text(formatCurrency(finalUrgent));
                         $('#days-production-urgent').text(urgProd + ' Days');
                         $('#days-delivery-urgent').text(delDays + ' Day' + (delDays > 1 ? 's' : ''));
                    }

                    let subtotal = 0;
                    if (urgency === 'regular') {
                        subtotal = regularPrice;
                    } else if (urgency === 'flexible') {
                        subtotal = flexiblePrice;
                    } else if (urgency === 'urgent') {
                        subtotal = urgentPrice;
                    }

                    let discounted_price = Math.max(0, subtotal - discountAmount);
                    if (discountAmount > 0) {
                        // Update and show discount deduction amount
                        $('#discount_deduction_display').text('-' + formatCurrency(discountAmount));
                        $('#discount_deduction_row').show();
                        if ($('#discount_end_timestamp').val()) {
                            $('#discount_ends_row').show();
                        } else {
                            $('#discount_ends_row').hide();
                        }
                        $('#no_discount_row').hide();
                    } else {
                        // Hide discount details and show default 0 discount
                        $('#discount_deduction_row').hide();
                        $('#discount_ends_row').hide();
                        $('#no_discount_row').show();
                    }

                    let tax = discounted_price * 0.15;
                    let total = discounted_price + tax;

                    $('#subtotal_display').text(formatCurrency(subtotal));
                    $('#tax_display').text(formatCurrency(tax));
                    $('#finalPrice_display').text(formatCurrency(total));
                }

                $(document).on('click', '#addToCartBtn', function(e) {
                    e.preventDefault();

                    // Collect form data
                    let formData = $('#product-customization-form').serialize();
                    let printQty = $('#quantityField').val();
                    let numDesigns = $('#num_designs').val();
                    let urgency = $('input[name="urgency"]:checked').val();

                    // Add required fields
                    formData += '&print_quantity=' + printQty + '&quantity=' + numDesigns + '&urgency=' + urgency;

                    let url = "{{ route('cart.add', ':id') }}";
                    url = url.replace(':id', {{ $product->id }});

                    $.ajax({
                        url: url,
                        type: 'GET',
                        data: formData,
                        success: function(response) {
                            if(typeof showToast === 'function') {
                                const message = response.message || (window.translations && window.translations.messages ? window.translations.messages.product_added_to_cart : 'Product added to cart successfully!');
                                showToast(message, "success");
                            }
                            if(response.cartCount) {
                                $('.cart-count').text(response.cartCount);
                            }
                            // Refresh cart dropdown
                            refreshCartDropdown();
                        },
                        error: function(xhr) {
                            if (xhr.status === 401 && xhr.responseJSON && xhr.responseJSON.redirect) {
                                if(typeof showToast === 'function') {
                                    showToast(xhr.responseJSON.message, 'warning');
                                }
                                setTimeout(function() {
                                    window.location.href = xhr.responseJSON.redirect;
                                }, 1500);
                                return;
                            }
                            if(typeof showToast === 'function') {
                                const message = window.translations && window.translations.messages ? window.translations.messages.error_adding_to_cart : 'Error adding product to cart.';
                                showToast(message, "error");
                            }
                        }
                    });
                });

                $(document).on('input change', '#quantityField, #num_designs, input[name="urgency"], #side1Color, #size, #sides, #material, #laminationToggle, #lamination_type, #dieToggle, #die_cutting_type, #productMemo, #roundToggle', function() {
                    calculatePrice();
                    updateSelectionsSummary();
                });

                calculatePrice();
                updateSelectionsSummary();

                // Initialize Product Gallery Zoom with RTL support
                var isRTL = $('html').attr('dir') === 'rtl';
                $('.product-single-carousel').owlCarousel({
                    items: 1,
                    loop: false,
                    margin: 0,
                    nav: true,
                    dots: true,
                    rtl: isRTL,
                    navText: ['<i class="icon-angle-left"></i>', '<i class="icon-angle-right"></i>'],
                    onInitialized: function() {
                        // Initialize zoom after carousel is ready
                        $('.product-single-image').each(function() {
                            var $img = $(this);
                            var zoomImage = $img.data('zoom-image');
                            if (zoomImage) {
                                $img.elevateZoom({
                                    zoomType: "inner",
                                    cursor: "crosshair",
                                    zoomWindowFadeIn: 500,
                                    zoomWindowFadeOut: 750,
                                    responsive: true
                                });
                            }
                        });
                    }
                });

                // Initialize Related Products Carousel with RTL support
                $('.products-slider').owlCarousel({
                    loop: false,
                    margin: 20,
                    nav: true,
                    dots: true,
                    rtl: isRTL,
                    navText: ['<i class="icon-angle-left"></i>', '<i class="icon-angle-right"></i>'],
                    responsive: {
                        0: { items: 1 },
                        480: { items: 2 },
                        768: { items: 3 },
                        992: { items: 4 }
                    }
                });

                // Initialize Portfolio Gallery Modal
                $('.portfolio-popup-link').on('click', function(e) {
                    e.preventDefault();
                    var $wrapper = $(this).closest('.portfolio-gallery-wrapper');
                    var portfolioId = $wrapper.data('portfolio-id');
                    var items = [];
                    var startIndex = $(this).data('index') || 0;
                    
                    // Get portfolio data from the closest portfolio item
                    var $portfolioItem = $wrapper.closest('.product-default');
                    var portfolioTitle = $portfolioItem.data('title') || 'Portfolio';
                    var portfolioDescription = $portfolioItem.data('description') || '';
                    
                    $wrapper.find('.portfolio-popup-link').each(function() {
                        items.push($(this).data('img'));
                    });
                    
                    var carouselInner = $('#modalCarouselInner');
                    carouselInner.empty();
                    
                    items.forEach(function(imgSrc, index) {
                        var activeClass = index === startIndex ? 'active' : '';
                        carouselInner.append(`
                            <div class="carousel-item ${activeClass}">
                                <img src="${imgSrc}" class="d-block w-100" style="max-height: 500px; object-fit: contain; margin: auto;" alt="Portfolio Image">
                            </div>
                        `);
                    });
                    
                    $('#modalPortfolioTitle').text(portfolioTitle);
                    $('#modalPortfolioDescription').text(portfolioDescription);
                    $('#imageCounter').text('Image ' + (startIndex + 1) + ' of ' + items.length);
                    
                    // Handle RTL carousel navigation
                    var isRTL = $('html').attr('dir') === 'rtl';
                    $('#modalCarousel').carousel({
                        interval: false,
                        wrap: true
                    });
                    
                    // In RTL mode, swap the prev/next button actions
                    if (isRTL) {
                        $('#modalCarousel').find('.carousel-control-prev').off('click').on('click', function(e) {
                            e.preventDefault();
                            $('#modalCarousel').carousel('next');
                        });
                        $('#modalCarousel').find('.carousel-control-next').off('click').on('click', function(e) {
                            e.preventDefault();
                            $('#modalCarousel').carousel('prev');
                        });
                    }
                    
                    $('#modalCarousel').on('slid.bs.carousel', function() {
                        var currentIndex = $('#modalCarousel .carousel-item.active').index();
                        $('#imageCounter').text('Image ' + (currentIndex + 1) + ' of ' + items.length);
                    });
                    
                    $('#imageCardModal').modal('show');
                });
            });
        </script>
    @endpush
@endsection

