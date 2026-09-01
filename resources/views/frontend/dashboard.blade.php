@extends('frontend.layouts.master')
@section('title', __('dashboard.my_account'))
@section('content')
    <style>
        /* RTL Fixes for Dashboard */
        html[dir="rtl"] .sidebar {
            text-align: right;
        }

        html[dir="rtl"] .nav-tabs .nav-link {
            text-align: right;
            padding-right: 0;
            padding-left: 15px;
        }

        html[dir="rtl"] .nav-tabs .nav-link i {
            margin-left: 8px;
            margin-right: 0;
        }

        html[dir="rtl"] .account-sub-title {
            text-align: right;
        }

        html[dir="rtl"] .account-sub-title i {
            margin-left: 8px;
            margin-right: 0;
        }

        html[dir="rtl"] .table-order {
            text-align: right;
        }

        html[dir="rtl"] .table-order th,
        html[dir="rtl"] .table-order td {
            text-align: right;
        }

        html[dir="rtl"] .table-order .text-left {
            text-align: right !important;
        }

        html[dir="rtl"] .alert-info {
            text-align: right;
            border-left: none;
            border-right: 4px solid #17a2b8;
        }

        html[dir="rtl"] .alert-info i {
            margin-left: 8px;
            margin-right: 0;
        }

        html[dir="rtl"] .alert-info ul {
            padding-right: 20px;
            padding-left: 0;
        }

        html[dir="rtl"] .breadcrumb-item + .breadcrumb-item::before {
            float: right;
            padding-right: 0.5rem;
            padding-left: 0;
            content: var(--bs-breadcrumb-divider, "/");
        }

        html[dir="rtl"] .breadcrumb-item {
            float: right;
        }

        html[dir="rtl"] .feature-box h3 {
            text-align: center;
        }

        html[dir="rtl"] .address-box {
            text-align: right;
        }

        html[dir="rtl"] .form-group label {
            text-align: right;
        }

        html[dir="rtl"] .form-control {
            text-align: right;
        }

        html[dir="rtl"] .mr-2 {
            margin-right: 0 !important;
            margin-left: 0.5rem !important;
        }

        html[dir="rtl"] .mr-3 {
            margin-right: 0 !important;
            margin-left: 1rem !important;
        }

        html[dir="rtl"] .ml-1 {
            margin-left: 0 !important;
            margin-right: 0.25rem !important;
        }

        html[dir="rtl"] .pr-1 {
            padding-right: 0 !important;
            padding-left: 0.25rem !important;
        }

        html[dir="rtl"] .d-flex {
            flex-direction: row-reverse;
        }

        html[dir="rtl"] .d-flex.align-items-center {
            flex-direction: row-reverse;
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
                                {{ __('dashboard.my_account') }}
                            </li>
                        </ol>
                    </div>
                </nav>

                <h1>{{ __('dashboard.my_account') }}</h1>
            </div>
        </div>

        <div class="container account-container custom-account-container mt-5">
            <div class="row">
                <div class="sidebar widget widget-dashboard mb-lg-0 mb-3 col-lg-3 order-0">
                    <h2 class="text-uppercase">{{ __('dashboard.my_account') }}</h2>
                    <ul class="nav nav-tabs list flex-column mb-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard"
                                role="tab" aria-controls="dashboard" aria-selected="true">{{ __('dashboard.dashboard') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="order-tab" data-toggle="tab" href="#order" role="tab"
                                aria-controls="order" aria-selected="true">{{ __('dashboard.orders') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="download-tab" data-toggle="tab" href="#download" role="tab"
                                aria-controls="download" aria-selected="false">{{ __('dashboard.downloads') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab"
                                aria-controls="address" aria-selected="false">{{ __('dashboard.addresses') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab"
                                aria-controls="edit" aria-selected="false">{{ __('dashboard.account_details') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="wishlist-tab" data-toggle="tab" href="#wishlist" role="tab"
                                aria-controls="wishlist" aria-selected="false">{{ __('dashboard.wishlist') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('auth.logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>

                    </ul>
                </div>
                <div class="col-lg-9 order-lg-last order-1 tab-content">
                    <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                        <div class="dashboard-content">
                            <p>
                                {{ __('dashboard.hello') }} <strong class="text-dark">{{ $user->name }}</strong> ({{ __('dashboard.not') }}
                                <strong class="text-dark">{{ $user->name }}</strong>?
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="btn btn-link ">{{ __('auth.logout') }}</a>)
                            </p>

                            <p>
                                {{ __('dashboard.from_your_account_dashboard') }}
                                <a class="link-to-tab" href="#order">{{ __('dashboard.recent_orders') }}</a>,
                                {{ __('dashboard.manage_your') }}
                                <a class="link-to-tab" href="#address">{{ __('dashboard.shipping_and_billing_addresses') }}</a>, {{ __('dashboard.and') }}
                                <a class="link-to-tab" href="#edit">{{ __('dashboard.edit_your_password_and_account_details') }}</a>
                            </p>

                            <div class="mb-4"></div>

                            <div class="row row-lg">
                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="#order" class="link-to-tab"><i class="fab fa-first-order"></i></a>
                                        <div class="feature-box-content">
                                            <h3>{{ __('dashboard.orders') }}</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="#download" class="link-to-tab"><i
                                                class="fas fa-cloud-download-alt"></i></a>
                                        <div class=" feature-box-content">
                                            <h3>{{ __('dashboard.downloads') }}</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="#address" class="link-to-tab"><i class="icon-location"></i></a>
                                        <div class="feature-box-content">
                                            <h3>{{ __('dashboard.addresses') }}</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="#edit" class="link-to-tab"><i class="icon-user-2"></i></a>
                                        <div class="feature-box-content p-0">
                                            <h3>{{ __('dashboard.account_details') }}</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="#wishlist" class="link-to-tab"><i class="far fa-heart"></i></a>
                                        <div class="feature-box-content">
                                            <h3>{{ __('dashboard.wishlist') }}</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i></a>
                                        <div class="feature-box-content">
                                            <h3>{{ __('auth.logout') }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End .row -->
                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="order" role="tabpanel">
                        <div class="order-content">
                            <h3 class="account-sub-title d-none d-md-block"><i
                                    class="sicon-social-dropbox align-middle mr-3"></i>{{ __('dashboard.orders') }}</h3>

                            <div class="alert alert-info rounded-lg mb-4 text-left" style="font-size: 0.9rem; border-left: 4px solid #17a2b8;">
                                <i class="fas fa-info-circle mr-2"></i>
                                <strong>{{ __('dashboard.cancellation_refund_policy') }}:</strong>
                                <ul class="mb-0 mt-2">
                                    <li>{{ __('dashboard.orders_can_only_be_cancelled') }}</li>
                                    <li>{{ __('dashboard.cancel_within_5_minutes') }}</li>
                                    <li>{{ __('dashboard.cancellations_after_5_minutes') }}</li>
                                </ul>
                            </div>

                            <div class="order-table-container text-center">
                                <table class="table table-order text-left">
                                    <thead>
                                        <tr>
                                            <th class="order-id">{{ __('dashboard.order') }}</th>
                                            <th class="order-date">{{ __('dashboard.date') }}</th>
                                            <th class="order-status">{{ __('dashboard.status') }}</th>
                                            <th class="order-price">{{ __('dashboard.total') }}</th>
                                            <th class="order-action">{{ __('dashboard.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $order)
                                            <tr>
                                                <td class="text-left">#{{ $order->order_number }}</td>
                                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                                <td>{{ $order->order_status }}</td>
                                                <td>{{ $order->grand_total }}</td>
                                                <td class="d-flex align-items-center">
                                                    <a href="#" class="btn btn-dark mr-2">{{ __('dashboard.view') }}</a>
                                                    @if ($order->order_status === 'pending')
                                                        <form action="{{ route('order.cancel', $order->id) }}" method="POST" onsubmit="return confirm('{{ __('dashboard.are_you_sure_cancel') }}')">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">{{ __('dashboard.cancel') }}</button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center p-0" colspan="5">
                                                    <p class="mb-5 mt-5">
                                                        {{ __('dashboard.no_order_made_yet') }}
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <hr class="mt-0 mb-3 pb-2" />

                                <a href="{{ route('home') }}" class="btn btn-dark">{{ __('dashboard.go_shop') }}</a>
                            </div>
                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="download" role="tabpanel">
                        <div class="download-content">
                            <h3 class="account-sub-title d-none d-md-block"><i
                                    class="sicon-cloud-download align-middle mr-3"></i>{{ __('dashboard.downloads') }}</h3>
                            <div class="download-table-container">
                                <p>{{ __('dashboard.no_downloads_available') }}</p> <a href="{{ route('home') }}"
                                    class="btn btn-primary text-transform-none mb-2">{{ __('dashboard.go_shop') }}</a>
                            </div>
                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="address" role="tabpanel">
                        <h3 class="account-sub-title d-none d-md-block mb-1"><i
                                class="sicon-location-pin align-middle mr-3"></i>{{ __('dashboard.addresses') }}</h3>
                        <div class="addresses-content">
                            <p class="mb-4">
                                {{ __('dashboard.following_addresses_checkout') }}
                            </p>

                            <div class="row">
                                <div class="address col-md-6">
                                    <div class="heading d-flex">
                                        <h4 class="text-dark mb-0">{{ __('dashboard.billing_address') }}</h4>
                                    </div>

                                    <div class="address-box">
                                        @if($user->address)
                                            {{ $user->address }}<br>
                                            {{ $user->city }}, {{ $user->state }} <br>
                                            {{ $user->zip_code }}<br>
                                            {{ $user->country }}
                                        @else
                                            {{ __('dashboard.no_address_set') }}
                                        @endif
                                    </div>

                                    <a href="#edit" class="btn btn-default address-action link-to-tab">{{ __('dashboard.edit_address') }}</a>
                                </div>

                                <div class="address col-md-6 mt-5 mt-md-0">
                                    <div class="heading d-flex">
                                        <h4 class="text-dark mb-0">
                                            {{ __('dashboard.shipping_address') }}
                                        </h4>
                                    </div>

                                    <div class="address-box">
                                         @if($user->address)
                                            {{ $user->address }}<br>
                                            {{ $user->city }}, {{ $user->state }} <br>
                                            {{ $user->zip_code }}<br>
                                            {{ $user->country }}
                                        @else
                                            {{ __('dashboard.no_address_set') }}
                                        @endif
                                    </div>

                                    <a href="#edit" class="btn btn-default address-action link-to-tab">{{ __('dashboard.edit_address') }}</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="edit" role="tabpanel">
                        <h3 class="account-sub-title d-none d-md-block mt-0 pt-1 ml-1"><i
                                class="icon-user-2 align-middle mr-3 pr-1"></i>{{ __('dashboard.account_details') }}</h3>
                        <div class="account-content">
                            <form action="#">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="acc-name">{{ __('auth.first_name') }} <span class="required">*</span></label>
                                            <input type="text" class="form-control" placeholder="{{ __('auth.first_name') }}"
                                                id="acc-name" name="first_name" value="{{ $user->first_name }}" required />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="acc-lastname">{{ __('auth.last_name') }} <span
                                                    class="required">*</span></label>
                                            <input type="text" class="form-control" id="acc-lastname"
                                                name="last_name" value="{{ $user->last_name }}" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="acc-text">{{ __('dashboard.display_name') }} <span class="required">*</span></label>
                                    <input type="text" class="form-control" id="acc-text" name="name"
                                        placeholder="{{ __('dashboard.display_name') }}" value="{{ $user->name }}" required />
                                    <p>{{ __('dashboard.display_name_info') }}</p>
                                </div>


                                <div class="form-group mb-4">
                                    <label for="acc-email">{{ __('auth.email') }} <span class="required">*</span></label>
                                    <input type="email" class="form-control" id="acc-email" name="email"
                                        placeholder="email@example.com" value="{{ $user->email }}" required />
                                </div>

                                <div class="change-password">
                                    <h3 class="text-uppercase mb-2">{{ __('dashboard.password_change') }}</h3>

                                    <div class="form-group">
                                        <label for="acc-password">{{ __('dashboard.current_password') }}</label>
                                        <input type="password" class="form-control" id="acc-password"
                                            name="current_password" />
                                    </div>

                                    <div class="form-group">
                                        <label for="acc-password">{{ __('dashboard.new_password') }}</label>
                                        <input type="password" class="form-control" id="acc-new-password"
                                            name="new_password" />
                                    </div>

                                    <div class="form-group">
                                        <label for="acc-password">{{ __('dashboard.confirm_new_password') }}</label>
                                        <input type="password" class="form-control" id="acc-confirm-password"
                                            name="new_password_confirmation" />
                                    </div>
                                </div>

                                <div class="form-footer mt-3 mb-0">
                                    <button type="button" class="btn btn-dark mr-0">
                                        {{ __('dashboard.save_changes') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="wishlist" role="tabpanel">
                        <div class="order-content">
                            <h3 class="account-sub-title d-none d-md-block"><i
                                    class="sicon-heart align-middle mr-3"></i>{{ __('dashboard.wishlist') }}</h3>
                             <div class="order-table-container text-center">
                                <table class="table table-order text-left">
                                    <thead>
                                        <tr>
                                            <th class="order-id">{{ __('dashboard.product') }}</th>
                                            <th class="order-price">{{ __('dashboard.price') }}</th>
                                            <th class="order-status">{{ __('dashboard.stock_status') }}</th>
                                            <th class="order-action">{{ __('dashboard.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($wishlist as $item)
                                            <tr>
                                                <td class="text-left">
                                                    @if($item->type === 'blank' && $item->blankProduct)
                                                        <a href="{{ route('blank-products.show', $item->blankProduct->slug) }}">{{ $item->blankProduct->name }}</a>
                                                    @elseif($item->type === 'product' && $item->product && $item->product->category && $item->product->subcategory)
                                                        <a href="{{ route('product.show', ['category_slug' => $item->product->category->slug, 'subcategory_slug' => $item->product->subcategory->slug, 'product_slug' => $item->product->slug]) }}">{{ $item->product->name }}</a>
                                                    @elseif($item->product)
                                                        <a href="#">{{ $item->product->name }}</a>
                                                    @else
                                                        <span>{{ __('dashboard.product_not_available') }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item->type === 'blank' && $item->blankProduct)
                                                        {{ $item->blankProduct->discount_price ?: $item->blankProduct->price }}
                                                    @elseif($item->product)
                                                         {{ $item->product->getSellingPrice() }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item->type === 'blank' && $item->blankProduct)
                                                        {{ $item->blankProduct->stock_status ?? __('dashboard.in_stock') }}
                                                    @elseif($item->product)
                                                        {{ $item->product->stock_status ?? __('dashboard.in_stock') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item->type === 'blank' && $item->blankProduct)
                                                        <a href="{{ route('blank-products.show', $item->blankProduct->slug) }}" class="btn btn-dark">{{ __('dashboard.view_product') }}</a>
                                                    @elseif($item->type === 'product' && $item->product && $item->product->category && $item->product->subcategory)
                                                        <a href="{{ route('product.show', ['category_slug' => $item->product->category->slug, 'subcategory_slug' => $item->product->subcategory->slug, 'product_slug' => $item->product->slug]) }}" class="btn btn-dark">{{ __('dashboard.view_product') }}</a>
                                                    @elseif($item->product)
                                                        <span class="text-muted">{{ __('dashboard.unavailable') }}</span>
                                                    @else
                                                        <span class="text-muted">{{ __('dashboard.unavailable') }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center p-0" colspan="4">
                                                    <p class="mb-5 mt-5">
                                                        {{ __('dashboard.no_items_wishlist') }}
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <hr class="mt-0 mb-3 pb-2" />
                            </div>
                        </div>
                    </div><!-- End .tab-pane -->

                </div><!-- End .tab-content -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-5"></div><!-- margin -->
    </main><!-- End .main -->
@endsection

