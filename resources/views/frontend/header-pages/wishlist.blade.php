@extends('frontend.layouts.master')
@section('title', __('wishlist.title'))
@section('meta_description', __('wishlist.meta_description'))
@section('meta_keywords', __('wishlist.meta_keywords'))
@section('content')
    <style>
        /* ============================================================
        WISHLIST PAGE — PROFESSIONAL REDESIGN
        ============================================================ */

        .page-header {
            background: linear-gradient(135deg, #fdf6fa, #f3f9fc);
            padding: 45px 0 35px;
            margin-bottom: 10px;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 800;
            color: #333;
            margin-top: 12px;
        }

        .page-header .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
            font-size: 13px;
        }

        .page-header .breadcrumb-item a {
            color: #777;
            text-decoration: none;
        }

        .page-header .breadcrumb-item.active {
            color: #2596be;
            font-weight: 600;
        }

        .wishlist-title h2 {
            font-size: 20px;
            font-weight: 800;
            color: #333;
            padding: 0 0 15px !important;
            margin-top: 0 !important;
            border-bottom: 2px solid #f5f5f5;
        }

        /* ── Wishlist Table Card ─────────────────────────────────── */
        .wishlist-table-container {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            border: 1px solid #f0f0f0;
            margin-bottom: 40px;
        }

        .table-wishlist {
            margin-bottom: 0;
            width: 100%;
        }

        .table-wishlist thead th {
            background: #fafafa;
            border-bottom: 2px solid #f0f0f0;
            padding: 18px 15px;
            color: #333;
            text-transform: uppercase;
            font-size: 12.5px !important;
            letter-spacing: 0.5px;
        }

        .table-wishlist tbody tr.product-row {
            border-bottom: 1px solid #f2f2f2;
            transition: background 0.2s ease;
        }

        .table-wishlist tbody td {
            padding: 20px 15px;
            vertical-align: middle;
            border: none;
        }

        /* Product image */
        .table-wishlist .product-image-container {
            position: relative;
            display: inline-block;
            width: 90px;
            height: 90px;
        }

        .table-wishlist .product-image-container img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #eee;
        }

        .table-wishlist .wishlist-remove-btn {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 24px;
            height: 24px;
            background: #fff;
            color: #2596be;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            font-size: 13px;
            text-decoration: none;
            transition: all 0.25s ease;
            z-index: 2;
            cursor: pointer;
        }

        .table-wishlist .wishlist-remove-btn:hover {
            background: #2596be;
            color: #fff;
            transform: scale(1.12) rotate(90deg);
        }

        /* Product title */
        .table-wishlist .product-title {
            font-size: 15.5px;
            font-weight: 700;
            margin-bottom: 0;
        }

        .table-wishlist .product-title a {
            color: #333 !important;
            transition: color 0.2s;
        }

        .table-wishlist .product-title a:hover {
            color: #2596be !important;
        }

        /* Price */
        .table-wishlist .price-box {
            font-weight: 700;
            color: #2596be;
            font-size: 15px;
            white-space: nowrap;
        }

        /* Stock status badge */
        .table-wishlist .stock-status {
            display: inline-block;
            padding: 5px 14px;
            border-radius: 30px;
            font-size: 12.5px;
            font-weight: 700;
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }

        /* Actions */
        .table-wishlist .action {
            white-space: nowrap;
        }

        .table-wishlist .action .btn {
            border-radius: 8px !important;
            font-size: 13px;
            font-weight: 600;
            padding: 9px 16px;
            margin: 3px;
            transition: all 0.25s ease;
            border: none !important;
        }

        .table-wishlist .btn-secondary {
            background: #f2f2f2 !important;
            color: #555 !important;
        }

        .table-wishlist .btn-secondary:hover {
            background: #e5e5e5 !important;
            color: #333 !important;
        }

        .table-wishlist .btn-shop {
            background: linear-gradient(135deg, #2596be, #1a7a99) !important;
            color: #fff !important;
            box-shadow: 0 4px 10px rgba(37, 166, 217, 0.25);
        }

        .table-wishlist .btn-shop:hover {
            background: linear-gradient(135deg, #1a7a99, #e0961a) !important;
            box-shadow: 0 4px 12px rgba(242, 169, 34, 0.3);
            transform: translateY(-2px);
        }

        /* Empty wishlist state */
        .table-wishlist .product-row td[colspan] h4 {
            color: #999;
            font-weight: 600;
            margin-bottom: 15px;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .table-wishlist thead {
                display: none;
            }
            .table-wishlist tbody td {
                display: block;
                width: 100%;
                text-align: left !important;
                padding: 8px 15px;
            }
            .table-wishlist tbody tr.product-row {
                display: block;
                padding: 15px 0;
                border-bottom: 8px solid #f7f7f7;
            }
            .table-wishlist .action .btn {
                width: 100%;
                margin: 4px 0;
            }
        }
    </style>
    <main class="main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ __('wishlist.wishlist') }}
                            </li>
                        </ol>
                    </div>
                </nav>

                <h1>{{ __('wishlist.wishlist') }}</h1>
            </div>
        </div>

        <div class="container">
            <div class="wishlist-title">
                <h2 class="p-2 pt-5 mt-2">{{ __('wishlist.my_wishlist') }}</h2>
            </div>
            <div class="wishlist-table-container">
                <table class="table table-wishlist mb-0">
                    <thead>
                        <tr>
                            <th class="thumbnail-col"></th>
                            <th class="product-col" style="font-weight: bold; font-size: 15px;">{{ __('cart.product') }}</th>
                            <th class="price-col" style="font-weight: bold; font-size: 15px;">{{ __('wishlist.price') }}</th>
                            <th class="status-col" style="font-weight: bold; font-size: 15px;">{{ __('wishlist.stock_status') }}</th>
                            <th class="action-col" style="font-weight: bold; font-size: 15px;">{{ __('wishlist.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr class="product-row">
                                <td>
                                    <figure class="product-image-container">
                                        <a href="{{ route('product.show', [$product->category->slug, $product->subcategory->slug ?? 'no-sub', $product->slug]) }}" class="product-image">
                                            @if($product->image)
                                                <img src="{{ asset('storage/app/public/' . $product->image) }}" alt="{{ $product->name }}">
                                            @else
                                                <img src="{{ asset('assets/images/products/product-1.jpg') }}" alt="{{ $product->name }}">
                                            @endif
                                        </a>
                                        <a href="{{ route('wishlist.remove', [$product->id, 'product']) }}" class="btn-remove icon-cancel wishlist-remove-btn" title="Remove Product" data-type="product"></a>                                    </figure>
                                </td>
                                <td>
                                    <h5 class="product-title">
                                        <a href="{{ route('product.show', [$product->category->slug, $product->subcategory->slug ?? 'no-sub', $product->slug]) }}"
                                            style="color: #2596be">{{ $product->name }}</a>
                                    </h5>
                                </td>
                                 <td class="price-box">
                                    @php
                                        $hasActiveDiscount = false;
                                        if ($product->discount_price > 0) {
                                            if (is_null($product->discount_end_date) || \Carbon\Carbon::parse($product->discount_end_date)->isFuture() || \Carbon\Carbon::parse($product->discount_end_date)->isToday()) {
                                                $hasActiveDiscount = true;
                                            }
                                        }
                                    @endphp
                                    @if($hasActiveDiscount)
                                        <del class="old-price" style="font-size: 1.2rem; color: #a8a8a8; margin-right: 5px;">{{ format_price($product->price) }}</del>
                                        <span class="product-price" style="font-weight: 700; color: #000;">{{ format_price($product->price - $product->discount_price) }}</span>
                                    @else
                                        {{ format_price($product->price) }}
                                    @endif
                                </td>
                                <td>
                                    <span
                                        class="stock-status">{{ $product->status == 'active' ? __('wishlist.in_stock') : __('wishlist.out_of_stock') }}</span>
                                </td>
                                <td class="action">
                                    <a href="{{ route('product.show', [$product->category->slug, $product->subcategory->slug ?? 'no-sub', $product->slug]) }}"
                                        class="btn btn-secondary mt-1 mt-md-0" title="{{ __('wishlist.view_detail') }}">
                                        {{ __('wishlist.view_detail') }}
                                    </a>
                                    <a href="{{ route('cart.add', $product->id) }}"
                                        class="btn btn-dark btn-shop">
                                        {{ __('wishlist.add_to_cart') }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            @if($blankProducts->count() == 0)
                                <tr>
                                    <td colspan="5" class="text-center p-5">
                                        <h4 class="mb-3">{{ __('wishlist.wishlist_empty') }}</h4>
                                        <a href="{{ route('home') }}" class="btn btn-dark btn-shop">{{ __('cart.go_shopping') }}</a>
                                    </td>
                                </tr>
                            @endif
                        @endforelse
                        
                        @foreach($blankProducts as $blankProduct)
                            <tr class="product-row">
                                <td>
                                    <figure class="product-image-container">
                                        <a href="{{ route('blank-products.show', $blankProduct->slug) }}" class="product-image">
                                            @if($blankProduct->image)
                                                <img src="{{ asset('storage/app/public/' . $blankProduct->image) }}" alt="{{ $blankProduct->name }}">
                                            @else
                                                <img src="{{ asset('assets/images/products/product-1.jpg') }}" alt="{{ $blankProduct->name }}">
                                            @endif
                                        </a>
                                        <a href="{{ route('wishlist.remove', [$blankProduct->id, 'blank']) }}" class="btn-remove icon-cancel wishlist-remove-btn" title="Remove Product" data-type="blank"></a>                                    </figure>
                                </td>
                                <td>
                                    <h5 class="product-title">
                                        <a href="{{ route('blank-products.show', $blankProduct->slug) }}"
                                            style="color: #2596be">{{ $blankProduct->name }} (Blank Product)</a>
                                    </h5>
                                </td>
                               <td class="price-box">
                                    @if($blankProduct->discount_price && $blankProduct->discount_price < $blankProduct->price)
                                        <del class="old-price" style="font-size: 1.2rem; color: #a8a8a8; margin-right: 5px;">{{ format_price($blankProduct->price) }}</del>
                                        <span class="product-price" style="font-weight: 700; color: #000;">{{ format_price($blankProduct->discount_price) }}</span>
                                    @else
                                        {{ format_price($blankProduct->price) }}
                                    @endif
                                </td>
                                <td>
                                    <span
                                        class="stock-status">{{ $blankProduct->status == 'active' ? __('wishlist.in_stock') : __('wishlist.out_of_stock') }}</span>
                                </td>
                                <td class="action">
                                    <a href="{{ route('blank-products.show', $blankProduct->slug) }}"
                                        class="btn btn-secondary mt-1 mt-md-0" title="{{ __('wishlist.view_detail') }}">
                                        {{ __('wishlist.view_detail') }}
                                    </a>
                                    <a href="{{ route('blank-products.show', $blankProduct->slug) }}"
                                        class="btn btn-dark btn-shop">
                                        {{ __('home.select_options') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- End .cart-table-container -->
        </div><!-- End .container -->
    </main><!-- End .main -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.wishlist-remove-btn').forEach(function (btn) {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();

                    var url = this.getAttribute('href');
                    var row = this.closest('tr.product-row');

                    fetch(url, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (data) {
                        if (data.success) {
                            // Remove the row with a smooth fade-out
                            row.style.transition = 'opacity 0.3s ease';
                            row.style.opacity = '0';
                            setTimeout(function () {
                                row.remove();

                                // If no rows left, show "empty wishlist" message
                                var tbody = document.querySelector('.table-wishlist tbody');
                                if (tbody && tbody.querySelectorAll('tr.product-row').length === 0) {
                                    tbody.innerHTML = '<tr><td colspan="5" class="text-center p-5">' +
                                        '<h4 class="mb-3">{{ __("wishlist.wishlist_empty") }}</h4>' +
                                        '<a href="{{ route("home") }}" class="btn btn-dark btn-shop">{{ __("cart.go_shopping") }}</a>' +
                                        '</td></tr>';
                                }
                            }, 300);

                            // Update wishlist count badge in header (if it exists)
                            if (data.wishlistCount !== undefined) {
                                document.querySelectorAll('.wishlist-count').forEach(function (el) {
                                    el.textContent = data.wishlistCount;
                                });
                            }

                            if (typeof showToast === 'function') {
                                showToast(data.message, 'success');
                            }
                        } else {
                            if (typeof showToast === 'function') {
                                const message = data.message || (window.translations && window.translations.messages ? window.translations.messages.something_went_wrong : 'Something went wrong');
                                showToast(message, 'error');
                            }
                        }
                    })
                    .catch(function () {
                        if (typeof showToast === 'function') {
                            const message = window.translations && window.translations.messages ? window.translations.messages.something_went_wrong : 'Something went wrong. Please try again.';
                            showToast(message, 'error');
                        }
                    });
                });
            });
        });
        </script>
@endsection

