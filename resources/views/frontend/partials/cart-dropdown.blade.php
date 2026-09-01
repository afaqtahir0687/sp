@if($cart && count($cart) > 0)
    @foreach($cart as $id => $details)
        @php
            $isBlankProduct = isset($details['type']) && $details['type'] === 'blank';
        @endphp
        <div class="product">
            <div class="product-details">
                <h4 class="product-title">
                    @if($isBlankProduct)
                        <a href="{{ route('blank-products.show', $details['slug']) }}">
                            {{ app()->getLocale() === 'ar' && isset($details['name_ar']) ? $details['name_ar'] : ($details['name'] ?? '') }}
                        </a>
                    @else
                        <a href="{{ route('product.show', array($details['category_slug'] ?? 'uncategorized', $details['subcategory_slug'] ?? 'no-sub', $details['slug'])) }}">
                            {{ app()->getLocale() === 'ar' && isset($details['name_ar']) ? $details['name_ar'] : ($details['name'] ?? '') }}
                        </a>
                    @endif
                </h4>

                <span class="cart-product-info">
                    <span class="cart-product-qty">{{ $details['quantity'] }} {{ $isBlankProduct ? __('cart.qty') : __('cart.designs') }}</span> × {{ format_price($details['price']) }}
                </span>
                @if($isBlankProduct)
                    @if(isset($details['options']['size']))
                        <div class="product-specs mt-1">
                            <span style="font-size: 11px; color: #777;">{{ __('cart.size') }} {{ $details['options']['size'] }}</span>
                        </div>
                    @endif
                    @if(isset($details['options']['color']))
                        <div class="product-specs">
                            <span style="font-size: 11px; color: #777;">{{ __('cart.color') }} {{ $details['options']['color'] }}</span>
                        </div>
                    @endif
                @else
                    @if(isset($details['options']['print_quantity']))
                        <div class="product-specs mt-1">
                            <span style="font-size: 11px; color: #777;">{{ __('cart.print_quantity') }} {{ $details['options']['print_quantity'] }}</span>
                        </div>
                    @endif
                @endif
            </div>

            <figure class="product-image-container">
                @if($isBlankProduct)
                    <a href="{{ route('blank-products.show', $details['slug']) }}" class="product-image">
                @else
                    <a href="{{ route('product.show', array($details['category_slug'] ?? 'uncategorized', $details['subcategory_slug'] ?? 'no-sub', $details['slug'])) }}" class="product-image">
                @endif
                    @if($details['image'])
                        <img src="{{ asset('storage/app/public/' . $details['image']) }}" alt="product"
                            width="80" height="80">
                    @else
                        <img src="{{ asset('assets/images/products/product-1.jpg') }}" alt="product"
                            width="80" height="80">
                    @endif
                </a>

                <a href="{{ route('cart.remove', $id) }}" class="btn-remove icon-cancel" title="Remove Product"></a>
            </figure>
        </div>
    @endforeach
@else
    <div class="product text-center">
        <p class="p-3">{{ __('header.your_cart_is_empty') }}</p>
    </div>
@endif

