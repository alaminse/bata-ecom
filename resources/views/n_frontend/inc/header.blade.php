<!-- Utilize Mobile Menu Start -->
<div id="ltn__utilize-mobile-menu" class="ltn__utilize ltn__utilize-mobile-menu">
    <div class="ltn__utilize-menu-inner ltn__scrollbar">
        <div class="ltn__utilize-menu-head">
            <div class="site-logo">
                @php
                    $header_logo = get_setting('header_logo');
                @endphp
                @if($header_logo != null)
                    <a href="{{route('home')}}"><img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}"></a>
                @else
                    <a href="{{route('home')}}"><img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}"></a>
                @endif
            </div>
            <button class="ltn__utilize-close">×</button>
        </div>
        <div class="ltn__utilize-menu-search-form">
            <form action="#" method="get" id="#">
                <input type="text" name="search" value="" placeholder="Search...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="ltn__utilize-menu">
            <ul>
                <li>
                    <a href="{{route('home')}}">{{translate('Home')}}</a>
                </li>
                <li>
                    <a href="{{ route('all.products') }}">{{translate('Products')}}</a>
                </li>
                <li><a href="#">{{translate('Categories')}}</a>
                    <ul class="sub-menu">
                        @php
                            $categories = \App\Category::where('parent_id', 0)->get();
                        @endphp
                        @foreach($categories as $category)
                            <li><a href="{{ route('all.products',['category_slug'=>$category->slug]) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="{{ route('blog') }}">{{translate('Blogs')}}</a>
                </li>
                <li>
                    <a href="{{ route('contact.create') }}">{{translate('Contact')}}</a>
                </li>
            </ul>
        </div>
        <div class="ltn__utilize-buttons ltn__utilize-buttons-2">
            <ul>
                @auth
                    @if(isAdmin())
                        <li>
                            <a href="{{ route('admin.dashboard') }}" title="My Account">
                                    <span class="utilize-btn-icon">
                                        <i class="far fa-user"></i>
                                    </span>
                                {{ translate('My Account') }}
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('dashboard') }}" title="My Account">
                                    <span class="utilize-btn-icon">
                                        <i class="far fa-user"></i>
                                    </span>
                                {{ translate('My Account') }}
                            </a>
                        </li>
                    @endif
                @else
                    <li>
                        <a href="{{ route('user.login') }}" title="My Account">
                                    <span class="utilize-btn-icon">
                                        <i class="far fa-user"></i>
                                    </span>
                            {{ translate('Login') }}
                        </a>
                    </li>
                @endauth
                <li>
                    <a href="{{ route('wishlists.index') }}" title="Wishlist">
                            <span class="utilize-btn-icon">
                                <i class="far fa-heart"></i>
                                @if(Auth::check())
                                    <sup>{{ count(Auth::user()->wishlists)}}</sup>
                                @else
                                    <sup>0</sup>
                                @endif
                            </span>
                        {{ translate('Wishlist') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('cart') }}" title="Shoping Cart">
                            <span class="utilize-btn-icon">
                                <i class="fas fa-shopping-cart"></i>
                                @if(isset($cart) && count($cart) > 0)
                                    <sup>{{ count($cart)}}</sup>
                                @else
                                    <sup>0</sup>
                                @endif
                            </span>
                        {{ translate('Shoping Cart') }}
                    </a>
                </li>
            </ul>
        </div>
        <div class="ltn__social-media-2">
            <ul>
                @if ( get_setting('facebook_link') !=  null )
                    <li>
                        <a href="{{ get_setting('facebook_link') }}" title="Facebook" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                @endif
                @if ( get_setting('twitter_link') !=  null )
                    <li>
                        <a href="{{ get_setting('twitter_link') }}" title="Twitter" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                @endif
                @if ( get_setting('instagram_link') !=  null )
                    <li>
                        <a href="{{ get_setting('instagram_link') }}" title="Instagram" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                @endif
                @if ( get_setting('linkedin_link') !=  null )
                    <li>
                        <a href="{{ get_setting('linkedin_link') }}" title="LinkedIn" target="_blank">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- Utilize Mobile Menu End -->

