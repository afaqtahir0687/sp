@extends('frontend.layouts.master')
@section('title', __('order_complete') . ' - Crelogics')
@section('content')
    <main class="main">
        <div class="container">
            <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                <li>
                    <a href="{{ route('cart.index') }}">{{ __('header.shopping_cart') }}</a>
                </li>
                <li>
                    <a href="{{ route('checkout.index') }}">{{ __('header.checkout') }}</a>
                </li>
                <li class="active">
                    <a href="{{ route('order.complete') }}">{{ __('order_complete') }}</a>
                </li>
            </ul>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-complete-content text-center py-5">
                        <div class="success-animation mb-5">
                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                            </svg>
                        </div>
                        
                        <h2 class="mt-4 font-weight-bold">{{ __('thank_you_for_your_order') }}</h2>
                        <p class="lead text-muted px-lg-5">{{ __('order_success_message') }}</p>
                        
                        <div class="order-info-card mt-5">
                            <div class="row no-gutters">
                                <div class="col-sm-6 col-md-3 border-right border-bottom p-4">
                                    <p class="text-uppercase small text-muted font-weight-bold mb-2">{{ __('order_number') }}</p>
                                    <h5 class="mb-0">#{{ session('order_number', 'AD-'.rand(10000, 99999)) }}</h5>
                                </div>
                                <div class="col-sm-6 col-md-3 border-right border-bottom p-4">
                                    <p class="text-uppercase small text-muted font-weight-bold mb-2">{{ __('date') }}</p>
                                    <h5 class="mb-0">{{ date('M d, Y') }}</h5>
                                </div>
                                <div class="col-sm-6 col-md-3 border-right border-bottom p-4">
                                    <p class="text-uppercase small text-muted font-weight-bold mb-2">{{ __('grand_total') }}</p>
                                    <h5 class="mb-0 text-primary font-weight-bold">{{ format_price(session('grand_total', 0.00)) }}</h5>
                                </div>
                                <div class="col-sm-6 col-md-3 border-bottom p-4">
                                    <p class="text-uppercase small text-muted font-weight-bold mb-2">{{ __('payment') }}</p>
                                    <h5 class="mb-0 text-capitalize">{{ str_replace('_', ' ', session('payment_method', 'Card')) }}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="action-buttons mt-5">
                            <a href="{{ route('home') }}" class="btn btn-primary btn-round btn-lg px-5 mx-2 mb-3">{{ __('continue_shopping') }}</a>
                            <a href="{{ route('track.order') }}" class="btn btn-outline-dark btn-round btn-lg px-5 mx-2 mb-3">{{ __('view_order_status') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .order-info-card {
                background: #fff;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.05);
                overflow: hidden;
                border: 1px solid #eee;
            }
            .btn-round { border-radius: 50px; }
            
            /* Success Animation */
            .checkmark__circle {
                stroke-dasharray: 166;
                stroke-dashoffset: 166;
                stroke-width: 2;
                stroke-miterlimit: 10;
                stroke: #7ac142;
                fill: none;
                animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
            }
            .checkmark {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                display: block;
                stroke-width: 2;
                stroke: #fff;
                stroke-miterlimit: 10;
                margin: 0 auto;
                box-shadow: inset 0px 0px 0px #7ac142;
                animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
            }
            .checkmark__check {
                transform-origin: 50% 50%;
                stroke-dasharray: 48;
                stroke-dashoffset: 48;
                animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
            }
            @keyframes stroke { 100% { stroke-dashoffset: 0; } }
            @keyframes scale { 0%, 100% { transform: none; } 50% { transform: scale3d(1.1, 1.1, 1); } }
            @keyframes fill { 100% { box-shadow: inset 0px 0px 0px 50px #7ac142; } }
        </style>

        <div class="mb-6"></div>
    </main>
@endsection

