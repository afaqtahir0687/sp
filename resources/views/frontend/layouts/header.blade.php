<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left d-none d-sm-block">
                <p class="top-message text-uppercase">{{ __('header.free_returns') }} {{ format_price(99) }}+</p>
            </div>
            <div class="header-right header-dropdowns ml-0 ml-sm-auto w-sm-100">
                <div class="header-dropdown dropdown-expanded d-none d-lg-block">
                    <div class="header-menu">
                        <ul>
                            <li><a href="{{route('dashboard')}}">{{ __('header.my_account') }}</a></li>
                            <li><a href="{{ route('about.index') }}">{{ __('header.about_us') }}</a></li>
                            <li><a href="{{ route('blogs.index') }}">{{ __('header.blog') }}</a></li>
                            <li><a href="{{route('wishlist.index')}}">{{ __('header.my_wishlist') }}</a></li>
                            <li><a href="{{ route('cart.index') }}">{{ __('header.cart') }}</a></li>
                            <li><a href="{{ route('track.order') }}">{{ __('header.track_order') }}</a></li>
                        </ul>
                    </div>
                </div>
                <!-- <span class="separator"></span> -->
                <div class="header-dropdown">
                    @php $currentLocale = app()->getLocale(); @endphp
                    <a href="#">
                        @if($currentLocale == 'ar')
                            <i class="flag-sa flag"></i>{{ __('language.arabic') }}
                        @else
                            <i class="flag-us flag"></i>{{ __('language.english') }}
                        @endif
                    </a>
                    <div class="header-menu">
                        <ul>
                            <li>
                                <a href="{{ route('language.switch', 'en') }}">
                                    <i class="flag-us flag mr-2"></i>{{ __('language.english') }}
                                    @if($currentLocale == 'en') <i class="fas fa-check ml-1 text-success" style="font-size:10px;"></i> @endif
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('language.switch', 'ar') }}">
                                    <i class="flag-sa flag mr-2"></i>{{ __('language.arabic') }}
                                    @if($currentLocale == 'ar') <i class="fas fa-check ml-1 text-success" style="font-size:10px;"></i> @endif
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="header-dropdown mr-auto mr-sm-3 mr-md-0 currency-dropdown-premium mt-1">
                    <a href="#" class="currency-switcher">
                        <i class="fas fa-shopping-bag mr-2"></i>
                        <span>{{ __('header.shop') }}</span>
                        <i class="fas fa-chevron-down ml-2" style="font-size: 10px;"></i>
                    </a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="{{ route('home') }}"><i class="fas fa-print mr-2"></i>{{ __('header.custom_printing') }}</a></li>
                            <li><a href="{{ route('blank-products.index') }}"><i class="fas fa-tshirt mr-2"></i>{{ __('header.blank_products') }}</a></li>
                            <li><a href="{{ route('books.index') }}"><i class="fas fa-book mr-2"></i>{{ __('header.books') }}</a></li>
                        </ul>
                    </div>
                </div>

                <div class="header-dropdown mr-auto mr-sm-3 mr-md-0 currency-dropdown-premium mt-1">
                    @php
                        $current = current_currency();
                        $icon = '$';
                        if($current == 'SAR') $icon = __('common.SR');
                        // if($current == 'PKR') $icon = __('common.Rs');
                        $currentText = $current;
                        if($current == 'SAR') $currentText = __('common.SAR');
                        if($current == 'USD') $currentText = __('common.USD');
                        // if($current == 'PKR') $currentText = __('common.PKR');
                    @endphp
                    <a href="#" class="currency-switcher">
                        <span class="curr-icon-circle">{{ $icon }}</span>
                        <span>{{ $currentText }}</span>
                        <i class="fas fa-chevron-down ml-2" style="font-size: 10px;"></i>
                    </a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="{{ route('currency.switch', 'SAR') }}"><span class="curr-icon-circle mr-2">SR</span>SAR</a></li>
                            <li><a href="{{ route('currency.switch', 'USD') }}"><span class="curr-icon-circle mr-2">$</span>USD</a></li>
                            <!-- <li><a href="{{ route('currency.switch', 'PKR') }}"><span class="curr-icon-circle mr-2">Rs</span>PKR</a></li> -->
                        </ul>
                    </div>
                </div>

                <!-- <span class="separator"></span> -->

                @auth
                    <div class="header-dropdown mr-auto mr-sm-3 mr-md-0 currency-dropdown-premium mt-1">
                        @php
                            $name = Auth::user()->name;
                            $firstLetter = strtoupper(substr($name, 0, 1));
                        @endphp
                        <a href="#" class="currency-switcher">
                            @if(Auth::user()->profile_image)
                                <img src="{{ Auth::user()->profile_image }}" alt="User" style="width: 20px; height: 20px; border-radius: 50%; margin-right: 8px; object-fit: cover; box-shadow: 0 1px 3px rgba(37, 150, 190, 0.3);">
                            @else
                                <span class="curr-icon-circle">{{ $firstLetter }}</span>
                            @endif
                            <span>{{ $name }}</span>

                            <i class="fas fa-chevron-down ml-2" style="font-size: 10px;"></i>
                        </a>
                        <div class="header-menu">
                            <ul>
                                <li>
                                    <a href="{{ route('dashboard') }}">
                                        <i class="fas fa-user mr-2" style="font-size: 12px;"></i>{{ __('header.my_profile') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">
                                        <i class="fas fa-sign-out-alt mr-2" style="font-size: 12px;"></i>{{ __('header.logout') }}
                                    </a>
                                    <form id="logout-form-header" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="header-dropdown mr-auto mr-sm-3 mr-md-0 currency-dropdown-premium ml-2">
                        <a href="{{ route('login') }}" class="currency-switcher">
                            <i class="fas fa-user mr-2"></i>
                            <span>{{ __('header.login') }}</span>
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
        <div class="container">
            <div class="header-left col-lg-2 w-auto pl-0">
                <button class="mobile-menu-toggler text-primary mr-2" type="button">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="{{route('home')}}" class="logo">
                    @if(config('app.logo'))
                        <img src="{{ asset('storage/app/public/' . config('app.logo')) }}" width="111" height="44" alt="{{ config('app.name') }}">
                    @else
                        <img src="{{ asset('assets/images/logo.png') }}" width="111" height="44" alt="{{ config('app.name') }}">
                    @endif
                </a>
            </div>

            <div class="header-right w-lg-max">
                <div
                    class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mt-0">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                    <form action="#" method="get">
                        <div class="header-search-wrapper">
                            <input type="search" class="form-control" name="q" id="q" placeholder="{{ __('header.search_placeholder') }}" required>
                            <button class="btn icon-magnifier p-0" title="search" type="submit"></button>
                        </div>
                    </form>
                </div>

                <div class="header-contact d-none d-lg-flex pl-4 pr-4">
                    <img alt="phone" src="{{ asset('assets/images/phone.png') }}" width="30" height="30" class="pb-1">
                    <h6><span>{{ __('header.call_us_now') }}</span><a href="tel:+966557834154" class="text-dark font1" dir="ltr">+966557834154</a></h6>
                </div>

                <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="header-icon" title="login"><i class="icon-user-2"></i></a>

                <a href="{{ auth()->check() ? route('wishlist.index') : route('login') }}" class="header-icon" title="wishlist">
                    <i class="icon-wishlist-2"></i>
                    <span class="wishlist-count badge-circle">{{ count(session('wishlist', [])) + count(session('wishlist_blank', [])) }}</span>
                </a>

                <div class="dropdown cart-dropdown">
                    <a href="#" title="Cart" class="dropdown-toggle dropdown-arrow cart-toggle" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="minicart-icon"></i>
                        <span class="cart-count badge-circle">{{ array_sum(array_column(session('cart', []), 'quantity')) }}</span>
                    </a>

                    <div class="cart-overlay"></div>

                    <div class="dropdown-menu mobile-cart">
                        <a href="#" title="Close (Esc)" class="btn-close">×</a>

                        <div class="dropdownmenu-wrapper custom-scrollbar">
                            <div class="dropdown-cart-header">{{ __('header.shopping_cart') }}</div>
                            <div class="dropdown-cart-products" id="header-cart-products">
                                @include('frontend.partials.cart-dropdown', ['cart' => session('cart')])
                            </div>

                            <div class="dropdown-cart-total">
                                <span>{{ __('header.subtotal') }}</span>
                                @php $total = 0 @endphp
                                @foreach((array) session('cart') as $id => $details)
                                    @php $total += $details['price'] * $details['quantity'] @endphp
                                @endforeach
                                <span class="cart-total-price float-right">{{ format_price($total) }}</span>
                            </div>

                            <div class="dropdown-cart-action">
                                <a href="{{ route('cart.index') }}" class="btn btn-gray btn-block view-cart">{{ __('header.view_cart') }}</a>
                                <a href="{{ route('checkout.index') }}" class="btn btn-dark btn-block">{{ __('header.checkout') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-bottom sticky-header d-none d-lg-block" data-sticky-options="{'mobile': false}">
        <div class="container">
            <nav class="main-nav w-100">
                <ul class="menu">
                    @foreach($headerCategories as $category)
                        <li>
                            <a href="{{ route('category.show', $category->slug) }}" @if($category->subcategories->count() > 0) class="sf-with-ul" @endif>{{ $category->name }}</a>
                            @if($category->subcategories->count() > 0)
                                <div class="megamenu megamenu-fixed-width megamenu-3cols">
                                    <div class="row">
                                        {{-- Split subcategories into columns --}}
                                        @foreach($category->subcategories->chunk(ceil($category->subcategories->count() / 2)) as $chunk)
                                            <div class="col-lg-4 col-xl-4">
                                                <ul class="submenu">
                                                    @foreach($chunk as $subcategory)
                                                        <li>
                                                            <a href="{{ route('subcategory.show', [$category->slug, $subcategory->slug]) }}">{{ $subcategory->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                        <div class="col-lg-4 col-xl-4 p-0">
                                            <div class="menu-banner">
                                                <figure>
                                                    @if($category->banner_image)
                                                        <img src="{{ asset('storage/app/public/' . $category->banner_image) }}" width="192"
                                                            height="313" alt="Menu banner">
                                                    @else
                                                        <img src="{{ asset('assets/images/home-menu-banner.jpeg') }}" width="192"
                                                            height="313" alt="Menu banner">
                                                    @endif
                                                </figure>
                                                <div class="banner-content">
                                                    <h4>
                                                        @if($category->banner_top_text)
                                                            <span class="">{{ $category->banner_top_text }}</span><br />
                                                        @else
                                                            <span class="">{{ app()->getLocale() == 'ar' ? 'خصم يصل إلى' : 'UP TO' }}</span><br />
                                                        @endif
                                                        @if($category->banner_discount_text)
                                                            <b class="">{{ $category->banner_discount_text }}</b>
                                                        @else
                                                            <b class="">{{ app()->getLocale() == 'ar' ? '50%' : '50%' }}</b>
                                                        @endif
                                                        @if($category->banner_bottom_text)
                                                            <i>{{ $category->banner_bottom_text }}</i>
                                                        @else
                                                            <i>{{ app()->getLocale() == 'ar' ? 'فقط' : 'OFF' }}</i>
                                                        @endif
                                                    </h4>
                                                    @if($category->banner_button_link)
                                                        <a href="{{ $category->banner_button_link }}" class="btn btn-sm btn-dark">
                                                            @if($category->banner_button_text)
                                                                {{ $category->banner_button_text }}
                                                            @else
                                                                {{ app()->getLocale() == 'ar' ? 'تسوق الآن' : 'SHOP NOW' }}
                                                            @endif
                                                        </a>
                                                    @else
                                                        <a href="{{ route('category.show', $category->slug) }}" class="btn btn-sm btn-dark">
                                                            @if($category->banner_button_text)
                                                                {{ $category->banner_button_text }}
                                                            @else
                                                                {{ app()->getLocale() == 'ar' ? 'تسوق الآن' : 'SHOP NOW' }}
                                                            @endif
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
</header>
<style>
    .submenu li a:hover {
        color: #2596be !important;
    }
    .shop-categories-bar {
        padding: 12px 0;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    .shop-nav {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .shop-menu {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 30px;
    }
    .shop-menu li a {
        font-weight: 600;
        text-decoration: none;
        transition: opacity 0.3s;
        font-size: 15px;
    }
    .shop-menu li a:hover {
        opacity: 0.8;
    }

    .header-dropdown .currency-switcher {
        display: inline-flex !important;
        align-items: center !important;
        white-space: nowrap !important;
    }

    .header-dropdown .currency-switcher span {
        white-space: nowrap !important;
    }

    .header-dropdown .currency-switcher i {
        flex-shrink: 0 !important;
    }
    .main-nav .menu > li {
    position: relative;
    }

    /* Default megamenu */
    .main-nav .menu > li > .megamenu {
        left: 0;
        right: auto;
    }

    /* Last category */
    .main-nav .menu > li:last-child > .megamenu,
    .main-nav .menu > li:nth-last-child(2) > .megamenu {
        left: auto;
        right: 0;
    }



</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        // Function to refresh cart dropdown
        function refreshHeaderCart() {
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

        $(document).on('click', '.btn-remove:not(.wishlist-remove-btn)', function(e) {
            e.preventDefault();
            var $this = $(this);
            var url = $this.attr('href');
            var $productContainer = $this.closest('.product');
            var $row = $this.closest('tr');

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if(response.success) {

                        if($productContainer.length) {
                             $productContainer.fadeOut(300, function() { $(this).remove(); });
                        }
                        if($row.length) {
                            $row.fadeOut(300, function() { $(this).remove(); });
                        }

                        $('.cart-count').text(response.cartCount);
                        $('.cart-total-price').html(response.cartTotal);

                        if($('#cart-subtotal').length) $('#cart-subtotal').html(response.subtotal);
                        if($('#cart-discount').length) $('#cart-discount').html('-' + response.discount);
                        if($('#cart-tax').length) $('#cart-tax').html(response.tax);
                        if($('#cart-grand-total').length) $('#cart-grand-total').html(response.grandTotal);

                        // Refresh header cart dropdown
                        refreshHeaderCart();

                     if(response.isEmpty) {
                        setTimeout(function() {
                            // Handle empty cart
                            $('.table-cart tbody').html('<tr><td colspan="5" class="text-center p-5"><h4>{{ __('cart.cart_empty') }}</h4><a href="{{ route('home') }}" class="btn btn-primary mt-2">{{ __('cart.go_shopping') }}</a></td></tr>');
                            
                            // Also update header cart to show empty
                            $('.cart-count').text(0);
                            $('.dropdown-cart-products').html('<div class="product text-center"><p class="p-3">{{ __('cart.cart_empty') }}</p></div>');
                            $('.cart-total-price').text(formatPrice(0));
                            $('.dropdown-cart-total, .dropdown-cart-action').hide();
                        }, 500);
                    }

                        if(typeof showToast === 'function') {
                            const message = window.translations && window.translations.messages ? window.translations.messages.product_removed_from_cart : 'Product removed from cart successfully!';
                            showToast(message, "success");
                        }
                    } else {
                        window.location.href = url;
                    }
                },
                error: function() {
                    window.location.href = url;
                }
            });
        });
    });
</script>
