@php
    $locale = app()->getLocale();
    $dir = $locale == 'ar' ? 'rtl' : 'ltr';

    // Load JSON translations
    $translations = [];
    $jsonFile = resource_path('lang/' . $locale . '.json');
    if (file_exists($jsonFile)) {
        $translations = json_decode(file_get_contents($jsonFile), true);
    }
    
    // SEO Settings
    $currentRoute = \Illuminate\Support\Facades\Route::currentRouteName() ?? 'home';
    $currentPath = \Illuminate\Support\Facades\Request::path();
    
    $seo = \App\Models\SeoSetting::where('page_name', $currentRoute)
                                 ->orWhere('page_name', $currentPath)
                                 ->orWhere('page_name', '/' . $currentPath)
                                 ->first();
    
    $appName = app()->getLocale() == 'ar' ? __('common.app_name') : config('app.name', 'Crelogics');
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $dir }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>
        @if(isset($seo) && !empty($seo->title))
            {{ $seo->title }} - {{ $appName }}
        @else
            @yield('title', 'Home') - {{ $appName }}
        @endif
    </title>
    
    <meta name="keywords" content="{{ isset($seo) && !empty($seo->meta_keywords) ? $seo->meta_keywords : View::yieldContent('meta_keywords', 'printing services, advertisements, business cards, flyers, banners, social media marketing') }}" />
    
    <meta name="description" content="{{ isset($seo) && !empty($seo->meta_description) ? $seo->meta_description : View::yieldContent('meta_description', 'Crelogics provides high-quality printing and advertisement services including business cards, flyers, banners, and digital marketing solutions.') }}">
    <meta name="author" content="SW-THEMES">
    <!--<link rel="icon" type="image/x-icon" href="assets/images/icons/favicon.png">-->
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/demoes/demo4/title-logo.jpeg') }}">
    
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <script>
        WebFontConfig = {
            google: {
                families: ['Open+Sans:300,400,600,700,800', 'Poppins:300,400,500,600,700,800', 'Oswald:300,400,500,600,700,800']
            }
        };
        (function (d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = 'assets/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">

    @if($dir == 'rtl')
        <style>
            body {
                text-align: right;
            }

            .ml-auto,
            .mx-auto {
                margin-left: 0 !important;
                margin-right: auto !important;
            }

            .mr-auto,
            .mx-auto {
                margin-right: 0 !important;
                margin-left: auto !important;
            }

            .pr-3,
            .px-3 {
                padding-right: 0 !important;
                padding-left: 1rem !important;
            }

            .pl-3,
            .px-3 {
                padding-left: 0 !important;
                padding-right: 1rem !important;
            }

            .text-left {
                text-align: right !important;
            }

            .text-right {
                text-align: left !important;
            }

            .float-left {
                float: right !important;
            }

            .float-right {
                float: left !important;
            }

            /* Header Search Fixes for RTL */
            .header-search-wrapper {
                flex-direction: row !important;
            }

            .header-search-wrapper .form-control {
                border-radius: 0 30px 30px 0 !important;
                padding-right: 22px !important;
            }

            .header-search-wrapper .btn {
                border-radius: 30px 0 0 30px !important;
            }

            /* Header Icons Fixes for RTL */
            .header-right {
                display: flex;
                flex-direction: row;
                align-items: center;
            }

            .header-right>.header-icon,
            .header-right>.dropdown {
                margin-right: 1.5rem !important;
                margin-left: 0 !important;
            }

            /* Badges position */
            .wishlist-count,
            .cart-count {
                right: auto !important;
                left: -5px !important;
            }

            /* ============================================================
                               HEADER CONTACT RTL FIXES
                               English layout: [📞 img]  [CALL US NOW / +96655...]
                               Arabic layout:  [اتصل بنا الآن / +96655...]  [📞 img]
                               - Reverse flex so phone image moves to RIGHT
                               - Stack label + number vertically (display:block)
                               - Keep number LTR but right-aligned
                            ============================================================ */
            .header-contact {
                flex-direction: row-reverse !important;
            }

            .header-contact img {
                margin-left: 0 !important;
                margin-right: 12px !important;
            }

            .header-contact h6 {
                text-align: right !important;
                padding-right: 0 !important;
                padding-left: 0 !important;
            }

            .header-contact h6 span {
                display: block !important;
                font-size: 11px;
                font-weight: 600;
                text-transform: uppercase;
            }

            .header-contact h6 a {
                display: block !important;
                direction: ltr !important;
                unicode-bidi: embed !important;
                text-align: right !important;
                font-size: 15px;
                font-weight: 700;
            }

            /* ============================================================
                               CURRENCY SWITCHER RTL FIXES
                               - Icon/circle appears AFTER text in RTL (so use margin-left)
                               - Chevron arrow appears BEFORE text in RTL (so use margin-right)
                            ============================================================ */
            .currency-switcher {
                display: flex !important;
                align-items: center !important;
                gap: 6px !important;
            }

            /* Icon (circle icon, bag icon, user icon, profile image) goes to the right-most position */
                .currency-switcher .curr-icon-circle,
                .currency-switcher > i.fas.fa-shopping-bag,
                .currency-switcher > i.fas.fa-user,
                .currency-switcher > img {
                    order: 1 !important;
                }

                /* Chevron arrow sits right next to the icon */
                .currency-switcher i.fas.fa-chevron-down {
                    order: 2 !important;
                    margin: 0 !important;
                }

                /* Text takes the remaining space to the left */
                .currency-switcher > span:not(.curr-icon-circle) {
                    order: 3 !important;
                }

            /* Currency dropdown items RTL */
            .currency-dropdown-premium .header-menu ul li a {
                flex-direction: row-reverse !important;
            }

            .currency-dropdown-premium .header-menu ul li a .curr-icon-circle {
                margin-right: 4px !important;
                margin-left: 0 !important;
            }

            .currency-dropdown-premium .header-menu ul li a i {
                margin-right: 4px !important;
                margin-left: 0 !important;
            }

            .currency-dropdown-premium .header-menu ul li a:hover {
                padding-right: 20px !important;
                padding-left: 15px !important;
            }

            /* ============================================================
                               sf-with-ul ARROW RTL FIXES
                               Keep ::after visible but reposition it to the RIGHT side
                               of the text (which is the visual start in RTL).
                            ============================================================ */
            .sf-with-ul {
                position: relative !important;
                padding-right: 18px !important;
                padding-left: 0 !important;
            }

            /* Override the ::after positioning to place arrow on RIGHT side */
            .sf-with-ul::after,
            .main-nav .menu>li>.sf-with-ul::after,
            .menu.sf-arrows>li>.sf-with-ul::after {
                position: absolute !important;
                right: 2px !important;
                left: auto !important;
                top: 50% !important;
                transform: translateY(-50%) !important;
                margin-top: 0 !important;
                margin-left: 0 !important;
                margin-right: 0 !important;
            }

            /* Megamenu RTL positioning */
            /* Megamenu overflow fix for RTL via JavaScript */
           
            /* Menu Banner inside Megamenu RTL */
            .menu-banner {
                position: relative;
                width: 100%;
                display: block;
            }

            .menu-banner .banner-content {
                left: auto !important;
                right: 2rem !important;
                /* Move text over the image properly in RTL */
                text-align: right !important;
            }

            /* Dropdown Menu RTL Fixes */
            .header-dropdown .header-menu {
                right: 0 !important;
                left: auto !important;
            }

            .header-dropdown .header-menu::before {
                right: 15px !important;
                left: auto !important;
            }

            /* Cart Dropdown RTL Fixes */
            .cart-dropdown .dropdown-menu {
                right: 0 !important;
                left: auto !important;
            }

            .dropdown-cart-total .float-right {
                float: left !important;
            }

            /* User Profile RTL Fixes */
            .currency-switcher img {
                margin-right: 0 !important;
                margin-left: 8px !important;
            }

            /* ============================================================
                               INFO BOX RTL FIXES
                               In dir=rtl, browser AUTOMATICALLY reverses flex-direction:row
                               so first child (icon) appears on the RIGHT naturally.
                               We only need to:
                               1. Force display:flex (theme may use float-based layout)
                               2. Clear float:left on the icon (theme floats it left)
                            ============================================================ */
            .info-box.info-box-icon-left,
            div.info-box.info-box-icon-left {
                display: flex !important;
                flex-direction: row !important;
                /* RTL browser auto-reverses this */
                align-items: center !important;
            }

            /* Clear theme's float so flexbox takes control of icon position */
            .info-box.info-box-icon-left>i,
            .info-box.info-box-icon-left>span.info-box-icon,
            .info-box.info-box-icon-left>.info-box-icon {
                float: none !important;
                margin-left: 0 !important;
                margin-right: 15px !important;
                /* gap to the right of icon */
            }

            /* Content: clear float, full width, text right-aligned */
            .info-box.info-box-icon-left .info-box-content {
                float: none !important;
                flex: 1 !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
                text-align: right !important;
            }

            /* Banner RTL Fixes */
            .banner-layer.text-right {
                text-align: left !important;
            }

            .banner-layer.text-lg-right {
                text-align: left !important;
            }

            .banner-layer.text-lg-left {
                text-align: right !important;
            }

            /* Product Card RTL Fixes */
            .product-action {
                flex-direction: row-reverse !important;
            }

            .product-action .btn-icon-wish {
                margin-right: 0 !important;
                margin-left: 5px !important;
            }

            .product-action .btn-add-cart {
                margin-right: 0 !important;
                margin-left: 5px !important;
            }

            .product-action .btn-quickview {
                margin-right: 0 !important;
                margin-left: 5px !important;
            }

            /* Header top-bar category buttons RTL */
            .top-notice .category {
                margin-left: 0 !important;
                margin-right: 0.5rem !important;
            }

            .top-notice .ml-2 {
                margin-left: 0 !important;
                margin-right: 0.5rem !important;
            }

            .top-notice .mr-3 {
                margin-right: 0 !important;
                margin-left: 1rem !important;
            }
        </style>
    @endif

    <style>
        .bounce-loader .bounce1,
        .bounce-loader .bounce2,
        .bounce-loader .bounce3 {
            background-color: #2596be !important;
        }

        /* Premium Currency Switcher Styling */
        /* .currency-dropdown-premium .currency-switcher {
            display: flex;
            align-items: center;
            background: rgba(37, 150, 190, 0.05);
            border: 1px solid rgba(37, 150, 190, 0.2);
            padding: 4px 12px;
            border-radius: 30px;
            color: #333;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05), inset 0 1px 0 rgba(255, 255, 255, 0.8);
            text-decoration: none !important;
        }

        .currency-dropdown-premium .currency-switcher:hover {
            background: rgba(37, 150, 190, 0.1);
            border-color: rgba(37, 150, 190, 0.5);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(37, 150, 190, 0.15);
            color: #2596be;
        } */

        .currency-dropdown-premium .currency-switcher i.flag,
        .currency-dropdown-premium .header-menu i.flag {
            display: none;
        }

        .curr-icon-circle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px;
            height: 22px;
            background: #2596be;
            color: white;
            border-radius: 50%;
            font-size: 10px;
            font-weight: bold;
            margin-right: 8px;
            flex-shrink: 0;
            box-shadow: 0 1px 3px rgba(37, 150, 190, 0.3);
        }

        .currency-dropdown-premium .header-menu ul li a:hover .curr-icon-circle {
            transform: scale(1.1);
        }

        .header-icon {
            position: relative;
        }

        .header-icon .badge-circle {
            position: absolute;
            top: -5px;
            right: -5px;
            font-family: 'Open Sans', sans-serif;
        }

        .product-image-container {
            position: relative;
            display: inline-block;
        }

        .product-image-container .btn-remove {
            position: absolute;
            top: -5px;
            right: -5px;
            z-index: 2;
            background: #fff;
            color: #2596be;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            font-size: 14px;
            line-height: 1;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .product-image-container .btn-remove:hover {
            background: #2596be;
            color: #fff;
            transform: scale(1.1);
        }

        .currency-dropdown-premium .currency-switcher i.flag {
            margin-right: 8px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            border-radius: 2px;
        }

        .currency-dropdown-premium .header-menu {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            /* border: 1px solid #eee; */
            margin-top: 10px;
        }

        .currency-dropdown-premium .header-menu ul li a {
            padding: 10px 15px;
            display: flex;
            align-items: center;
            transition: all 0.2s;
            color: #555;
            font-weight: 500;
        }

        .currency-dropdown-premium .header-menu ul li a:hover {
            background: #f8f9fa;
            color: #2596be;
            padding-left: 20px;
        }
    </style>
    <style>
        /* Custom Toast Notification Styles */
        .custom-toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 10000;
        }

        .custom-toast {
            background-color: #fff;
            color: #333;
            padding: 15px 20px;
            margin-bottom: 10px;
            border-radius: 4px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            min-width: 300px;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.4s ease;
            border-left: 5px solid #ccc;
        }

        .custom-toast.show {
            opacity: 1;
            transform: translateX(0);
        }

        .custom-toast.success {
            border-left-color: #28a745;
        }

        .custom-toast.success i {
            color: #28a745;
        }

        .custom-toast.error {
            border-left-color: #dc3545;
        }

        .custom-toast.error i {
            color: #dc3545;
        }

        .custom-toast.warning {
            border-left-color: #ffc107;
        }

        .custom-toast.warning i {
            color: #ffc107;
        }

        .custom-toast.info {
            border-left-color: #17a2b8;
        }

        .custom-toast.info i {
            color: #17a2b8;
        }

        .custom-toast-content {
            flex-grow: 1;
            margin-left: 10px;
            font-size: 14px;
            font-weight: 500;
        }

        .custom-toast-close {
            cursor: pointer;
            color: #999;
            font-size: 18px;
            line-height: 1;
            margin-left: 10px;
        }

        .custom-toast-close:hover {
            color: #333;
        }

        .top-notice .category:hover {
            background-color: #1a7a99 !important;
        }
    </style>

    {{-- ===== BRAND COLOR THEME: #262263 (Navy) + #2596be (Blue) ===== --}}
    <style>
        /* ---- TOP NOTICE BAR ---- */
        .top-notice {
            background-color: #262263 !important;
            color: #fff !important;
            padding: 8px 0 !important;
        }
        .top-notice h5 {
            color: #fff !important;
            font-size: 13.5px;
            font-weight: 500;
            margin: 0 10px 0 0;
            vertical-align: middle;
        }
        .top-notice h5 b {
            color: #ffd166;
            font-weight: 700;
        }
        .top-notice .top-notice-actions {
            display: inline-flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
            vertical-align: middle;
        }
        .top-notice-btn {
            display: inline-flex !important;
            align-items: center;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none !important;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.18);
            border: 1px solid transparent;
            line-height: 1.4;
        }
        .top-notice-btn.btn-notice-business {
            background-color: #2596be !important;
            color: #ffffff !important;
        }
        .top-notice-btn.btn-notice-business:hover {
            background-color: #1a7a99 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 150, 190, 0.45);
            color: #ffffff !important;
        }
        .top-notice-btn.btn-notice-discount {
            background: linear-gradient(135deg, #f7941d 0%, #ff5722 100%) !important;
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.3);
            animation: discountButtonPulse 2.5s infinite;
        }
        .top-notice-btn.btn-notice-discount:hover {
            background: linear-gradient(135deg, #ff9f2c 0%, #ff6b3d 100%) !important;
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 4px 15px rgba(247, 148, 29, 0.55);
            color: #ffffff !important;
        }
        @keyframes discountButtonPulse {
            0%, 100% {
                box-shadow: 0 2px 8px rgba(247, 148, 29, 0.3);
            }
            50% {
                box-shadow: 0 3px 14px rgba(247, 148, 29, 0.65);
            }
        }

        /* Animated Limited Time Badge */
        .limited-time-badge {
            display: inline-flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.09);
            border: 1px solid rgba(255, 209, 102, 0.45);
            padding: 3px 12px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 600;
            color: #ffd166 !important;
            letter-spacing: 0.2px;
            vertical-align: middle;
            margin-left: 8px;
            animation: limitedGlow 2s infinite ease-in-out;
            transition: all 0.3s ease;
        }
        .limited-pulse-dot {
            width: 7px;
            height: 7px;
            background-color: #ff4757;
            border-radius: 50%;
            display: inline-block;
            margin-right: 6px;
            animation: pulseLiveDot 1.5s infinite;
        }
        .limited-clock-icon {
            font-size: 11px;
            margin-right: 4px;
            animation: clockTicking 2s infinite ease-in-out;
        }
        @keyframes pulseLiveDot {
            0% {
                transform: scale(0.9);
                box-shadow: 0 0 0 0 rgba(255, 71, 87, 0.7);
            }
            70% {
                transform: scale(1.25);
                box-shadow: 0 0 0 6px rgba(255, 71, 87, 0);
            }
            100% {
                transform: scale(0.9);
                box-shadow: 0 0 0 0 rgba(255, 71, 87, 0);
            }
        }
        @keyframes clockTicking {
            0%, 100% {
                transform: rotate(0deg);
            }
            25% {
                transform: rotate(-12deg);
            }
            75% {
                transform: rotate(12deg);
            }
        }
        @keyframes limitedGlow {
            0%, 100% {
                border-color: rgba(255, 209, 102, 0.35);
                box-shadow: 0 0 6px rgba(255, 209, 102, 0.15);
            }
            50% {
                border-color: rgba(255, 209, 102, 0.9);
                box-shadow: 0 0 14px rgba(255, 209, 102, 0.5);
            }
        }
        [dir="rtl"] .top-notice h5 {
            margin: 0 0 0 10px;
        }
        [dir="rtl"] .limited-time-badge {
            margin-left: 0;
            margin-right: 8px;
        }
        [dir="rtl"] .limited-pulse-dot {
            margin-right: 0;
            margin-left: 6px;
        }
        [dir="rtl"] .limited-clock-icon {
            margin-right: 0;
            margin-left: 4px;
        }






        /* ---- MOBILE MENU ---- */
        .mobile-menu-container {
            background-color: #262263 !important;
        }
        .mobile-menu-wrapper {
            background-color: #262263 !important;
        }
        .mobile-menu > li > a {
            color: rgba(255,255,255,0.9) !important;
            border-bottom-color: rgba(255,255,255,0.1) !important;
        }
        .mobile-menu > li > a:hover {
            color: #2596be !important;
        }
        .mobile-menu-close {
            color: #fff !important;
        }
        .mobile-menu-close:hover {
            color: #2596be !important;
        }
        .mobile-menu-toggler {
            color: #262263 !important;
        }

        /* ---- STICKY NAV BAR (bottom mobile) ---- */
        .sticky-navbar {
            background-color: #262263 !important;
            border-top: 2px solid #2596be !important;
        }
        .sticky-info a {
            color: rgba(255,255,255,0.8) !important;
        }
        .sticky-info a:hover {
            color: #2596be !important;
        }

        /* ---- SCROLL TO TOP BUTTON ---- */
        #scroll-top {
            background-color: #2596be !important;
            color: #fff !important;
        }
        #scroll-top:hover {
            background-color: #262263 !important;
        }

        /* ---- LINKS ACCENT ---- */
        a.text-primary,
        .text-primary {
            color: #2596be !important;
        }

        /* ---- MEGAMENU SUBMENU LINK HOVER ---- */
        .megamenu .submenu li a:hover {
            color: #2596be !important;
        }

        /* ---- CART DROPDOWN HEADER ---- */
        .dropdown-cart-header {
            color: #262263 !important;
            font-weight: 700;
        }

        /* ---- BADGE CIRCLE (cart/wishlist count) ---- */
        .badge-circle {
            background-color: #2596be !important;
            color: #fff !important;
        }
    </style>
    <style>
        /* Force all buttons to use the requested color #2596be, except popup close and slider arrows */
        .btn,
        .btn-primary,
        .btn-secondary,
        .btn-dark,
        .btn-success,
        .btn-info,
        .btn-warning,
        .btn-danger,
        button:not(.mfp-close):not(.owl-prev):not(.owl-next):not(.owl-dot):not(.inquiry-popup-close),
        input[type="submit"],
        input[type="button"],
        .btn-icon,
        .btn-quickview,
        .btn-icon-wish {
            background-color: #f7941d !important;
            border-color: #f7941d !important;
            color: #ffffff !important;
        }

        .btn:hover,
        .btn-primary:hover,
        .btn-secondary:hover,
        .btn-dark:hover,
        button:not(.mfp-close):not(.owl-prev):not(.owl-next):not(.owl-dot):not(.inquiry-popup-close):hover,
        input[type="submit"]:hover,
        input[type="button"]:hover,
        .btn-icon:hover,
        .btn-quickview:hover,
        .btn-icon-wish:hover,
        .btn-add-cart:hover {
            background-color: #262263 !important;
            border-color: #262263 !important;
            color: #ffffff !important;
        }
    </style>
