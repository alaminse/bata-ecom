@php
if(auth()->user() != null) {
    $user_id = Auth::user()->id;
    $cart = \App\Cart::where('user_id', $user_id)->get();
} else {
    $temp_user_id = Session()->get('temp_user_id');
    if($temp_user_id) {
        $cart = \App\Cart::where('temp_user_id', $temp_user_id)->get();
    }
}

@endphp

{{-- <div class="mini-cart-icon mini-cart-icon-2">
    <a  href="#ltn__utilize-cart-menu" class="d-flex ltn__utilize-toggle text-reset">
        <span class="mini-cart-icon">
            <i class="fas fa-heart"></i>
            @if(Auth::check())
                <sup class="cart-count">{{ count(Auth::user()->wishlists)}}</sup>
            @else
            <sup class="cart-count">0</sup>
            @endif
        </span>
    </a>
</div> --}}

<div class="mini-cart-icon mini-cart-icon-2">
    <a href="#ltn__utilize-cart-menu" class="ltn__utilize-toggle text-reset">
        <span class="mini-cart-icon">
            {{-- <i class="fas fa-shopping-cart"></i> --}}
            <i class="icon-shopping-cart"></i>
            @if(isset($cart) && count($cart) > 0)
                <sup class="cart-count">{{ count($cart)}}</sup>
            @else
                <sup class="cart-count">0</sup>
            @endif
            {{-- <h6><span>Your Cart</span> <span class="ltn__secondary-color">$89.25</span></h6> --}}
        </span>
    </a>
</div>

<!-- Utilize Cart Menu Start -->
<div id="ltn__utilize-cart-menu" class="ltn__utilize ltn__utilize-cart-menu stop-propagation">
    <div class="ltn__utilize-menu-inner ltn__scrollbar">
        <div class="ltn__utilize-menu-head">
            <span class="ltn__utilize-menu-title">{{translate('Cart')}}</span>
            <button class="ltn__utilize-close">×</button>
        </div>
        @if(isset($cart) && count($cart) > 0)
        
        <div class="mini-cart-product-area ltn__scrollbar list-group-flush">
            @php
                $total = 0;
            @endphp
            @foreach($cart as $key => $cartItem)
                @php
                    $product = \App\Product::find($cartItem['product_id']);
                    $total = $total + $cartItem['price'] * $cartItem['quantity'];
                @endphp
                @if ($product != null)
                    <div class="mini-cart-item clearfix">
                        <div class="mini-cart-img">
                            <a href="{{ route('product', $product->slug) }}" class="text-reset">
                                <img
                                    src="{{ uploaded_asset($product->thumbnail_img) }}"
                                    data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                    alt="{{  $product->getTranslation('name')  }}"
                                >
                            </a>
                            <span class="mini-cart-item-delete">
                                <button onclick="removeFromCart({{ $cartItem['id'] }})">
                                    <i class="icon-cancel"></i>
                                </button>
                            </span>
                        </div>
                        <div class="mini-cart-info">
                            <h6><a href="#">{{  $product->getTranslation('name')  }}</a></h6>
                            <span class="mini-cart-quantity"> {{ $cartItem['quantity'] }} x {{ single_price($cartItem['price']) }}</span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="mini-cart-footer">
            <div class="mini-cart-sub-total">
                <h5>{{translate('Subtotal')}}: <span>{{ single_price($total) }}</span></h5>
            </div>
            <div class="btn-wrapper">
                <a href="{{ route('cart') }}" class="theme-btn-1 btn btn-effect-1">{{translate('View cart')}}</a>
                @if (Auth::check())
                    <a href="{{ route('checkout.shipping_info') }}" class="theme-btn-2 btn btn-effect-2">
                        {{translate('Checkout')}}
                    </a>
                @endif
            </div>
            {{-- <p>Free Shipping on All Orders Over $100!</p> --}}
        </div>
        @else
        <div class="text-center p-3">
            <i class="las la-frown la-3x opacity-60 mb-3"></i>
            <h3 class="h6 fw-700">{{translate('Your Cart is empty')}}</h3>
        </div>
        @endif
    </div>
</div>
<!-- Utilize Cart Menu End -->

