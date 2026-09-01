@extends('frontend.layouts.master')
@section('title', __('cart.title'))
@section('meta_description', __('cart.meta_description'))
@section('meta_keywords', __('cart.meta_keywords'))
@section('content')
    @php
        $currency     = current_currency();
        $rates        = get_latest_currency_rates();
        $symbols      = ['USD' => '$', 'SAR' => 'SAR ', 'PKR' => 'Rs '];
        $currentRate  = $rates[$currency] ?? 1;
        $currentSymbol = $symbols[$currency] ?? '$';
    @endphp

    <style>
    /* ============================================================
       CART PAGE — PROFESSIONAL REDESIGN
       ============================================================ */

    .checkout-progress-bar {
        margin: 40px 0 35px;
        padding: 0;
        list-style: none;
    }
    .checkout-progress-bar li {
        position: relative;
        padding: 0 40px;
        font-size: 14px;
        font-weight: 600;
        color: #aaa;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .checkout-progress-bar li:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 47%;
        right: 9px;
        width: 20px;
        height: 2px;
        background: #e2e2e2;
    }
    .checkout-progress-bar li a {
        color: inherit;
        text-decoration: none;
    }
    
    .checkout-progress-bar li.active {
        color: #e91d8e;
    }
    .checkout-progress-bar li.disabled {
        color: #ccc;
    }

    /* ── RTL (Arabic) fix for checkout progress bar ─────────── */
    @if(app()->getLocale() == 'ar')
    /*
     * Porto theme: li:not(:first-child)::before  →  position: absolute; left: -1.6rem
     * In LTR this places the arrow to the LEFT of Checkout/Complete (between steps). ✓
     * In RTL the flex order is reversed: Complete | Checkout | Cart (right→left).
     * So "Checkout" faces Cart on its RIGHT, not left.
     * Fix: swap left → right so the arrow sits on the correct side, then flip the glyph.
     */
    .checkout-progress-bar li:not(:first-child)::before {
        left: auto;
        right: -1.6rem;                              /* move to the right side */
        -webkit-transform: translateY(-50%) scaleX(-1);  /* centre + flip ‹ */
        transform: translateY(-50%) scaleX(-1);
    }
    /* Custom 2px connector line: right edge → left edge */
    .checkout-progress-bar li:not(:last-child)::after {
        right: auto;
        left: 9px;
    }
    @endif

    /* ── Cart Table Card ─────────────────────────────────────── */
    .cart-table-container {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        border: 1px solid #f0f0f0;
    }

    .table-cart {
        margin-bottom: 0;
        width: 100%;
    }

    .table-cart thead th {
        background: #fafafa;
        border-bottom: 2px solid #f0f0f0;
        padding: 18px 15px;
        color: #333;
        text-transform: uppercase;
        font-size: 12.5px !important;
        letter-spacing: 0.5px;
    }

    .table-cart tbody tr.product-row {
        border-bottom: 1px solid #f2f2f2;
        transition: background 0.2s ease;
    }

    .table-cart tbody tr.product-row:hover {
        background: #fdf6fa;
    }

    .table-cart tbody td {
        padding: 20px 15px;
        vertical-align: middle;
        border: none;
    }

    /* Product image */
    .table-cart .product-image-container {
        position: relative;
        display: inline-block;
        width: 90px;
        height: 90px;
    }

    .table-cart .product-image-container img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #eee;
    }

    .table-cart .btn-remove {
        position: absolute;
        top: -8px;
        right: -8px;
        width: 24px;
        height: 24px;
        background: #fff;
        color: #e91d8e;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        font-size: 13px;
        text-decoration: none;
        transition: all 0.25s ease;
        z-index: 2;
    }

    .table-cart .btn-remove:hover {
        background: #e91d8e;
        color: #fff;
        transform: scale(1.12) rotate(90deg);
    }

    /* Product title / specs */
    .table-cart .product-title {
        font-size: 15.5px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .table-cart .product-title a {
        color: #333 !important;
        transition: color 0.2s;
    }

    .table-cart .product-title a:hover {
        color: #e91d8e !important;
    }

    .table-cart .product-specs {
        font-size: 12.5px;
        color: #777;
        line-height: 1.6;
    }

    .table-cart .product-specs span {
        color: #555 !important;
    }

    /* Price cell */
    .table-cart .item-unit-price {
        font-weight: 700;
        color: #25A6D9;
        font-size: 15px;
        white-space: nowrap;
    }

    /* Quantity input */
    .table-cart .product-single-qty {
        display: flex;
        justify-content: center;
    }

    .table-cart .cart-qty-input {
        width: 70px;
        text-align: center;
        border: 1.5px solid #e2e2e2;
        border-radius: 8px;
        padding: 8px 5px;
        font-weight: 600;
        font-size: 14px;
        transition: border-color 0.2s;
    }

    .table-cart .cart-qty-input:focus {
        border-color: #25A6D9;
        outline: none;
        box-shadow: 0 0 0 3px rgba(37, 166, 217, 0.12);
    }

    /* Subtotal per row */
    .table-cart .subtotal-price {
        font-weight: 800;
        font-size: 15.5px;
        color: #e91d8e;
        white-space: nowrap;
    }

    /* Empty cart state */
    .table-cart .product-row td[colspan] h4 {
        color: #999;
        font-weight: 600;
        margin-bottom: 15px;
    }

    /* ── Cart Summary Sidebar ────────────────────────────────── */
    .cart-summary {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        border: 1px solid #f0f0f0;
        padding: 30px 28px;
        position: sticky;
        top: 20px;
    }

    .cart-summary h3 {
        font-size: 19px;
        font-weight: 800;
        color: #333;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f5f5f5;
    }

    .table-totals {
        width: 100%;
        margin-bottom: 5px;
    }

    .table-totals tbody td,
    .table-totals tfoot td {
        padding: 12px 0;
        border: none;
        font-size: 14.5px;
        border-bottom: 1px dashed #eee;
    }

    .table-totals tbody td:first-child,
    .table-totals tfoot td:first-child {
        color: #666;
        font-weight: 500;
    }

    .table-totals tbody td:last-child,
    .table-totals tfoot td:last-child {
        text-align: right;
        font-weight: 700;
        color: #333;
    }

    .table-totals #discount-row td {
        color: #28a745 !important;
    }

    .table-totals tfoot td {
        border-bottom: none;
        border-top: 2px solid #f0f0f0;
        padding-top: 18px;
    }

    .table-totals tfoot td:first-child {
        font-size: 16px;
        font-weight: 700;
        color: #333;
    }

    .table-totals tfoot td strong {
        font-size: 20px;
        color: #e91d8e;
    }

    /* Checkout button */
    .checkout-methods {
        margin-top: 20px;
    }

    #btn-proceed-checkout {
        background: linear-gradient(135deg, #25A6D9, #1d8ab8) !important;
        border: none !important;
        padding: 15px !important;
        font-weight: 700;
        font-size: 15px;
        letter-spacing: 0.5px;
        border-radius: 10px !important;
        box-shadow: 0 6px 16px rgba(37, 166, 217, 0.3);
        transition: all 0.25s ease;
    }

    #btn-proceed-checkout:hover {
        background: linear-gradient(135deg, #F2A922, #e0961a) !important;
        box-shadow: 0 6px 18px rgba(242, 169, 34, 0.35);
        transform: translateY(-2px);
    }

    .payment-methods {
        margin-top: 18px !important;
    }

    .payment-icon-box {
        background: #fafafa;
        transition: all 0.2s;
    }

    .payment-icon-box:hover {
        background: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    /* Responsive */
    @media (max-width: 991px) {
        .cart-summary {
            margin-top: 25px;
            position: static;
        }
        .table-cart thead {
            display: none;
        }
        .table-cart tbody td {
            display: block;
            width: 100%;
            text-align: left !important;
            padding: 8px 15px;
        }
        .table-cart tbody tr.product-row {
            display: block;
            padding: 15px 0;
            border-bottom: 8px solid #f7f7f7;
        }
    }
</style>
    <main class="main">
        <div class="container">
            <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                <li class="active">
                    <a href="{{ route('cart.index') }}">{{ __('cart.shopping_cart') }}</a>
                </li>
                <li>
                    <a href="{{ route('checkout.index') }}">{{ __('cart.checkout') }}</a>
                </li>
                <li class="disabled">
                    <a href="{{ route('order.complete') }}">{{ __('cart.order_complete') }}</a>
                </li>
            </ul>

            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-table-container">
                        <table class="table table-cart">
                            <thead>
                                <tr>
                                    <th class="thumbnail-col"></th>
                                    <th class="product-col" style="font-weight: bold; font-size: 15px;">{{ __('cart.product') }}</th>
                                    <th class="price-col" style="font-weight: bold; font-size: 15px;">{{ __('cart.price_design') }}</th>
                                    <th class="qty-col" style="font-weight: bold; font-size: 15px;">{{ __('cart.number_of_designs') }}</th>
                                    <th class="text-right" style="font-weight: bold; font-size: 15px;">{{ __('cart.subtotal') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(session('cart') && count(session('cart')) > 0)
                                    @foreach(session('cart') as $id => $details)
                                        @php
                                            $isBlankProduct = isset($details['type']) && $details['type'] === 'blank';
                                            $isBookProduct = isset($details['type']) && $details['type'] === 'book';
                                            $unitPrice     = $details['price'];
                                            $origPrice     = $details['original_price'] ?? $unitPrice;
                                            $qty           = $details['quantity'];
                                        @endphp
                                        <tr class="product-row" data-cart-id="{{ $id }}">
                                            <td>
                                                <figure class="product-image-container">
                                                    @if($isBookProduct)
                                                        <a href="{{ route('books.show', $details['slug']) }}" class="product-image">
                                                    @elseif($isBlankProduct)
                                                        <a href="{{ route('blank-products.show', $details['slug']) }}" class="product-image">
                                                    @else
                                                        <a href="{{ route('product.show', [$details['category_slug'] ?? 'uncategorized', $details['subcategory_slug'] ?? 'no-sub', $details['slug']]) }}" class="product-image">
                                                    @endif
                                                        @if($details['image'])
                                                            <img src="{{ asset('storage/app/public/' . $details['image']) }}" alt="product"
                                                                width="80" height="80">
                                                        @else
                                                            <img src="{{ asset('assets/images/products/product-1.jpg') }}" alt="product"
                                                                width="80" height="80">
                                                        @endif
                                                    </a>
                                                    <a href="{{ route('cart.remove', $id) }}" class="btn-remove icon-cancel" title="Remove Product" data-cart-id="{{ $id }}"></a>                                                </figure>
                                            </td>
                                            <td class="product-col">
                                                <h5 class="product-title">
                                                    @if($isBookProduct)
                                                        <a href="{{ route('books.show', $details['slug']) }}" style="color: #e91d8e">
                                                            {{ app()->getLocale() === 'ar' && isset($details['name_ar']) ? $details['name_ar'] : ($details['name'] ?? '') }}
                                                        </a>
                                                    @elseif($isBlankProduct)
                                                        <a href="{{ route('blank-products.show', $details['slug']) }}" style="color: #e91d8e">
                                                            {{ app()->getLocale() === 'ar' && isset($details['name_ar']) ? $details['name_ar'] : ($details['name'] ?? '') }} {{ __('cart.blank_product') }}
                                                        </a>
                                                    @else
                                                        <a href="{{ route('product.show', [$details['category_slug'] ?? 'uncategorized', $details['subcategory_slug'] ?? 'no-sub', $details['slug']]) }}" style="color: #e91d8e">
                                                            {{ app()->getLocale() === 'ar' && isset($details['name_ar']) ? $details['name_ar'] : ($details['name'] ?? '') }}
                                                        </a>
                                                    @endif
                                                </h5>
                                                @if($isBookProduct)
                                                    @if(isset($details['options']['author']))
                                                        <div class="product-specs mt-1">
                                                            <span style="font-weight: 600; color: #555;">Author: {{ $details['options']['author'] }}</span>
                                                        </div>
                                                    @endif
                                                    @if(isset($details['options']['publisher']))
                                                        <div class="product-specs">
                                                            <span style="font-weight: 600; color: #555;">Publisher: {{ $details['options']['publisher'] }}</span>
                                                        </div>
                                                    @endif
                                                @elseif($isBlankProduct)
                                                    @if(isset($details['options']['size']))
                                                        <div class="product-specs mt-1">
                                                            <span style="font-weight: 600; color: #555;">{{ __('cart.size') }} {{ $details['options']['size'] }}</span>
                                                        </div>
                                                    @endif
                                                    @if(isset($details['options']['color']))
                                                        <div class="product-specs">
                                                            <span style="font-weight: 600; color: #555;">{{ __('cart.color') }} {{ $details['options']['color'] }}</span>
                                                        </div>
                                                    @endif
                                                @else
                                                    @if(isset($details['options']['print_quantity']))
                                                        <div class="product-specs mt-1">
                                                            <span style="font-weight: 600; color: #555;">{{ __('cart.print_quantity') }} {{ $details['options']['print_quantity'] }}</span>
                                                        </div>
                                                    @endif
                                                    @if(isset($details['options']['urgency']))
                                                        <div class="product-specs">
                                                            <span style="font-weight: 600; color: #555;">{{ __('cart.urgency') }} {{ __('cart.urgency_' . $details['options']['urgency']) }}</span>
                                                            @if(isset($details['options']['production_days']))
                                                                <br><span style="font-size: 13px; color: #777;">{{ __('cart.production') }} {{ $details['options']['production_days'] }} {{ __('cart.days') }}</span>
                                                            @endif
                                                            @if(isset($details['options']['delivery_days']))
                                                                <span style="font-size: 13px; color: #777;"> | {{ __('cart.delivery') }} {{ $details['options']['delivery_days'] }} {{ __('cart.day_s') }}</span>
                                                            @endif
                                                        </div>
                                                    @endif
                                                    
                                                    {{-- Display Custom Options (like size, color, etc) --}}
                                                    @if(isset($details['options']) && is_array($details['options']))
                                                        @foreach($details['options'] as $key => $value)
                                                            @if(!in_array($key, ['print_quantity', 'urgency', 'production_days', 'delivery_days']) && !is_null($value) && $value !== '')
                                                                <div class="product-specs">
                                                                    <span style="font-weight: 600; color: #555; text-transform: capitalize;">{{ str_replace('_', ' ', $key) }}:</span>
                                                                    <span style="color: #777;">{{ is_array($value) ? implode(', ', $value) : $value }}</span>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </td>
                                            {{-- Price per item --}}
                                            <td class="item-unit-price"
                                                data-price="{{ $unitPrice }}"
                                                data-orig-price="{{ $origPrice }}">
                                                {{ format_price($unitPrice) }}
                                            </td>
                                            {{-- Editable quantity input --}}
                                            <td>
                                                <div class="product-single-qty">
                                                    <input class="horizontal-quantity form-control cart-qty-input"
                                                           type="number"
                                                           min="1"
                                                           value="{{ $qty }}"
                                                           data-cart-id="{{ $id }}"
                                                           data-price="{{ $unitPrice }}"
                                                           data-orig-price="{{ $origPrice }}">
                                                </div>
                                                <small class="text-muted d-block text-center mt-1">{{ $isBlankProduct ? __('cart.qty') : __('cart.designs') }}</small>
                                            </td>
                                            {{-- Row subtotal (updates live) --}}
                                            <td class="text-right">
                                                <span class="subtotal-price">{{ format_price($unitPrice * $qty) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="product-row">
                                        <td colspan="5" class="text-center p-5">
                                            <h4>{{ __('cart.cart_empty') }}</h4>
                                            <a href="{{ route('home') }}" class="btn btn-primary mt-2">{{ __('cart.go_shopping') }}</a>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>

                            <!-- <tfoot>
                                <tr>
                                    <td colspan="5" class="clearfix">
                                        <div class="float-left">
                                            <div class="cart-discount">
                                                <form action="#" onsubmit="return false;">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="{{ __('cart.coupon_code') }}" required>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-sm" type="submit">{{ __('cart.apply_coupon') }}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="float-right">
                                            <button type="button" id="btn-update-cart" class="btn btn-shop btn-update-cart">
                                                {{ __('cart.update_cart') }}
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot> -->
                        </table>
                    </div><!-- End .cart-table-container -->
                </div><!-- End .col-lg-8 -->
                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h3>{{ __('cart.cart_totals') }}</h3>

                        <table class="table table-totals">
                            <tbody>
                                @php
                                    $subtotal       = 0;
                                    $total_discount = 0;
                                @endphp
                                @foreach((array) session('cart') as $id => $details)
                                    @php
                                        $item_original_total = ($details['original_price'] ?? $details['price']) * $details['quantity'];
                                        $item_selling_total  = $details['price'] * $details['quantity'];

                                        $subtotal       += $item_original_total;
                                        $total_discount += ($item_original_total - $item_selling_total);
                                    @endphp
                                @endforeach

                                @php
                                    $after_discount = $subtotal - $total_discount;
                                    $tax            = $after_discount * 0.15;
                                    $grand_total    = $after_discount + $tax;
                                @endphp

                                <tr>
                                    <td>{{ __('cart.subtotal_price') }}</td>
                                    <td id="cart-subtotal">{{ format_price($subtotal) }}</td>
                                </tr>

                                <tr class="text-danger" id="discount-row" style="{{ $total_discount > 0 ? '' : 'display:none;' }}">
                                    <td>{{ __('cart.discount') }}</td>
                                    <td id="cart-discount">-{{ format_price($total_discount) }}</td>
                                </tr>

                                <tr>
                                    <td>{{ __('cart.tax_vat') }}</td>
                                    <td id="cart-tax">{{ format_price($tax) }}</td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td>{{ __('cart.order_total') }}</td>
                                    <td><strong id="cart-grand-total">{{ format_price($grand_total) }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="checkout-methods">
                            <button type="button" id="btn-proceed-checkout"
                                    data-checkout-url="{{ route('checkout.index') }}"
                                    class="btn btn-block btn-dark">
                                {{ __('cart.proceed_checkout') }}
                                <i class="fa fa-arrow-right"></i>
                            </button>
                            <div class="payment-methods d-flex justify-content-center mt-3">
                                <div class="payment-icon-box border rounded mx-1 d-flex align-items-center justify-content-center" style="width: 24%; height: 42px;">
                                    <img src="{{ asset('assets/images/payments/payment-visa.png') }}" alt="Visa" style="max-width: 100%; max-height: 100%;">
                                </div>
                                <div class="payment-icon-box border rounded mx-1 d-flex align-items-center justify-content-center" style="width: 24%; height: 42px;">
                                    <img src="{{ asset('assets/images/payments/payment-mastercard.png') }}" alt="Mastercard" style="max-width: 100%; max-height: 100%;">
                                </div>
                                <div class="payment-icon-box border rounded mx-1 d-flex align-items-center justify-content-center" style="width: 24%; height: 42px;">
                                    <img src="{{ asset('assets/images/payments/payment-mada.png') }}" alt="Mada" style="max-width: 100%; max-height: 100%;">
                                </div>
                                <div class="payment-icon-box border rounded mx-1 d-flex align-items-center justify-content-center" style="width: 24%; height: 42px;">
                                    <img src="{{ asset('assets/images/payments/payment-applepay.png') }}" alt="Apple Pay" style="max-width: 100%; max-height: 100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-6"></div><!-- margin -->
    </main><!-- End .main -->

    @push('scripts')
    <script>
        $(document).ready(function () {

            /* ─── currency helpers ─────────────────────────────────────── */
            const rate   = {{ $currentRate }};
            const symbol = "{{ $currentSymbol }}";

            function fmt(rawAmount) {
                // rawAmount is already in base USD; convert + format
                return symbol + (rawAmount * rate).toFixed(2);
            }

            /* ─── recalculate totals from all rows ─────────────────────── */
            function recalcTotals() {
                let subtotal      = 0;
                let totalDiscount = 0;

                $('.cart-qty-input').each(function () {
                    const qty       = Math.max(1, parseInt($(this).val()) || 1);
                    const price     = parseFloat($(this).data('price'));
                    const origPrice = parseFloat($(this).data('orig-price'));

                    const rowOrigTotal    = origPrice * qty;
                    const rowSellingTotal = price * qty;

                    subtotal      += rowOrigTotal;
                    totalDiscount += (rowOrigTotal - rowSellingTotal);

                    // update this row's subtotal cell
                    $(this).closest('tr').find('.subtotal-price').text(fmt(rowSellingTotal));
                });

                const afterDiscount = subtotal - totalDiscount;
                const tax           = afterDiscount * 0.15;
                const grandTotal    = afterDiscount + tax;

                $('#cart-subtotal').text(fmt(subtotal));
                $('#cart-tax').text(fmt(tax));
                $('#cart-grand-total').text(fmt(grandTotal));

                if (totalDiscount > 0) {
                    $('#cart-discount').text('-' + fmt(totalDiscount));
                    $('#discount-row').show();
                } else {
                    $('#discount-row').hide();
                }
            }

            /* ─── live update on quantity change ──────────────────────── */
            $(document).on('input change', '.cart-qty-input', function () {
                let val = parseInt($(this).val());
                if (isNaN(val) || val < 1) {
                    $(this).val(1);
                }
                recalcTotals();
            });

            /* ─── Remove item from cart (AJAX, no page reload) ─────────── */
            /* ─── collect all current qty inputs into an updates object ── */
            function collectUpdates() {
                const updates = {};
                $('.cart-qty-input').each(function () {
                    const id  = $(this).data('cart-id');
                    const qty = Math.max(1, parseInt($(this).val()) || 1);
                    updates[id] = qty;
                });
                return updates;
            }

            /* ─── AJAX save to session ─────────────────────────────────── */
            function saveCartToSession(updates) {
                return $.ajax({
                    url  : "{{ route('cart.update') }}",
                    type : 'PATCH',
                    data : {
                        _token  : "{{ csrf_token() }}",
                        updates : updates
                    }
                });
            }

            /* ─── "Update Cart" button ─────────────────────────────────── */
            $('#btn-update-cart').on('click', function () {
                const btn = $(this);
                btn.prop('disabled', true).text('{{ __('cart.updating') }}');

                saveCartToSession(collectUpdates())
                    .done(function () {
                        btn.prop('disabled', false).text('{{ __('cart.update_cart') }}');
                        if (typeof showToast === 'function') {
                            showToast('{{ __('cart.cart_updated_success') }}', 'success');
                        }
                    })
                    .fail(function () {
                        btn.prop('disabled', false).text('{{ __('cart.update_cart') }}');
                        if (typeof showToast === 'function') {
                            showToast('{{ __('cart.cart_update_failed') }}', 'error');
                        }
                    });
            });

            /* ─── "Proceed to Checkout" — save first, then redirect ─────── */
            $('#btn-proceed-checkout').on('click', function () {
                const btn         = $(this);
                const checkoutUrl = btn.data('checkout-url');

                if ($('.cart-qty-input').length === 0) {
                    window.location.href = checkoutUrl;
                    return;
                }

                btn.prop('disabled', true).html('{{ __('cart.saving') }} <i class="fa fa-spinner fa-spin"></i>');

                saveCartToSession(collectUpdates())
                    .always(function () {
                
                        window.location.href = checkoutUrl;
                    });
            });

            recalcTotals();
        });
    </script>
    @endpush
@endsection

