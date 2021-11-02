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

<div class="mini-cart-icon mini-cart-icon-2">
    {{-- <a href="javascript:void(0)" class="d-flex align-items-center text-reset h-100" data-toggle="dropdown" data-display="static">
        <i class="la la-shopping-cart la-2x opacity-80"></i>
        <span class="flex-grow-1 ml-1">
            @if(isset($cart) && count($cart) > 0)
                <span class="badge badge-primary badge-inline badge-pill cart-count">
                    {{ count($cart)}}
                </span>
            @else
                <span class="badge badge-primary badge-inline badge-pill cart-count">0</span>
            @endif
            <span class="nav-box-text d-none d-xl-block opacity-70">{{translate('Cart')}}</span>
        </span>
    </a> --}}
    <a href="#ltn__utilize-cart-menu" class="ltn__utilize-toggle">
        <span class="mini-cart-icon">
            <i class="icon-shopping-cart"></i>
            @if(isset($cart) && count($cart) > 0)
                <sup>{{ count($cart)}}</sup>
            @else
            <sup>0</sup>
            @endif
        </span>
        {{-- <h6><span>Your Cart</span> <span class="ltn__secondary-color">$89.25</span></h6> --}}
    </a>
</div>

   <!-- Utilize Cart Menu Start -->
   <div id="ltn__utilize-cart-menu" class="ltn__utilize ltn__utilize-cart-menu">
    <div class="ltn__utilize-menu-inner ltn__scrollbar">
        <div class="ltn__utilize-menu-head">
            <span class="ltn__utilize-menu-title">Cart</span>
            <button class="ltn__utilize-close">×</button>
        </div>
        <div class="mini-cart-product-area ltn__scrollbar">
            <div class="mini-cart-item clearfix">
                <div class="mini-cart-img">
                    <a href="#"><img src="{{ asset('public/frontend/img/product/1.png') }}" alt="Image"></a>
                    <span class="mini-cart-item-delete"><i class="icon-cancel"></i></span>
                </div>
                <div class="mini-cart-info">
                    <h6><a href="#">Antiseptic Spray</a></h6>
                    <span class="mini-cart-quantity">1 x $65.00</span>
                </div>
            </div>
            <div class="mini-cart-item clearfix">
                <div class="mini-cart-img">
                    <a href="#"><img src="{{ asset('public/frontend/img/product-2/2.png') }}" alt="Image"></a>
                    <span class="mini-cart-item-delete"><i class="icon-cancel"></i></span>
                </div>
                <div class="mini-cart-info">
                    <h6><a href="#">Digital Stethoscope</a></h6>
                    <span class="mini-cart-quantity">1 x $85.00</span>
                </div>
            </div>
            <div class="mini-cart-item clearfix">
                <div class="mini-cart-img">
                    <a href="#"><img src="{{ asset('public/frontend/img/product/3.png') }}" alt="Image"></a>
                    <span class="mini-cart-item-delete"><i class="icon-cancel"></i></span>
                </div>
                <div class="mini-cart-info">
                    <h6><a href="#">Cosmetic Containers</a></h6>
                    <span class="mini-cart-quantity">1 x $92.00</span>
                </div>
            </div>
            <div class="mini-cart-item clearfix">
                <div class="mini-cart-img">
                    <a href="#"><img src="{{ asset('public/frontend/img/product/4.png') }}" alt="Image"></a>
                    <span class="mini-cart-item-delete"><i class="icon-cancel"></i></span>
                </div>
                <div class="mini-cart-info">
                    <h6><a href="#">Thermometer Gun</a></h6>
                    <span class="mini-cart-quantity">1 x $68.00</span>
                </div>
            </div>
        </div>
        <div class="mini-cart-footer">
            <div class="mini-cart-sub-total">
                <h5>Subtotal: <span>$310.00</span></h5>
            </div>
            <div class="btn-wrapper">
                <a href="cart.html" class="theme-btn-1 btn btn-effect-1">View Cart</a>
                <a href="cart.html" class="theme-btn-2 btn btn-effect-2">Checkout</a>
            </div>
            <p>Free Shipping on All Orders Over $100!</p>
        </div>

    </div>