</head>

<body>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                document.body.classList.add('loaded');
            }, 100);
        });
    </script>
    <div class="page-wrapper">
        <div class="top-notice bg-primary text-white">
            <div class="container text-center">
                <h5 class="d-inline-block">{{ __('top_notice.get_up_to') }} <b>40% {{ __('home.off') }}</b>
                    {{ __('top_notice.happy_new_year') }}</h5>
                <div class="top-notice-actions d-inline-flex">
                    <a href="{{ route('subcategory.show', ['business-stationery', 'business-cards-printing']) }}" class="top-notice-btn btn-notice-business">
                        <i class="fa fa-id-card mr-1"></i> {{ __('top_notice.business_cards') }}
                    </a>
                    <a href="{{ route('discount.offers') }}" class="top-notice-btn btn-notice-discount">
                        <i class="fa fa-tag mr-1"></i> {{ __('top_notice.discount_offers') }}
                    </a>
                    <span class="limited-time-badge">
                        <span class="limited-pulse-dot"></span>
                        <i class="far fa-clock mr-1 limited-clock-icon"></i>
                        <span class="limited-text">{{ __('top_notice.limited_time') }}</span>
                    </span>
                </div>
                <button title="Close (Esc)" type="button" class="mfp-close">×</button>
            </div>
        </div>

        @include('frontend.layouts.header')

        @yield('content')

        @include('frontend.layouts.footer')
    </div>

    <div class="loading-overlay">
        <div class="bounce-loader">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>

    <div class="mobile-menu-overlay"></div>

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="fa fa-times"></i></span>
            <nav class="mobile-nav">
                <ul class="mobile-menu">
                    <li><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
                    <li>
                        <a href="{{ route('category.index') }}">{{ __('header.categories') }}</a>
                        @if(isset($headerCategories) && $headerCategories->count() > 0)
                            <ul>
                                @foreach($headerCategories as $category)
                                    <li><a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                    <li><a href="{{ route('products.index') }}">{{ __('header.products') }}</a></li>
                    <li><a href="{{ route('blogs.index') }}">{{ __('header.blog') }}</a></li>
                    <li><a href="{{ route('about.index') }}">{{ __('footer.about_us') }}</a></li>
                    <li><a href="{{ route('vision.mission') }}">{{ __('footer.vision_mission') }}</a></li>
                    <li><a href="{{ route('ceo.message') }}">{{ __('footer.ceo_message') }}</a></li>
                    <li><a href="{{ route('company.profile') }}">{{ __('footer.company_profile') }}</a></li>
                    <li><a href="{{ route('services.page') }}">{{ __('footer.our_services') }}</a></li>
                    <li><a href="{{ route('clients.page') }}">{{ __('footer.our_clients') }}</a></li>
                    <li><a href="{{ route('careers.page') }}">{{ __('footer.careers') }}</a></li>
                    <li><a href="{{ route('contact.index') }}">{{ __('footer.contact_us') }}</a></li>
                </ul>

                <ul class="mobile-menu mt-2 mb-2">
                    <li class="border-0">
                        <a href="{{ route('dashboard') }}">{{ __('header.my_account') }}</a>
                    </li>
                    <li class="border-0">
                        <a href="{{ route('wishlist.index') }}">{{ __('header.my_wishlist') }}</a>
                    </li>
                    <li class="border-0">
                        <a href="{{ route('cart.index') }}">{{ __('header.cart') }}</a>
                    </li>
                </ul>
            </nav>

            <form class="search-wrapper mb-2" action="#">
                <input type="text" class="form-control mb-0" placeholder="{{ __('mobile_menu.search_placeholder') }}"
                    required />
                <button class="btn icon-search text-white bg-transparent p-0" type="submit"></button>
            </form>

            <div class="social-icons">
                <a href="#" class="social-icon social-facebook icon-facebook" target="_blank">
                </a>
                <a href="#" class="social-icon social-twitter icon-twitter" target="_blank">
                </a>
                <a href="#" class="social-icon social-instagram icon-instagram" target="_blank">
                </a>
            </div>
        </div>
    </div>

    <div class="sticky-navbar">
        <div class="sticky-info">
            <a href="{{ route('home') }}">
                <i class="icon-home"></i>{{ __('sticky_navbar.home') }}
            </a>
        </div>
        <div class="sticky-info">
            <a href="{{ route('category.index') }}" class="">
                <i class="icon-bars"></i>{{ __('sticky_navbar.categories') }}
            </a>
        </div>
        <div class="sticky-info">
            <a href="{{ route('wishlist.index') }}" class="">
                <i class="icon-wishlist-2"></i>{{ __('sticky_navbar.wishlist') }}
            </a>
        </div>
        <div class="sticky-info">
            <a href="{{ route('dashboard') }}" class="">
                <i class="icon-user-2"></i>{{ __('sticky_navbar.account') }}
            </a>
        </div>
        <div class="sticky-info">
            <a href="{{ route('cart.index') }}" class="">
                <i class="icon-shopping-cart position-relative">
                    <span
                        class="cart-count badge-circle">{{ array_sum(array_column(session('cart', []), 'quantity')) }}</span>
                </i>{{ __('sticky_navbar.cart') }}
            </a>
        </div>
    </div>

    {{-- <div class="newsletter-popup mfp-hide bg-img" id="newsletter-popup-form"
        style="background: #f1f1f1 no-repeat center/cover url(assets/images/newsletter_popup_bg.jpg)">
        <div class="newsletter-popup-content">
            @if(config('app.logo'))
            <img src="{{ asset('storage/app/public/' . config('app.logo')) }}" alt="{{ config('app.name') }}" width="111"
                height="44" class="logo-newsletter">
            @else
            <img src="{{ asset('assets/images/logo.png') }}" width="111" height="44" alt="Logo" class="logo-newsletter">
            @endif
            <h2>Subscribe to newsletter</h2>

            <p>
                Subscribe to the Porto mailing list to receive updates on new arrivals, special offers and our
                promotions.
            </p>

            <form action="#">
                <div class="input-group">
                    <input type="email" class="form-control" id="newsletter-email" name="newsletter-email"
                        placeholder="Your email address" required />
                    <input type="submit" class="btn btn-primary" value="Submit" />
                </div>
            </form>
            <div class="newsletter-subscribe">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" value="0" id="show-again" />
                    <label for="show-again" class="custom-control-label">
                        Don't show this popup again
                    </label>
                </div>
            </div>
        </div>

        <button title="Close (Esc)" type="button" class="mfp-close">
            ×
        </button>
    </div> --}}
    <!-- End .newsletter-popup -->

    {{-- Inquiry Popup Modal --}}
    <div class="inquiry-popup-overlay" id="inquiry-popup">
        <div class="inquiry-popup-box">
            <button type="button" class="inquiry-popup-close" id="close-inquiry-popup">&times;</button>
            <div class="inquiry-popup-header">
                <h3>{{ app()->getLocale() == 'ar' ? 'استفسار سريع' : 'Quick Inquiry' }}</h3>
                <p>{{ app()->getLocale() == 'ar' ? 'لديك أي سؤال؟ أرسل لنا رسالة وسنقوم بالرد عليك في أقرب وقت.' : "Have a question? Drop us a line and we'll get back to you shortly." }}</p>
            </div>
            <form id="inquiry-submit-form" class="inquiry-popup-form">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="{{ app()->getLocale() == 'ar' ? 'الاسم' : 'Your Name' }}" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="{{ app()->getLocale() == 'ar' ? 'البريد الإلكتروني' : 'Your Email' }}" required>
                </div>
                <div class="form-group">
                    <input type="tel" name="number" class="form-control" placeholder="{{ app()->getLocale() == 'ar' ? 'رقم الهاتف' : 'Phone Number' }}" required>
                </div>
                <div class="form-group">
                    <textarea name="message" class="form-control" placeholder="{{ app()->getLocale() == 'ar' ? 'كيف يمكننا مساعدتك؟' : 'How can we help you?' }}" required></textarea>
                </div>
                <button type="submit" class="inquiry-popup-btn" id="inquiry-submit-btn">
                    {{ app()->getLocale() == 'ar' ? 'إرسال الرسالة' : 'Send Message' }}
                </button>
            </form>
        </div>
    </div>

    <style>
        .inquiry-popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            z-index: 100000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.4s ease, visibility 0.4s ease;
        }

        .inquiry-popup-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .inquiry-popup-box {
            background: #ffffff;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            position: relative;
            transform: scale(0.85);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .inquiry-popup-overlay.show .inquiry-popup-box {
            transform: scale(1);
        }

        .inquiry-popup-close {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 28px;
            color: #000000 !important;
            cursor: pointer;
            line-height: 1;
            transition: color 0.2s, opacity 0.2s;
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            outline: none !important;
            padding: 0 !important;
        }

        [dir="rtl"] .inquiry-popup-close {
            right: auto;
            left: 15px;
        }

        .inquiry-popup-close:hover {
            color: #000000 !important;
            background: transparent !important;
            opacity: 0.7;
        }

        .inquiry-popup-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .inquiry-popup-header h3 {
            font-size: 24px;
            font-weight: 700;
            color: #222;
            margin-bottom: 8px;
        }

        .inquiry-popup-header p {
            font-size: 14px;
            color: #666;
            margin: 0;
        }

        .inquiry-popup-form .form-group {
            margin-bottom: 18px;
            position: relative;
        }

        .inquiry-popup-form .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
            background-color: #f9f9f9;
        }

        .inquiry-popup-form .form-control:focus {
            border-color: #2596be;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(37, 150, 190, 0.15);
            outline: none;
        }

        .inquiry-popup-form textarea.form-control {
            resize: none;
            height: 100px;
        }

        .inquiry-popup-btn {
            width: 100%;
            padding: 12px;
            background-color: #2596be;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
        }

        .inquiry-popup-btn:hover {
            background-color: #262263;
        }

        .inquiry-popup-btn:active {
            transform: scale(0.98);
        }

        .inquiry-popup-btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    {{-- Custom Toast Container --}}
    <div id="toast-container" class="custom-toast-container"></div>

    {{-- WhatsApp Floating Button --}}
    <style>
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .whatsapp-float:hover {
            background-color: #20ba5a;
            color: #FFF;
            transform: scale(1.1);
        }

        .my-float {
            margin-top: 16px;
        }
    </style>
    <a href="https://wa.me/966557834154?text=Hello%20Crelogics,%20I%20am%20interested%20in%20your%20services."
        class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/optional/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        // Global translations for JavaScript
        window.translations = window.translations || {
            messages: {
                product_added_to_cart: {!! json_encode(__('messages.product_added_to_cart')) !!},
                error_adding_to_cart: {!! json_encode(__('messages.error_adding_to_cart')) !!},
                please_select_size: {!! json_encode(__('messages.please_select_size')) !!},
                please_select_color: {!! json_encode(__('messages.please_select_color')) !!},
                error_adding_to_cart_try_again: {!! json_encode(__('messages.error_adding_to_cart_try_again')) !!},
                product_removed_from_cart: {!! json_encode(__('messages.product_removed_from_cart')) !!},
                error_adding_to_wishlist: {!! json_encode(__('messages.error_adding_to_wishlist')) !!},
                product_removed_from_wishlist: {!! json_encode(__('messages.product_removed_from_wishlist')) !!},
                invalid_product_data: {!! json_encode(__('messages.invalid_product_data')) !!},
                confirm_remove_wishlist: {!! json_encode(__('messages.confirm_remove_wishlist')) !!},
                something_went_wrong: {!! json_encode(__('messages.something_went_wrong')) !!},
                please_login_to_add_to_cart: {!! json_encode(__('messages.please_login_to_add_to_cart')) !!},
            }
        };

        function showToast(message, type) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');

            let iconClass = 'fa-info-circle';
            if (type === 'success') iconClass = 'fa-check-circle';
            if (type === 'error') iconClass = 'fa-exclamation-circle';

            toast.className = `custom-toast ${type}`;
            toast.innerHTML = `
                <i class="fas ${iconClass} fa-lg"></i>
                <div class="custom-toast-content">${message}</div>
                <span class="custom-toast-close">&times;</span>
            `;

            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.add('show');
            }, 10);

            const closeToast = () => {
                toast.classList.remove('show');
                setTimeout(() => {
                    toast.remove();
                }, 400);
            };

            setTimeout(closeToast, 5000);

            toast.querySelector('.custom-toast-close').addEventListener('click', closeToast);
        }

        @if(session('success'))
            showToast("{{ session('success') }}", 'success');
        @endif
        @if(session('error'))
            showToast("{{ session('error') }}", 'error');
        @endif
        @if(session('warning'))
            showToast("{{ session('warning') }}", 'warning');
        @endif
        @if(session('status'))
            showToast("{{ session('status') }}", 'success');
        @endif
        @if($errors->any())
            @foreach($errors->all() as $error)
                showToast("{{ $error }}", 'error');
            @endforeach
        @endif

        // Wishlist AJAX functionality
        $(document).on('click', '[data-wishlist-id]', function(e) {
            e.preventDefault();
            const btn = $(this);
            const id = btn.data('wishlist-id');
            const type = btn.data('wishlist-type') || 'product';
            const icon = btn.find('i');

            $.ajax({
                url: `{{ route('wishlist.add', ':id') }}`.replace(':id', id) + (type === 'blank' ? '/blank' : ''),
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        if(typeof showToast === 'function') {
                            showToast(response.message, 'success');
                        }
                        icon.removeClass('icon-heart').addClass('fas fa-heart text-danger');
                        if(response.wishlistCount !== undefined) {
                            $('.wishlist-count').text(response.wishlistCount);
                        }
                    } else {
                        if(typeof showToast === 'function') {
                            showToast("{{ __('messages.error_adding_to_wishlist') }}", 'error');
                        }
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 401 && xhr.responseJSON && xhr.responseJSON.redirect) {
                        if (typeof showToast === 'function') {
                            showToast(xhr.responseJSON.message, 'warning');
                        }
                        setTimeout(function() {
                            window.location.href = xhr.responseJSON.redirect;
                        }, 1500);
                        return;
                    }
                    if(typeof showToast === 'function') {
                        const message = window.translations && window.translations.messages ? window.translations.messages.error_adding_to_wishlist : 'Error adding to wishlist. Please try again.';
                        showToast(message, 'error');
                    }
                }
            });
        });

        // Global cart dropdown refresh function
        function refreshCartDropdown() {
            $.ajax({
                url: "{{ route('cart.dropdown') }}",
                type: 'GET',
                success: function(response) {
                    $('#header-cart-products').html(response.html);
                    $('.cart-total-price').html(response.total);
                    $('.cart-count').text(response.count);

                    // Hide/show cart total and action based on emptiness
                    if(response.count === 0) {
                        $('.dropdown-cart-total').fadeOut();
                        $('.dropdown-cart-action').fadeOut();
                    } else {
                        $('.dropdown-cart-total').fadeIn();
                        $('.dropdown-cart-action').fadeIn();
                    }
                }
            });
        }

        // Inquiry Popup triggers
        $(document).ready(function() {
            const referrer = document.referrer;
            const currentHost = window.location.host;
            let isRefresh = false;

            if (window.performance) {
                if (window.performance.getEntriesByType) {
                    const navEntries = window.performance.getEntriesByType("navigation");
                    if (navEntries.length > 0 && navEntries[0].type === "reload") {
                        isRefresh = true;
                    }
                } else if (window.performance.navigation && window.performance.navigation.type === 1) {
                    isRefresh = true;
                }
            }

            // Show popup on page refresh or if visiting from another site/direct visit
            if (isRefresh || !referrer.includes(currentHost)) {
                $('#inquiry-popup').addClass('show');
            }

            // Close popup handlers
            $('#close-inquiry-popup').on('click', function() {
                $('#inquiry-popup').removeClass('show');
            });

            $('#inquiry-popup').on('click', function(e) {
                if ($(e.target).hasClass('inquiry-popup-overlay')) {
                    $('#inquiry-popup').removeClass('show');
                }
            });

            // Submit inquiry form via AJAX
            $('#inquiry-submit-form').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const btn = $('#inquiry-submit-btn');
                const originalText = btn.text();

                btn.prop('disabled', true).text('Submitting...');

                const name = form.find('input[name="name"]').val();
                const email = form.find('input[name="email"]').val();
                const phone = form.find('input[name="number"]').val();
                const message = form.find('textarea[name="message"]').val();

                $.ajax({
                    url: "{{ route('inquiry.submit') }}",
                    type: "POST",
                    data: form.serialize(),
                    success: function(response) {
                        btn.prop('disabled', false).text(originalText);
                        if (response.success) {
                            if (typeof showToast === 'function') {
                                showToast(response.message, 'success');
                            }
                            $('#inquiry-popup').removeClass('show');
                            
                            // Construct WhatsApp message details and open in new tab
                            const text = `Hello Crelogics,\n\nI have a new inquiry:\n- *Name:* ${name}\n- *Email:* ${email}\n- *Phone:* ${phone}\n- *Message:* ${message}`;
                            const whatsappUrl = `https://wa.me/966557834154?text=${encodeURIComponent(text)}`;
                            window.open(whatsappUrl, '_blank');
                            
                            form[0].reset();
                        } else {
                            if (typeof showToast === 'function') {
                                showToast('Error submitting inquiry.', 'error');
                            }
                        }
                    },
                    error: function(xhr) {
                        btn.prop('disabled', false).text(originalText);
                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            const errors = xhr.responseJSON.errors;
                            Object.keys(errors).forEach(key => {
                                if (typeof showToast === 'function') {
                                    showToast(errors[key][0], 'error');
                                }
                            });
                        } else {
                            if (typeof showToast === 'function') {
                                showToast('Something went wrong. Please try again.', 'error');
                            }
                        }
                    }
                });
            });
        });

        @if($dir == 'rtl')
            document.addEventListener('DOMContentLoaded', function () {
                var menuItems = document.querySelectorAll('.main-nav .menu > li');
                menuItems.forEach(function (li) {
                    li.addEventListener('mouseenter', function () {
                        var megamenu = li.querySelector('.megamenu.megamenu-fixed-width');
                        if (megamenu) {
                            // Reset inline styles to default to allow natural positioning
                            megamenu.style.left = '';
                            megamenu.style.right = '';
                            megamenu.style.transform = '';

                            // Measure the position
                            var rect = megamenu.getBoundingClientRect();
                            var windowWidth = window.innerWidth || document.documentElement.clientWidth;

                            // Check if overflowing left
                            if (rect.left < 0) {
                                var shiftRight = Math.abs(rect.left) + 15; // 15px safety margin
                                megamenu.style.left = 'auto';
                                megamenu.style.right = '-' + shiftRight + 'px';
                            }
                            // Check if overflowing right
                            else if (rect.right > windowWidth) {
                                var shiftLeft = (rect.right - windowWidth) + 15; // 15px safety margin
                                megamenu.style.right = 'auto';
                                megamenu.style.left = '-' + shiftLeft + 'px';
                            }
                        }
                    });
                });
            });
        @endif
    </script>

    @stack('scripts')
</body>

</html>