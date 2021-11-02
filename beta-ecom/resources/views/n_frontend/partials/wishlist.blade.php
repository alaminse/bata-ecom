{{-- <a href="{{ route('wishlists.index') }}" class="d-flex align-items-center text-reset">
    <i class="icon-heart"></i>
    <span class="flex-grow-1 ml-1">
        @if(Auth::check())
            <span class="badge badge-primary badge-inline badge-pill">{{ count(Auth::user()->wishlists)}}</span>
        @else
            <span class="badge badge-primary badge-inline badge-pill">0</span>
        @endif
        <span class="nav-box-text d-none d-xl-block opacity-70">{{translate('Wishlist')}}</span>
    </span>
</a> --}}

<div class="mini-cart-icon mini-cart-icon-2">
    <a href="{{ route('wishlists.index') }}" class="d-flex text-reset">
        <span class="mini-cart-icon">
            <i class="fas fa-heart"></i>
            @if(Auth::check())
                <sup class="cart-count">{{ count(Auth::user()->wishlists)}}</sup>
            @else
            <sup class="cart-count">0</sup>
            @endif
        </span>
    </a>
</div>
{{-- <li  style="width: 30px">
    <!-- mini-cart 2 -->
    <div class="mini-cart-icon mini-cart-icon-2">
        <a href="#ltn__utilize-cart-menu" class="ltn__utilize-toggle">
            <span class="mini-cart-icon">
                <i class="icon-shopping-cart"></i>
                <sup>2</sup>
            </span>
        </a>
    </div>
</li> --}}