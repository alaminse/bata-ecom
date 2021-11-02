@extends('n_frontend.layouts.app')

@section('meta_title'){{ $blog->meta_title }}@stop

@section('meta_description'){{ $blog->meta_description }}@stop

@section('meta_keywords'){{ $blog->meta_keywords }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $blog->meta_title }}">
    <meta itemprop="description" content="{{ $blog->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($blog->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $blog->meta_title }}">
    <meta name="twitter:description" content="{{ $blog->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($blog->meta_img) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $blog->meta_title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('blog', $blog->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($blog->meta_img) }}" />
    <meta property="og:description" content="{{ $blog->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
@endsection

@section('content')

<div class="ltn__page-details-area ltn__blog-details-area mb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="ltn__blog-details-wrap">
                    <div class="ltn__page-details-inner ltn__blog-details-inner">
                        <div class="ltn__blog-meta">
                            <ul>
                                <li class="ltn__blog-category">
                                    <a href="javascript:void(0)">{{ $blog->category->category_name }}</a>
                                </li>
                            </ul>
                        </div>
                        <h2 class="ltn__blog-title">
                            {{ $blog->title }}
                        </h2>
                        <div class="ltn__blog-meta">
                            <ul>
                                <li class="ltn__blog-author">
                                    <a href="javascript:void(0)">By: {{ env('APP_NAME')}}</a>
                                </li>
                                <li class="ltn__blog-date">
                                    <i class="far fa-calendar-alt"></i>{{ date('d-m-Y', strtotime($blog->created_at)) }}
                                </li>
                                {{-- <li>
                                    <a href="#"><i class="far fa-comments"></i>35 Comments</a>
                                </li> --}}
                            </ul>
                        </div>
                        <p>{!! $blog->description !!}</p>
                        <img
                            src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                            data-src="{{ uploaded_asset($blog->banner) }}"
                            alt="{{ $blog->title }}"
                            class="img-fluid lazyload w-100"
                        >
                    </div>
                    <!-- blog-tags-social-media -->
                     <div class="ltn__blog-tags-social-media mt-80 row">
                        <div class="ltn__tagcloud-widget col-lg-8">
                            {{--<h4>Releted Tags</h4>--}}
                            {{--<ul>--}}
                                {{--<li>--}}
                                    {{--<a href="#">Popular</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#">Business</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#">ux</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        </div>
                        <div class="ltn__social-media text-right text-end col-lg-4">
                            <h4>Social Share</h4>
                            <ul>
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" title="Facebook" target="_blank">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}" title="Twitter" target="_blank">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}" title="Linkedin" target="_blank">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <!-- prev-next-btn -->
                    @php
                        $pre = \App\Blog::where('id','<', $blog->id)->first();
                        $next = \App\Blog::where('id','>', $blog->id)->first();
                    @endphp
                    <div class="ltn__prev-next-btn row mb-50">
                        @if($pre != null)
                        <div class="blog-prev col-lg-6">
                            <h6>{{ translate('Prev Post') }}</h6>
                            <h3 class="ltn__blog-title"><a href="{{ url("blog").'/'. $pre->slug }}">{{ $pre->title }}</a></h3>
                        </div>
                        @else
                        <div class="blog-prev col-lg-6">
                            <h6> </h6>
                        </div>
                        @endif
                        @if($next != null)
                        <div class="blog-prev blog-next text-right text-end col-lg-6">
                            <h6>{{ translate('Next Post') }}</h6>
                            <h3 class="ltn__blog-title"><a href="{{ url("blog").'/'. $next->slug }}">{{ $next->title }}</a></h3>
                        </div>
                        @else
                        <div class="blog-prev col-lg-6">
                            <h6> </h6>
                        </div>
                        @endif
                    </div>
                    <hr>
                    <!-- related-post -->
                    <div class="related-post-area mb-50">
                        <h4 class="title-2">Related Post</h4>
                        <div class="row">
                            @foreach (\App\Blog::where('category_id', $blog->category_id)->where('status', 1)->orderBy('created_at', 'desc')->take(2)->get() as $key => $related_blog)
                            <div class="col-md-6">
                                <!-- Blog Item -->
                                <div class="ltn__blog-item ltn__blog-item-6">
                                    <div class="ltn__blog-img">
                                        <a href="{{ url("blog").'/'. $related_blog->slug }}">
                                            <img
                                                src="{{ uploaded_asset($related_blog->banner) }}"
                                                data-src="{{ uploaded_asset($related_blog->banner) }}"
                                                alt="{{ $related_blog->title }}"
                                            >
                                        </a>
                                    </div>
                                    <div class="ltn__blog-brief">
                                        <div class="ltn__blog-meta">
                                            <ul>
                                                <li class="ltn__blog-date ltn__secondary-color">
                                                    <i class="far fa-calendar-alt"></i>{{ date('d-m-Y', strtotime($related_blog->created_at)) }}
                                                </li>
                                            </ul>
                                        </div>
                                        <h3 class="ltn__blog-title"><a href="blog-details.html"><a href="{{ url("blog").'/'. $related_blog->slug }}">
                                            {{ $related_blog->title }}
                                        </a></a></h3>
                                        <p>{{ $related_blog->short_description }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- comment-area -->
                     <div class="ltn__comment-area mb-50">
                        <h4 class="title-2">{{ str_pad(\App\BlogComment::where('blog_id', $blog->id)->count(), 2, "0", STR_PAD_LEFT) }} {{ translate('Comments') }}</h4>
                        <div class="ltn__comment-inner">
                            <ul>
                                @foreach ($blog->comments as $key => $comment)
                                <li>
                                    <div class="ltn__comment-item clearfix">
                                        <div class="ltn__commenter-img">
                                            <img
                                                class="lazyload"
                                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                @if($comment->user->avatar_original !=null)
                                                data-src="{{ uploaded_asset($comment->user->avatar_original) }}"
                                                @else
                                                data-src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                @endif
                                                alt="Image"
                                            >
                                        </div>
                                        <div class="ltn__commenter-comment">
                                            <h6>{{ $comment->user->name }}</h6>
                                            <span class="comment-date">{{ date('F j, Y', strtotime($comment->created_at)) }}</span>
                                            <p>{{ $comment->comment }}</p>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <!-- comment-reply -->
                     <div class="ltn__comment-reply-area ltn__form-box mb-60---">
                        <h4 class="title-2">Post Comment</h4>
                        @if(Auth::check())
                            <form action="{{route('blog.comment',$blog->id)}}" method="POST">
                                @csrf
                                <div class="input-item input-item-textarea ltn__custom-icon">
                                    <textarea placeholder="Type your comments...." name="comment"></textarea>
                                </div>
                                <div class="input-item input-item-name ltn__custom-icon">
                                    <input type="text" value="{{ Auth::user()->name }}" placeholder="Type your name...." disabled required>
                                </div>
                                <div class="input-item input-item-email ltn__custom-icon">
                                    <input type="email" value="{{ Auth::user()->email }}" placeholder="Type your email...." disabled>
                                </div>
                                <div class="btn-wrapper">
                                    <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit"><i class="far fa-comments"></i>{{ translate('Post Comment') }}</button>
                                </div>
                            </form>
                        @else
                            <h6 class="text text-secondary">{{ translate('You must login to comment!') }}</h6>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <aside class="sidebar-area blog-sidebar ltn__right-sidebar">
                    <!-- Search Widget -->
                    <div class="widget ltn__search-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border-2">Search Objects</h4>
                        <form action="{{ route('blog') }}" method="GET">
                            <input type="text" name="search" placeholder="Search your keyword...">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <!-- Form Widget -->
                    {{-- <div class="widget ltn__form-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border-2">Drop Messege For Book</h4>
                        <form action="#">
                            <input type="text" name="yourname" placeholder="Your Name*">
                            <input type="text" name="youremail" placeholder="Your e-Mail*">
                            <textarea name="yourmessage" placeholder="Write Message..."></textarea>
                            <button type="submit" class="btn theme-btn-1">Send Messege</button>
                        </form>
                    </div> --}}
                    <!-- Top Rated Product Widget -->
                    <div class="widget ltn__top-rated-product-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border-2">{{ translate('Top Rated Product') }}</h4>
                        <ul>
                            @foreach (filter_products(\App\Product::where('published', 1)->orderBy('rating','DESC'))->limit(5)->get() as $key => $product)
                            <li>
                                <div class="top-rated-product-item clearfix">
                                    <div class="top-rated-product-img">
                                        <a href="{{ route('product', $product->slug) }}">
                                            <img src="{{ uploaded_asset($product->thumbnail_img)}}"
                                            data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                            alt="{{ $product->getTranslation('name') }}"
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                        </a>
                                    </div>
                                    <div class="top-rated-product-info">
                                        <div class="product-ratting">
                                            <ul>
                                                <li>{{ renderStarRating($product->rating) }}</li>
                                            </ul>
                                        </div>
                                        <h6><a href="{{ route('product', $product->slug) }}">{{ $product->name }}</a></h6>
                                        <div class="product-price">
                                            <span>${{ $product->unit_price }}</span>
                                            @if(home_base_price($product) != home_discounted_base_price($product))
                                                <del>{{ home_base_price($product) }}</del>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Menu Widget (Category) -->
                    <div class="widget ltn__menu-widget ltn__menu-widget-2--- ltn__menu-widget-2-color-2---">
                        <h4 class="ltn__widget-title ltn__widget-title-border-2">Top Categories</h4>
                        <ul>
                            @foreach(\App\BlogCategory::withCount('posts')->orderBy('posts_count', 'DESC')->get() as $top_categories)
                                <li><a href="{{ route('blog', ['category'=>$top_categories->id]) }}">{{ $top_categories->category_name }}<span>({{ $top_categories->posts_count }})</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Popular Post Widget -->
                    <div class="widget ltn__popular-post-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border-2">{{ translate('Leatest Blogs') }}</h4>
                        <ul>
                            @foreach (\App\Blog::where('status', 1)->orderBy('created_at', 'desc')->take(5)->get() as $key => $latest_blog)
                            <li>
                                <div class="popular-post-widget-item clearfix">
                                    <div class="popular-post-widget-img">
                                        <a href="{{ url("blog").'/'. $latest_blog->slug }}">
                                            <img
                                                src="{{ uploaded_asset($latest_blog->banner) }}"
                                                data-src="{{ uploaded_asset($latest_blog->banner) }}"
                                                alt="{{ $latest_blog->title }}"
                                            >
                                        </a>
                                    </div>
                                    <div class="popular-post-widget-brief">
                                        <h6><a href="blog-details.html">{{ $latest_blog->title }}</a></h6>
                                        <div class="ltn__blog-meta">
                                            <ul>
                                                <li class="ltn__blog-date">
                                                    <a href="#"><i class="far fa-calendar-alt"></i>{{ date('d-m-Y', strtotime($latest_blog->created_at)) }}</a>
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
                    <!-- <div class="widget ltn__popular-post-widget ltn__twitter-post-widget">
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
                        </ul>
                    </div> -->
                    <!-- Social Media Widget -->
                    <div class="widget ltn__social-media-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border-2">Follow us</h4>
                        <div class="ltn__social-media-2">
                            <ul>
                                <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>

                            </ul>
                        </div>
                    </div>
                    <!-- Tagcloud Widget -->
                    <div class="widget ltn__tagcloud-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border-2">{{ translate('Popular Tags') }}</h4>
                        <ul>
                        @php $popular_tags = explode(',', $blog->tags) @endphp

                        @forelse($popular_tags as $tag)
                            <li><a href="{{ route('blog', ['tag'=>$tag]) }}">{{ $tag }}</a></li>
                        @empty
                            <p>lk</p>
                        @endforelse

                        </ul>
                    </div>
                    <!-- Banner Widget -->
                    <div class="widget ltn__banner-widget d-none">
                        <a href="shop.html"><img src="img/banner/2.jpg" alt="#"></a>
                    </div>
                    <!-- Instagram Widget -->
                    <div class="widget ltn__instagram-widget d-none">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Instagram Feeds</h4>
                        <div class="ltn__instafeed ltn__instafeed-grid insta-grid-gutter"></div>
                    </div>

                </aside>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    @if (get_setting('facebook_comment') == 1)
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0&appId={{ env('FACEBOOK_APP_ID') }}&autoLogAppEvents=1" nonce="ji6tXwgZ"></script>
    @endif
@endsection