<div class="ltn__utilize-overlay"></div>
    <!-- HEADER AREA START (header-3) -->
    <header class="ltn__header-area ltn__header-3">       
        <!-- ltn__header-top-area start -->
        <div class="ltn__header-top-area border-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="ltn__top-bar-menu">
                            <ul>
                                <li><a href="mailto:info@webmail.com?Subject=Flower%20greetings%20to%20you"><i class="icon-mail"></i> info@webmail.com</a></li>
                                <li><a href="javascript:void(0)"><i class="icon-placeholder"></i> 15/A, Nest Tower, NYC</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="top-bar-right text-right text-end">
                            <div class="ltn__top-bar-menu">
                                <ul>
                                    <li>
                                        <!-- ltn__language-menu -->
                                        <div class="ltn__drop-menu ltn__currency-menu ltn__language-menu">
                                            <ul>
                                                <li><a href="javascript:void(0)" class="{{-- dropdown-toggle --}}"><span class="active-currency">{{translate('English')}}</span></a>
                                                    {{-- <ul>
                                                        <li><a href="#">Arabic</a></li>
                                                        <li><a href="#">Bengali</a></li>
                                                        <li><a href="#">Chinese</a></li>
                                                        <li><a href="#">English</a></li>
                                                        <li><a href="#">French</a></li>
                                                        <li><a href="#">Hindi</a></li>
                                                    </ul> --}}
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <!-- ltn__social-media -->
                                        <div class="ltn__social-media">
                                            <ul>
                                                @if ( get_setting('facebook_link') !=  null )
                                                    <li>
                                                        <a href="{{ get_setting('facebook_link') }}" title="Facebook" target="_blank">
                                                            <i class="fab fa-facebook-f"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if ( get_setting('twitter_link') !=  null )
                                                <li>
                                                    <a href="{{ get_setting('twitter_link') }}" title="Twitter" target="_blank">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                                @endif
                                                @if ( get_setting('instagram_link') !=  null )
                                                    <li>
                                                        <a href="{{ get_setting('instagram_link') }}" title="Instagram" target="_blank">
                                                            <i class="fab fa-instagram"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if ( get_setting('linkedin_link') !=  null )
                                                    <li>
                                                        <a href="{{ get_setting('linkedin_link') }}" title="LinkedIn" target="_blank">
                                                            <i class="fab fa-linkedin"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ltn__header-top-area end --> 
        <!-- ltn__header-middle-area start -->
        <div class="ltn__header-middle-area">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="site-logo">
                            @php
                                $header_logo = get_setting('header_logo');
                            @endphp
                            @if($header_logo != null)
                                <a href="{{route('home')}}"><img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}"></a>
                            @else
                                <a href="{{route('home')}}"><img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}"></a>
                            @endif
                        </div>
                    </div>
                    <div class="col header-contact-serarch-column d-none d-lg-block">
                        <div class="header-contact-search">
                            <!-- header-feature-item -->
                            <div class="header-feature-item">
                                <div class="header-feature-icon">
                                    <i class="icon-call"></i>
                                </div>
                                <div class="header-feature-info">
                                    <h6>{{translate('Phone')}}</h6>
                                    <p><a href="tel:0123456789">+0123-456-789</a></p>
                                </div>
                            </div>
                            <div class="d-lg-none ml-auto mr-0">
                                <a class="p-2 d-block text-reset" href="javascript:void(0);" data-toggle="class-toggle" data-target=".front-header-search">
                                    <i class="las la-search la-flip-horizontal la-2x"></i>
                                </a>
                            </div>
            
                            <!-- header-search-2 -->
                            <div class="header-search-2">
                                <form action="{{ route('search') }}" method="GET" class="stop-propagation">
                                    <input type="text" class="border-0 border-lg form-control" id="search" name="q" placeholder="{{translate('Search here...')}}" autocomplete="off">
                                    <button type="submit">
                                        <span><i class="icon-search"></i></span>
                                    </button>
                                </form>
                                
                                <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute top-100 overflow-auto" style="max-height: 400px; width: 42%;">
                                    <div class="search-preloader absolute-top-center">
                                        <div class="dot-loader"><div></div><div></div><div></div></div>
                                    </div>
                                    <div class="search-nothing d-none p-3 text-center fs-16">
        
                                    </div>
                                    <div id="search-content" class="text-left">
        
                                    </div>
                                </div>
                                <div class="d-none d-lg-none ml-3 mr-0">
                                    <div class="nav-search-box">
                                        <a href="javascript:void(0)" class="nav-box-link">
                                            <i class="la la-search la-flip-horizontal d-inline-block nav-box-icon"></i>
                                        </a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <!-- header-options -->
                        <div class="ltn__header-options">
                            <ul>
                                {{-- <li class="d-none">
                                    <!-- ltn__currency-menu -->
                                    <div class="ltn__drop-menu ltn__currency-menu">
                                        <ul>
                                            <li><a href="#" class="dropdown-toggle"><span class="active-currency">USD</span></a>
                                                <ul>
                                                    <li><a href="login.html">USD - US Dollar</a></li>
                                                    <li><a href="wishlist.html">CAD - Canada Dollar</a></li>
                                                    <li><a href="register.html">EUR - Euro</a></li>
                                                    <li><a href="account.html">GBP - British Pound</a></li>
                                                    <li><a href="wishlist.html">INR - Indian Rupee</a></li>
                                                    <li><a href="wishlist.html">BDT - Bangladesh Taka</a></li>
                                                    <li><a href="wishlist.html">JPY - Japan Yen</a></li>
                                                    <li><a href="wishlist.html">AUD - Australian Dollar</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </li> --}}
                                <li class="d-lg-none">
                                    <!-- header-search-1 -->
                                    <div class="header-search-wrap">
                                        <div class="header-search-1">
                                            <div class="search-icon">
                                                <i class="icon-search  for-search-show"></i>
                                                <i class="icon-cancel  for-search-close"></i>
                                            </div>
                                        </div>
                                        <div class="header-search-1-form">
                                            <form id="#" method="get"  action="#">
                                                <input type="text" name="search" value="" placeholder="Search here..."/>
                                                <button type="submit">
                                                    <span><i class="icon-search"></i></span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-none---"> 
                                    <!-- user-menu -->
                                    <div class="ltn__drop-menu user-menu">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0)"><i class="icon-user"></i></a>
                                                <ul>
                                                @auth
                                                    @if(isAdmin())
                                                        <li><a href="{{ route('admin.dashboard') }}">{{translate('My Account')}}</a></li>
                                                    @else
                                                    <li><a href="{{ route('dashboard') }}">{{translate('My Account')}}</a></li>
                                                    <li><a href="{{ URL::to('/wishlists') }}">{{translate('Wishlist')}}</a></li>
                                                    @endif
                                                    <li><a href="{{ route('logout') }}">{{translate('Logout')}}</a></li>
                                                @else
                                                <li><a href="{{ route('user.login') }}">{{translate('Sign in')}}</a></li>
                                                <li><a href="{{ route('user.registration') }}">{{translate('Register')}}</a></li>
                                                @endauth
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li id="wishlist" style="width: 30px">
                                    @include('n_frontend.partials.wishlist')
                                </li>
                                <li id="cart_items" style="width: 30px">
                                    @include('n_frontend.partials.cart')
                                </li>
                                {{-- <li class="d-none---"> 
                                    <!-- user-menu -->
                                    <div class="ltn__drop-menu user-menu">
                                        <ul>
                                            <li>
                                                <a href="#"><i class="icon-user"></i></a>
                                                <ul>
                                                @auth
                                                    @if(isAdmin())
                                                        <li><a href="{{ route('admin.dashboard') }}">{{translate('My Account')}}</a></li>
                                                    @else
                                                    <li><a href="{{ route('dashboard') }}">{{translate('My Account')}}</a></li>
                                                    <li><a href="{{ URL::to('/wishlists') }}">{{translate('Wishlist')}}</a></li>
                                                    @endif
                                                    <li><a href="{{ route('logout') }}">{{translate('Logout')}}</a></li>
                                                @else
                                                <li><a href="{{ route('user.login') }}">{{translate('Sign in')}}</a></li>
                                                <li><a href="{{ route('user.registration') }}">{{translate('Register')}}</a></li>
                                                @endauth
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li id="wishlist" style="width: 30px">
                                    @include('n_frontend.partials.wishlist')
                                </li>
                                <li id="cart_items" style="width: 30px">
                                    @include('n_frontend.partials.cart')
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ltn__header-middle-area end -->
        <!-- header-bottom-area start -->
        <div class="header-bottom-area ltn__border-top ltn__header-sticky  ltn__sticky-bg-white--- ltn__sticky-bg-secondary ltn__secondary-bg section-bg-1 menu-color-white d-none d-lg-block">
            <div class="container">
                <div class="row">
                    <div class="col header-menu-column justify-content-center">
                        <div class="sticky-logo">
                            <div class="site-logo">
                                @php
                                    $header_logo = get_setting('header_logo');
                                @endphp
                                @if($header_logo != null)
                                    <a href="{{route('home')}}"><img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}"></a>
                                @else
                                    <a href="{{route('home')}}"><img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}"></a>
                                @endif
                            </div>
                        </div>
                        <div class="header-menu header-menu-2">
                            <nav>
                                <div class="ltn__main-menu">
                                    <ul>
                                        <li>
                                            <a href="{{route('home')}}">{{translate('Home')}}</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('all.products') }}">{{translate('Products')}}</a>
                                        </li>
                                        <li><a href="javascript:void(0)">{{translate('Categories')}}</a>
                                            <ul class="overflow-auto 
                                            " style="max-height: 400px;">
                                                @php
                                                    $categories = \App\Category::where('parent_id', 0)->get();
                                                @endphp
                                                @foreach($categories as $category)
                                                    <li><a href="{{ route('all.products',['category_slug'=>$category->slug]) }}">{{ $category->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="{{ route('blog') }}">{{translate('Blogs')}}</a>
                                        </li>
                                        <li><a href="{{ route('contact.create') }}">{{translate('Contact')}}</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header-bottom-area end -->
    </header>
    <!-- HEADER AREA END -->

    <!-- MOBILE MENU START -->
    <div class="mobile-header-menu-fullwidth mb-30 d-block d-lg-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Mobile Menu Button -->
                    <div class="mobile-menu-toggle d-lg-none">
                        <span>{{translate('MENU')}}</span>
                        <a href="#ltn__utilize-mobile-menu" class="ltn__utilize-toggle">
                            <svg viewBox="0 0 800 600">
                                <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                                <path d="M300,320 L540,320" id="middle"></path>
                                <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MOBILE MENU END -->