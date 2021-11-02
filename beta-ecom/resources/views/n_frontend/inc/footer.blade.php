 <!-- CALL TO ACTION START (call-to-action-6) -->
 <div class="ltn__call-to-action-area call-to-action-6 before-bg-bottom" data-bs-bg="img/1.jpg--">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="call-to-action-inner call-to-action-inner-6 ltn__secondary-bg position-relative text-center---">
                    <div class="coll-to-info text-color-white">
                        <h1>Buy medical disposable face mask <br> to protect your loved ones</h1>
                    </div>
                    <div class="btn-wrapper">
                        <a class="btn btn-effect-3 btn-white" href="{{ route('all.products') }}">Explore Products <i class="icon-next"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CALL TO ACTION END -->
 
 <!-- FOOTER AREA START -->
 <footer class="ltn__footer-area  ">
    <div class="footer-top-area  section-bg-2 plr--5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-about-widget">
                        <div class="footer-logo">
                            <div class="site-logo">
                                <a href="{{ route('home') }}">
                                    @if(get_setting('footer_logo') != null)
                                    <img class="lazyload" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset(get_setting('footer_logo')) }}" alt="{{ env('APP_NAME') }}" height="44">
                                @else
                                    <img class="lazyload" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" height="44">
                                @endif
                                </a>
                            </div>
                        </div>
                        <p>{{ translate('Lorem Ipsum is simply dummy text of the and typesetting industry. Lorem Ipsum is dummy text of the printing.') }}</p>
                        <div class="footer-address">
                            <ul>
                                <li>
                                    <div class="footer-address-icon">
                                        <i class="icon-placeholder"></i>
                                    </div>
                                    <div class="footer-address-info">
                                        <p>{{ get_setting('contact_address',null,App::getLocale()) }}</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="footer-address-icon">
                                        <i class="icon-call"></i>
                                    </div>
                                    <div class="footer-address-info">
                                        <p><a href="{{ get_setting('contact_phone') }}">{{ get_setting('contact_phone') }}</a></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="footer-address-icon">
                                        <i class="icon-mail"></i>
                                    </div>
                                    <div class="footer-address-info">
                                        <p><a href="mailto:{{ get_setting('contact_email') }}">{{ get_setting('contact_email')  }}</a></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="ltn__social-media mt-20">
                            <ul>
                                @if ( get_setting('facebook_link') !=  null )
                                <li>
                                    <a href="{{ get_setting('facebook_link') }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                @endif
                                @if ( get_setting('twitter_link') !=  null )
                                <li>
                                    <a href="{{ get_setting('twitter_link') }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                </li>
                                @endif
                                @if ( get_setting('instagram_link') !=  null )
                                <li>
                                    <a href="{{ get_setting('instagram_link') }}" target="_blank"><i class="fab fa-instagram"></i></a>
                                </li>
                                @endif
                                @if ( get_setting('youtube_link') !=  null )
                                <li>
                                    <a href="{{ get_setting('youtube_link') }}" target="_blank"><i class="fab fa-youtube"></i></a>
                                </li>
                                @endif
                                @if ( get_setting('linkedin_link') !=  null )
                                <li>
                                    <a href="{{ get_setting('linkedin_link') }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-menu-widget clearfix">
                        <h4 class="footer-title">
                            {{ get_setting('widget_one',null,App::getLocale()) }}
                        </h4>
                        <div class="footer-menu">
                            <ul>
                                @if ( get_setting('widget_one_labels',null,App::getLocale()) !=  null )
                                    @foreach (json_decode( get_setting('widget_one_labels',null,App::getLocale()), true) as $key => $value)
                                    <li>
                                        <a href="{{ json_decode( get_setting('widget_one_links'), true)[$key] }}">
                                            {{ $value }}
                                        </a>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        {{-- <h4 class="footer-title">Services</h4>
                        <div class="footer-menu">
                            <ul>
                                <li><a href="order-tracking.html">Order tracking</a></li>
                                <li><a href="wishlist.html">Wish List</a></li>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="account.html">My account</a></li>
                                <li><a href="about.html">Terms & Conditions</a></li>
                                <li><a href="about.html">Promotional Offers</a></li>
                            </ul>
                        </div> --}}
                    </div>
                    {{-- <div class="footer-widget footer-menu-widget clearfix">
                        <h4 class="footer-title">Company</h4>
                        <div class="footer-menu">
                            <ul>
                                <li><a href="about.html">About</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="shop.html">All Products</a></li>
                                <li><a href="locations.html">Locations Map</a></li>
                                <li><a href="faq.html">FAQ</a></li>
                                <li><a href="contact.html">Contact us</a></li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
                <div class="col-xl-3 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-menu-widget clearfix">
                        <h4 class="footer-title">
                            {{ translate('My Account') }}
                        </h4>
                        <div class="footer-menu">
                            <ul>
                                @if (Auth::check())
                                    <li>
                                        <a href="{{ route('logout') }}">
                                            {{ translate('Logout') }}
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('user.login') }}">
                                            {{ translate('Login') }}
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ route('dashboard') }}">
                                        {{ translate('Order History') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('wishlists.index') }}">
                                        {{ translate('My Wishlist') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('orders.track') }}">
                                        {{ translate('Track Order') }}
                                    </a>
                                </li>
                                @if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated)
                                    <li>
                                        <a href="{{ route('affiliate.apply') }}">{{ translate('Be an affiliate partner')}}</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    {{-- @if (get_setting('vendor_system_activation') == 1)
                        <div class="footer-widget footer-menu-widget clearfix">
                            <h4 class="footer-title">
                                {{ translate('Be a Seller') }}
                            </h4>
                            <ul>
                                <li><a href="{{ route('shops.create') }}">
                                    {{ translate('Apply Now') }}
                                </a></li>
                            </ul>
                        </div>
                    @endif --}}
                    {{-- <div class="footer-widget footer-menu-widget clearfix">
                        <h4 class="footer-title">Customer Care</h4>
                        <div class="footer-menu">
                            <ul>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="account.html">My account</a></li>
                                <li><a href="wishlist.html">Wish List</a></li>
                                <li><a href="order-tracking.html">Order tracking</a></li>
                                <li><a href="faq.html">FAQ</a></li>
                                <li><a href="contact.html">Contact us</a></li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
                <div class="col-xl-3 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-menu-widget clearfix">
                        <div class="footer-widget footer-newsletter-widget">
                            <h4 class="footer-title">{{ translate('Newsletter') }}</h4>
                            <p>{{ translate('Subscribe to our weekly Newsletter and receive updates via email.') }}</p>
                            <div class="footer-newsletter">
                                <form method="POST" action="{{ route('subscribers.store') }}">
                                    @csrf
                                    <input type="email" placeholder="{{ translate('Your Email Address') }}" name="email" required>
                                    <div class="btn-wrapper">
                                        <button class="theme-btn-1 btn" type="submit"><i class="fas fa-location-arrow"></i></button>
                                    </div>
                                </form>
                            </div>
                            <h5 class="mt-30">{{ translate('We Accept') }}</h5>
                            @if ( get_setting('payment_method_images') !=  null )
                                @foreach (explode(',', get_setting('payment_method_images')) as $key => $value)
                                    <img src="{{ uploaded_asset($value) }}" alt="{{ translate('Payment Image')}}">
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ltn__copyright-area ltn__copyright-2 section-bg-7  plr--5">
        <div class="container-fluid ltn__border-top-2">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="ltn__copyright-design clearfix">
                        <p>{!! get_setting('frontend_copyright_text',null,App::getLocale()) !!} <span class="current-year"></span></p>
                    </div>
                </div>
                <div class="col-md-6 col-12 align-self-center">
                    <div class="ltn__copyright-menu text-end">
                        <ul>
                            <li><a href="{{ route('terms') }}">Terms & Conditions</a></li>
                            <li><a href="#">Claim</a></li>
                            <li><a href="{{ route('privacypolicy') }}">Privacy & Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- FOOTER AREA END -->