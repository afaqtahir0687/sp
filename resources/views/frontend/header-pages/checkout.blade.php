@extends('frontend.layouts.master')
@section('title', __('checkout.title'))
@section('meta_description', __('checkout.meta_description'))
@section('meta_keywords', __('checkout.meta_keywords'))
@section('content')
    <main class="main">
        <div class="container">
            <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                <li>
                    <a href="{{ route('cart.index') }}">{{ __('cart.shopping_cart') }}</a>
                </li>
                <li class="active">
                    <a href="{{ route('checkout.index') }}">{{ __('cart.checkout') }}</a>
                </li>
                <li class="disabled">
                    <a href="#">{{ __('cart.order_complete') }}</a>
                </li>
            </ul>

            <form action="{{ route('order.store') }}" method="POST" id="checkout-form">
                @csrf
                <input type="hidden" name="payment_method" id="payment_method" value="cod">

                <div class="row">
                    <div class="col-lg-7">
                        <ul class="checkout-steps">
                            <li>
                                <h2 class="step-title">{{ __('checkout.billing_details') }}</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('checkout.first_name') }} <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="first_name" value="{{ $user->first_name ?? '' }}" required />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('checkout.last_name') }} <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="last_name" value="{{ $user->last_name ?? '' }}" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('checkout.company_name') }} ({{ __('checkout.optional') }})</label>
                                    <input type="text" class="form-control" name="company_name" value="{{ $user->company_name ?? '' }}">
                                </div>

                                <div class="select-custom">
                                    <label>{{ __('checkout.country_region') }} <span class="required">*</span></label>
                                    <select name="country" id="country" class="form-control" required>
                                        <option value="">{{ __('checkout.select_country') }}</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ (isset($user) && $user->country == $country->id) ? 'selected' : '' }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="select-custom mt-2">
                                    <label>{{ __('checkout.state_county') }} <span class="required">*</span></label>
                                    <select name="state" id="state" class="form-control" required>
                                        <option value="">{{ __('checkout.select_state') }}</option>
                                    </select>
                                </div>

                                <div class="select-custom mt-2">
                                    <label>{{ __('checkout.town_city') }} <span class="required">*</span></label>
                                    <select name="city" id="city" class="form-control" required>
                                        <option value="">{{ __('checkout.select_city') }}</option>
                                    </select>
                                </div>

                                <div class="form-group mt-2">
                                    <label>{{ __('checkout.street_address') }} <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="address" value="{{ $user->address ?? '' }}" placeholder="{{ __('checkout.house_number_street') }}" required />
                                </div>

                                <div class="form-group">
                                    <label>{{ __('checkout.postcode_zip') }} <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="zip_code" value="{{ $user->zip_code ?? '' }}" required />
                                </div>

                                <div class="form-group">
                                    <label>{{ __('checkout.phone') }} <span class="required">*</span></label>
                                    <input type="tel" class="form-control" name="phone" value="{{ $user->phone ?? '' }}" required />
                                </div>

                                <div class="form-group">
                                    <label>{{ __('checkout.email_address') }} <span class="required">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{ $user->email ?? '' }}" required />
                                </div>

                                <div class="form-group">
                                    <label class="order-comments">{{ __('checkout.order_notes') }} ({{ __('checkout.optional') }})</label>
                                    <textarea class="form-control" name="notes" placeholder="{{ __('checkout.notes_placeholder') }}" rows="5"></textarea>
                                </div>
                            </li>
                        </ul>
                    </div>