</div>
<!-- Utilize Cart Menu End -->

<!-- Utilize Mobile Menu Start -->
<div id="ltn__utilize-mobile-menu" class="ltn__utilize ltn__utilize-mobile-menu">
    <div class="ltn__utilize-menu-inner ltn__scrollbar">
        <div class="ltn__utilize-menu-head">
            <div class="site-logo">
                <a href="{{route('home')}}"><img src="{{ asset('public/frontend/img/logo.png') }}" alt="Logo"></a>
            </div>
            <button class="ltn__utilize-close">×</button>
        </div>
        <div class="ltn__utilize-menu-search-form">
            <form action="#">
                <input type="text" placeholder="Search...">
                <button><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="ltn__utilize-menu">
            <ul>
                <li>
                    <a href="{{route('home')}}">{{translate('Home')}}</a>
                </li>
                <li>
                    <a href="#">{{translate('Products')}}</a>
                </li>
                <li><a href="#">{{translate('Categories')}}</a>
                    <ul class="sub-menu" style="max-height: 400px;">
                        @php
                            $categories = \App\Category::where('parent_id', 0)->get();
                        @endphp
                        @foreach($categories as $category)
                            <li><a href="#">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="#">{{translate('Blogs')}}</a>
                </li>
                <li><a href="#">{{translate('Contact')}}</a></li>
            </ul>
        </div>
        <div class="ltn__utilize-buttons ltn__utilize-buttons-2">
            <ul>
                @auth
                    @if(isAdmin())
                    <li><a title="My Account" href="{{ route('admin.dashboard') }}">
                        <span class="utilize-btn-icon">
                            <i class="far fa-user"></i>
                        </span>{{translate('My Account')}}</a></li>
                    @else
                    <li><a title="My Account" href="{{ route('dashboard') }}">
                        <span class="utilize-btn-icon">
                            <i class="far fa-user"></i>
                        </span>{{translate('My Account')}}</a></li>
                    <li><a href="#">
                        <span class="utilize-btn-icon">
                            <i class="far fa-heart"></i>
                            <sup>3</sup>
                        </span>
                        {{translate('Wishlist')}}</a></li>
                    @endif
                    <li><a href="{{ route('dashboard') }}">{{translate('Logout')}}</a></li>
                @else
                <li>
                    <a href="cart.html" title="Shoping Cart">
                        <span class="utilize-btn-icon">
                            <i class="fas fa-shopping-cart"></i>
                            <sup>5</sup>
                        </span>
                        {{translate('Shoping Cart')}}
                    </a>
                </li>
                <li>
                    <a href="wishlist.html" title="Wishlist">
                        <span class="utilize-btn-icon">
                            <i class="far fa-heart"></i>
                            <sup>3</sup>
                        </span>
                        {{translate('Wishlist')}}
                    </a>
                </li>
                <li><a href="{{ route('user.login') }}">{{translate('Sign in')}}</a></li>
                <li><a href="{{ route('user.registration') }}">{{translate('Register')}}</a></li>
                @endauth
                {{-- <li>
                    <a href="{{ route('dashboard') }}" title="My Account">
                        <span class="utilize-btn-icon">
                            <i class="far fa-user"></i>
                        </span>
                        {{translate('My Account')}}
                    </a>
                </li>
                <li>
                    <a href="wishlist.html" title="Wishlist">
                        <span class="utilize-btn-icon">
                            <i class="far fa-heart"></i>
                            <sup>3</sup>
                        </span>
                        {{translate('Wishlist')}}
                    </a>
                </li>
                <li>
                    <a href="cart.html" title="Shoping Cart">
                        <span class="utilize-btn-icon">
                            <i class="fas fa-shopping-cart"></i>
                            <sup>5</sup>
                        </span>
                        {{translate('Shoping Cart')}}
                    </a>
                </li> --}}
            </ul>
        </div>
        <div class="ltn__social-media-2">
            <ul>
                <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Utilize Mobile Menu End -->

    <div class="ltn__utilize-overlay"></div>