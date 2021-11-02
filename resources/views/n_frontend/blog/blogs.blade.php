@extends('n_frontend.layouts.app')
@section('content')
<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="{{ static_asset('frontend/img/bg/14.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">{{translate('News Feeds')}}</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="{{route('home')}}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> {{translate('Home')}}</a></li>
                            <li>{{translate('Blogs')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMB AREA END -->

<!-- BLOG AREA START -->
<div class="ltn__blog-area mb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="ltn__blog-list-wrap">
                    <!-- Blog Item -->
                    @foreach ($blogs as $blog)
                    <div class="ltn__blog-item ltn__blog-item-5">
                        <div class="ltn__blog-img">
                            <a href="{{ url("blog").'/'. $blog->slug }}">
                                <img
                                    src="{{ uploaded_asset($blog->banner) }}"
                                    data-src="{{ uploaded_asset($blog->banner) }}"
                                    alt="{{ $blog->title }}"
                                    class="img-fluid lazyload "
                                >
                            </a>
                        </div>
                        <div class="ltn__blog-brief">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-category">
                                        <span>{{ $blog->category->category_name }}</span>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="ltn__blog-title"><a href="{{ url("blog").'/'. $blog->slug }}">{{ $blog->title }}</a></h3>
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li>
                                        <a href="#"><i class="far fa-eye"></i>{{ $blog->total_views }} {{translate('Views')}}</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="far fa-comments"></i>{{ \App\BlogComment::where('blog_id', $blog->id)->count() }} {{translate('Comments')}}</a>
                                    </li>
                                    <li class="ltn__blog-date">
                                        <i class="far fa-calendar-alt"></i>{{ date('d-m-Y', strtotime($blog->created_at))}}
                                    </li>
                                </ul>
                            </div>
                            <p>{{ $blog->short_description }}</p>
                            <div class="ltn__blog-meta-btn">
                                <div class="ltn__blog-meta">
                                    <ul>
                                        <li class="ltn__blog-author">
                                            {{-- <a href="#">By: {{ env('APP_NAME')}}</a> --}}
                                            {{-- <img src="img/blog/author.jpg" alt="#"> --}}
                                        </li>
                                    </ul>
                                </div>
                                <div class="ltn__blog-btn">
                                    <a href="{{ url("blog").'/'. $blog->slug }}"><i class="fas fa-arrow-right"></i>{{ translate('Read More') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!--  -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <aside class="sidebar-area blog-sidebar ltn__right-sidebar">
                    <div class="widget ltn__top-rated-product-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border-2">{{ translate('Top Rated Product')}}</h4>
                        <ul>
                            @foreach (filter_products(\App\Product::orderBy('num_of_sale', 'desc'))->limit(6)->get() as $key => $top_product)
                            <li>
                                <div class="top-rated-product-item clearfix">
                                    <div class="top-rated-product-img">
                                        <a href="{{ route('product', $top_product->slug) }}">
                                            <img src="{{ uploaded_asset($top_product->thumbnail_img) }}"
                                                 alt="{{ $top_product->getTranslation('name') }}"
                                                 onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                        </a>
                                    </div>
                                    <div class="top-rated-product-info">
                                        <div class="product-ratting">
                                            <ul>
                                                <li><i>{{ renderStarRating($top_product->rating) }}</i></li>
                                            </ul>
                                        </div>
                                        <h6><a href="{{ route('product', $top_product->slug) }}">{{ $top_product->getTranslation('name') }}</a></h6>
                                        <div class="product-price">
                                            <span>{{ home_discounted_base_price($top_product) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                    <!-- Menu Widget (Category) -->
                    <div class="widget ltn__menu-widget ltn__menu-widget-2--- ltn__menu-widget-2-color-2---">
                        <h4 class="ltn__widget-title ltn__widget-title-border-2">{{ translate('Top Categories')}}</h4>
                        <ul>
                            @foreach (\App\Category::where('parent_id', 0)->with('childrenCategories')->take(5)->get() as $category)
                                <li><a href="{{ route('products.category', $category->slug) }}">{{ $category->getTranslation('name') }}</a></li>
							@endforeach
                        </ul>
                    </div>
                    <!-- Popular Post Widget -->
                    <div class="widget ltn__popular-post-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border-2">{{ translate('Leatest Blogs')}}</h4>
                        <ul>
                            @foreach (\App\Blog::where('status', 1)->orderBy('created_at', 'desc')->take(5)->get() as $key => $blog)
                            <li>
                                <div class="popular-post-widget-item clearfix">
                                    <div class="popular-post-widget-img">
                                        <a href="{{ url("blog").'/'. $blog->slug }}">
                                            <img
                                                src="{{ uploaded_asset($blog->banner) }}"
                                                data-src="{{ uploaded_asset($blog->banner) }}"
                                                alt="{{ $blog->title }}"
                                            >
                                        </a>
                                    </div>
                                    <div class="popular-post-widget-brief">
                                        <h6><a href="{{ url("blog").'/'. $blog->slug }}">{{ $blog->title }}</a></h6>
                                        <div class="ltn__blog-meta">
                                            <ul>
                                                <li class="ltn__blog-date">
                                                    <a href="#"><i class="far fa-calendar-alt"></i>{{ date('d-m-Y', strtotime($blog->created_at)) }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Popular Post Widget (Twitter Post) -->
                    {{-- <div class="widget ltn__popular-post-widget ltn__twitter-post-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border-2">Twitter Feeds</h4>
                        <ul>
                            <li>
                                <div class="popular-post-widget-item clearfix">
                                    <div class="popular-post-widget-img">
                                        <a href="blog-details.html"><i class="fab fa-twitter"></i></a>
                                    </div>
                                    <div class="popular-post-widget-brief">
                                        <p>Carsafe - #Gutenberg ready
                                            @wordpress
                                             Theme for Car Service, Auto Parts, Car Dealer available on
                                            @website
                                            <a href="https://website.net">https://website.net</a></p>
                                        <div class="ltn__blog-meta">
                                            <ul>
                                                <li class="ltn__blog-date">
                                                    <a href="#"><i class="far fa-calendar-alt"></i>June 22, 2020</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="popular-post-widget-item clearfix">
                                    <div class="popular-post-widget-img">
                                        <a href="blog-details.html"><i class="fab fa-twitter"></i></a>
                                    </div>
                                    <div class="popular-post-widget-brief">
                                        <p>Carsafe - #Gutenberg ready
                                            @wordpress
                                             Theme for Car Service, Auto Parts, Car Dealer available on
                                            @website
                                            <a href="https://website.net">https://website.net</a></p>
                                        <div class="ltn__blog-meta">
                                            <ul>
                                                <li class="ltn__blog-date">
                                                    <a href="#"><i class="far fa-calendar-alt"></i>June 22, 2020</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="popular-post-widget-item clearfix">
                                    <div class="popular-post-widget-img">
                                        <a href="blog-details.html"><i class="fab fa-twitter"></i></a>
                                    </div>
                                    <div class="popular-post-widget-brief">
                                        <p>Carsafe - #Gutenberg ready
                                            @wordpress
                                             Theme for Car Service, Auto Parts, Car Dealer available on
                                            @website
                                            <a href="https://website.net">https://website.net</a></p>
                                        <div class="ltn__blog-me ta">
                                            <ul>
                                                <li class="ltn__blog-date">
                                                    <a href="#"><i class="far fa-calendar-alt"></i>June 22, 2020</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div> --}}
                    <!-- Social Media Widget -->
                    <div class="widget ltn__social-media-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border-2">Follow us</h4>
                        <div class="ltn__social-media-2">
                            <ul>
                                @if ( get_setting('facebook_link') !=  null )
                                    <li><a href="{{ get_setting('facebook_link') }}" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                @endif
                                @if ( get_setting('twitter_link') !=  null )
                                    <li><a href="{{ get_setting('twitter_link') }}" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                @endif
                                @if ( get_setting('instagram_link') !=  null )
                                    <li><a href="{{ get_setting('instagram_link') }}" target="_blank" title="instagram"><i class="fa fa-instagram"></i></a></li>
                                @endif
                                @if ( get_setting('youtube_link') !=  null )
                                    <li><a href="{{ get_setting('youtube_link') }}" target="_blank" title="youtube"><i class="fa fa-youtube"></i></a></li>
                                @endif
                                @if ( get_setting('linkedin_link') !=  null )
                                    <li><a href="{{ get_setting('linkedin_link') }}" target="_blank" title="linkedin"><i class="fa fa-linkedin-in"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <!-- Tagcloud Widget -->
                    {{-- <div class="widget ltn__tagcloud-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border-2">Popular Tags</h4>
                        <ul>
                            <li><a href="#">Popular</a></li>
                            <li><a href="#">desgin</a></li>
                            <li><a href="#">ux</a></li>
                            <li><a href="#">usability</a></li>
                            <li><a href="#">develop</a></li>
                            <li><a href="#">icon</a></li>
                            <li><a href="#">Car</a></li>
                            <li><a href="#">Service</a></li>
                            <li><a href="#">Repairs</a></li>
                            <li><a href="#">Auto Parts</a></li>
                            <li><a href="#">Oil</a></li>
                            <li><a href="#">Dealer</a></li>
                            <li><a href="#">Oil Change</a></li>
                            <li><a href="#">Body Color</a></li>
                        </ul>
                    </div> --}}
                    <!-- Banner Widget -->
                    {{-- <div class="widget ltn__banner-widget d-none">
                        <a href="shop.html"><img src="img/banner/2.jpg" alt="#"></a>
                    </div> --}}
                    <!-- Instagram Widget -->
                    {{-- <div class="widget ltn__instagram-widget d-none">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Instagram Feeds</h4>
                        <div class="ltn__instafeed ltn__instafeed-grid insta-grid-gutter"></div>
                    </div> --}}
                </aside>
            </div>
        </div>
    </div>
</div>
<!-- BLOG AREA END -->
@endsection