@push('scripts')
                            <script>
                                $(document).ready(function() {
                                    $('#country').on('change', function() {
                                        var countryId = $(this).val();
                                        $('#state').html('<option value="">{{ __('checkout.loading') }}</option>');
                                        $('#city').html('<option value="">{{ __('checkout.select_city') }}</option>');

                                        if (countryId) {
                                            $.ajax({
                                                url: '/get-states/' + countryId,
                                                type: 'GET',
                                                success: function(data) {
                                                    $('#state').html('<option value="">{{ __('checkout.select_state') }}</option>');
                                                    $.each(data, function(key, value) {
                                                        $('#state').append('<option value="' + value.id + '">' + value.name + '</option>');
                                                    });
                                                }
                                            });
                                        } else {
                                            $('#state').html('<option value="">{{ __('checkout.select_state') }}</option>');
                                        }
                                    });

                                    $('#state').on('change', function() {
                                        var stateId = $(this).val();
                                        $('#city').html('<option value="">{{ __('checkout.loading') }}</option>');

                                        if (stateId) {
                                            $.ajax({
                                                url: '/get-cities/' + stateId,
                                                type: 'GET',
                                                success: function(data) {
                                                    $('#city').html('<option value="">{{ __('checkout.select_city') }}</option>');
                                                    $.each(data, function(key, value) {
                                                        $('#city').append('<option value="' + value.id + '">' + value.name + '</option>');
                                                    });
                                                }
                                            });
                                        } else {
                                            $('#city').html('<option value="">{{ __('checkout.select_city') }}</option>');
                                        }
                                    });
                                    
                                });
                            </script>
                            @endpush

                <div class="col-lg-5">
                        <style>
                            .order-summary {
                                background: #fff;
                                border-radius: 12px;
                                box-shadow: 0 4px 20px rgba(0,0,0,0.08);
                                padding: 25px;
                                position: sticky;
                                top: 20px;
                            }
                            .order-summary h3 {
                                font-weight: 700;
                                color: #1a1a1a;
                                margin-bottom: 20px;
                                border-bottom: 1px solid #f0f0f0;
                                padding-bottom: 15px;
                            }
                            .table-mini-cart { margin-bottom: 0; }
                            .table-mini-cart th { border: none; color: #777; font-weight: 500; font-size: 13px; }
                            .product-title { font-size: 15px; font-weight: 600; color: #333; }
                            .price-col span { font-weight: 700; color: #1a1a1a; }
                            .order-total h4 { font-size: 18px; font-weight: 700; margin: 0; }
                            .total-price span { font-size: 24px; color: #000; font-weight: 800; }

                            /* Payment Section Styling */
                            .payment-container { margin-top: 30px; border-top: 2px solid #f5f5f5; padding-top: 30px; }
                            .payment-options-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; flex-wrap: wrap; gap: 10px; }
                            .payment-methods-logos img { height: 24px; margin-left: 10px; opacity: 0.8; filter: grayscale(20%); }

                            .payment-tabs { display: flex; border-bottom: 1px solid #eee; margin-bottom: 25px; }
                            .payment-tab-btn {
                                padding: 12px 25px;
                                cursor: pointer;
                                font-weight: 600;
                                color: #666;
                                border-bottom: 3px solid transparent;
                                transition: all 0.3s;
                                font-size: 15px;
                            }
                            .payment-tab-btn.active { color: #0066cc; border-bottom-color: #0066cc; }
                            .payment-tab-btn:hover { color: #0066cc; }

                            .tab-content { display: none; animation: fadeIn 0.4s ease-out; }
                            .tab-content.active { display: block; }
                            @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }

                            .payment-form-group { margin-bottom: 20px; }
                            .payment-form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #444; font-size: 14px; }
                            .payment-form-group input {
                                width: 100%;
                                padding: 12px 15px;
                                border: 1px solid #ddd;
                                border-radius: 8px;
                                font-size: 15px;
                                transition: border-color 0.3s, box-shadow 0.3s;
                            }
                            .payment-form-group input:focus { border-color: #0066cc; outline: none; box-shadow: 0 0 0 3px rgba(0,102,204,0.1); }

                            .expiry-cvv-row { display: flex; gap: 15px; }
                            .btn-place-order {
                                width: 100%;
                                padding: 15px;
                                background: #0056b3;
                                color: #fff;
                                border: none;
                                border-radius: 30px;
                                font-weight: 700;
                                font-size: 16px;
                                margin-top: 20px;
                                transition: background 0.3s, transform 0.2s;
                                cursor: pointer;
                            }
                            .btn-place-order:hover { background: #004494; transform: translateY(-2px); box-shadow: 0 4px 15px rgba(0,86,179,0.3); }

                            .wallet-balance, .stc-header { background: #f8f9fa; padding: 15px; border-radius: 10px; border-left: 4px solid #0066cc; margin-bottom: 15px; }
                            .wallet-balance p, .stc-header p { margin: 0; font-weight: 500; color: #555; }
                        </style>

                        <div class="order-summary">
                            <h3>{{ __('checkout.your_order') }}</h3>

                            <table class="table table-mini-cart">
                                <thead>
                                    <tr>
                                        <th colspan="2">{{ __('cart.product') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $id => $details)
                                    <tr>
                                        <td class="product-col">
                                            <h3 class="product-title">
                                                {{ $details['name'] }} <span class="text-muted">× {{ $details['quantity'] }}</span>
                                            </h3>
                                            @if(isset($details['options']) && is_array($details['options']))
                                                <div style="font-size: 12px; color: #777; margin-top: 5px;">
                                                @foreach($details['options'] as $key => $value)
                                                    @if(!is_null($value) && $value !== '')
                                                        <div><strong style="color:#555; text-transform:capitalize;">{{ str_replace('_', ' ', $key) }}:</strong> {{ is_array($value) ? implode(', ', $value) : $value }}</div>
                                                    @endif
                                                @endforeach
                                                </div>
                                            @endif
                                        </td>
                                        <td class="price-col text-right">
                                            <span>{{ format_price($details['price'] * $details['quantity']) }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal border-top">
                                        <td><h4 class="font-size-sm">{{ __('cart.subtotal') }}</h4></td>
                                        <td class="price-col text-right"><span>{{ format_price($subtotal) }}</span></td>
                                    </tr>
                                    @if($total_discount > 0)
                                    <tr class="cart-subtotal text-danger">
                                        <td><h4 class="font-size-sm">{{ __('cart.discount') }}</h4></td>
                                        <td class="price-col text-right"><span>-{{ format_price($total_discount) }}</span></td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <td><h4 class="font-size-sm">{{ __('checkout.after_discount') }}</h4></td>
                                        <td class="price-col text-right"><span>{{ format_price($after_discount) }}</span></td>
                                    </tr>
                                    @endif
                                    <tr class="cart-subtotal">
                                        <td><h4 class="font-size-sm">{{ __('cart.tax_vat') }}</h4></td>
                                        <td class="price-col text-right"><span>{{ format_price($tax) }}</span></td>
                                    </tr>
                                    <tr class="order-shipping">
                                        <td colspan="2">
                                            <h4 class="font-size-sm m-b-xs">{{ __('checkout.shipping') }}</h4>
                                            <div class="custom-control custom-radio d-flex align-items-center">
                                                <input type="radio" class="custom-control-input" name="shipping_method" checked />
                                                <label class="custom-control-label font-weight-bold" style="font-size: 14px;">{{ __('checkout.free_shipping') }}</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="order-total border-top pt-3">
                                        <td><h4>{{ __('cart.order_total') }}</h4></td>
                                        <td class="text-right">
                                            <b class="total-price"><span>{{ format_price($grand_total) }}</span></b>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                            <!-- Refund Policy Note -->
                            <div class="checkout-policy-box mt-3 mb-3" style="background: #fff8fc; border: 1px solid #f9d6eb; border-radius: 10px; padding: 15px;">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-undo-alt mr-2" style="color: #2596be;"></i>
                                    <h5 class="m-0" style="font-size: 14px; color: #2596be; font-weight: 700;">{{ __('checkout.cancellation_refund_policy') }}</h5>
                                </div>
                                <ul class="m-0 p-0" style="list-style: none; font-size: 12.5px; line-height: 1.5; color: #666;">
                                    <li class="mb-1"><i class="fas fa-check-circle mr-1" style="color: #48bb78; font-size: 10px;"></i> {{ __('checkout.cancel_within') }} <strong>5 {{ __('checkout.minutes') }}</strong> {{ __('checkout.for') }} <strong>75% {{ __('checkout.refund') }}</strong>.</li>
                                    <li><i class="fas fa-times-circle mr-1" style="color: #f56565; font-size: 10px;"></i> {{ __('checkout.non_refundable') }} 5 {{ __('checkout.minutes') }} {{ __('checkout.of_placement') }}.</li>
                                </ul>
                            </div>

                            <div class="payment-container">
                                <div class="payment-options-header">
                                    <h4 class="m-0">{{ __('checkout.payment_options') }}</h4>
                                </div>

                                <!-- Cash on Delivery -->
                                <div class="cod-section" style="background: #f0fff4; border: 2px solid #48bb78; border-radius: 12px; padding: 20px; margin-bottom: 20px;">
                                    <div class="d-flex align-items-center">
                                        <span style="font-size: 32px; margin-right: 15px;">💵</span>
                                        <div>
                                            <h5 class="m-0" style="font-weight: 700; color: #276749;">Cash on Delivery</h5>
                                            <p class="m-0 small" style="color: #555;">Pay in cash when your order arrives at your door.</p>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn-place-order">
                                    {{ __('checkout.place_order') }}
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>

        <div class="mb-6"></div>
    </main>
@endsection

