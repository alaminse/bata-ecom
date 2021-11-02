@extends('n_frontend.layouts.app')
@section('title')
    Home
@endsection

@section('meta_title'){{ $detailedProduct->meta_title }}@stop

@section('meta_description'){{ $detailedProduct->meta_description }}@stop

@section('meta_keywords'){{ $detailedProduct->tags }}@stop

@section('content')
    <!-- BREADCRUMB AREA START -->
    <div style="margin-bottom: 35px!important; padding-top: 80px!important; padding-bottom: 40px!important;" class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="{{ asset('public/assets/img/bg.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">Product details</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="index.html"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li>Product details</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- SHOP DETAILS AREA START -->
    <div class="ltn__shop-details-area pb-85">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="ltn__shop-details-inner mb-60">
                        <div class="row">
                            <div class="col-md-6">
                                @php
                                    $photos = explode(',', $detailedProduct->photos);
                                @endphp
                                <div class="ltn__shop-details-img-gallery">
                                    @foreach ($photos as $key => $photo)
                                        <div class="ltn__shop-details-large-img">
                                            <div class="single-large-img">
                                                <a href="javascript:void" data-rel="lightcase:myCollection">
                                                    <img src="{{ uploaded_asset($photo) }}"
                                                         alt="Image"
                                                         onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="ltn__shop-details-small-img slick-arrow-2">
                                        @foreach ($detailedProduct->stocks as $key => $stock)
                                            @if ($stock->image != null)
                                                <div class="single-small-img">
                                                    <img src="{{ uploaded_asset($stock->image) }}" alt="Image">
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modal-product-info shop-details-info pl-0">
                                    <div class="product-ratting">
                                        <ul>
                                            <li><i>{{ renderStarRating($detailedProduct->rating) }}</i></li>
                                            {{-- <li class="review-total"> <a href="#"> (24)</a></li> --}}
                                        </ul>
                                    </div>
                                    <h3>{{ $detailedProduct->getTranslation('name') }}</h3>
                                    @if(home_price($detailedProduct) != home_discounted_price($detailedProduct))
                                        <div class="product-price">
                                            <span>{{ home_discounted_price($detailedProduct) }}</span>
                                            <del>{{ home_price($detailedProduct) }}</del>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>{{ home_discounted_price($detailedProduct) }}</span>
                                        </div>
                                    @endif
                                    <div class="modal-product-meta ltn__product-details-menu-1">
                                        <ul>
                                            <li>
                                                <strong>{{ translate('Category') }}:</strong>
                                                <span>
                                                    <a href="{{ route('products.category', $detailedProduct->category->slug) }}">
                                                        {{ $detailedProduct->category->name }}
                                                    </a>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                    @php
                                        $qty = 0;
                                        foreach ($detailedProduct->stocks as $key => $stock) {
                                            $qty += $stock->qty;
                                        }
                                    @endphp
                                    <form id="option-choice-form">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $detailedProduct->id }}">
                                    <div class="modal-product-meta ltn__product-details-menu-1">
                                        @if ($detailedProduct->choice_options != null)
                                            @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)
                                                <div class="row no-gutters">
                                                <div class="col-2">
                                                    <div class="opacity-50 mt-2">{{ \App\Attribute::find($choice->attribute_id)->getTranslation('name') }}:</div>
                                                </div>
                                                <div class="col-10">
                                                    <div class="aiz-radio-inline">
                                                        @foreach ($choice->values as $key => $value)
                                                            <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="S">
                                                                <input
                                                                    type="radio"
                                                                    name="attribute_id_{{ $choice->attribute_id }}"
                                                                    value="{{ $value }}"
                                                                    @if($key == 0) checked @endif
                                                                >
                                                                <span style="background: white;" class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                                    {{ $value }}
                                                                </span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                                <hr>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="modal-product-meta ltn__product-details-menu-1">
                                        @if (count(json_decode($detailedProduct->colors)) > 0)
                                            <div class="row no-gutters">
                                                <div class="col-2">
                                                    <div class="opacity-50 mt-2">{{ translate('Color')}}:</div>
                                                </div>
                                                <div class="col-10">
                                                    <div class="aiz-radio-inline">
                                                        @foreach (json_decode($detailedProduct->colors) as $key => $color)
                                                            <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="{{ \App\Color::where('code', $color)->first()->name }}">
                                                                <input
                                                                        type="radio"
                                                                        name="color"
                                                                        value="{{ \App\Color::where('code', $color)->first()->name }}"
                                                                        @if($key == 0) checked @endif
                                                                >
                                                                <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                                    <span class="size-30px d-inline-block rounded" style="background: {{ $color }};"></span>
                                                                </span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>
                                        @endif
                                    </div>

                                    <div class="ltn__product-details-menu-2">
                                        <ul>
                                            <li>
                                                <div class="cart-plus-minus">
                                                    <input type="number" value="{{ $detailedProduct->min_qty }}" name="quantity" class="cart-plus-minus-box" placeholder="1" min="{{ $detailedProduct->min_qty }}">
                                                </div>
                                            </li>
                                            <li>
                                                @if($qty > 0)
                                                    <a class="theme-btn-1 btn btn-effect-1 buy-now add-to-cart" href="javascript:void(0)" onclick="addToCart({{ $detailedProduct->id }})" data-bs-toggle="modal" data-placement="left" data-bs-target="#addToCart" >
                                                        <i class="fa fa-shopping-cart"></i>
                                                        <span>{{ translate('ADD TO CART') }}</span>
                                                    </a>
                                                @else
                                                    <button type="button" class="btn btn-secondary out-of-stock fw-600 d-none" disabled>
                                                        <i class="la la-cart-arrow-down"></i> {{ translate('Out of Stock')}}
                                                    </button>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    </form>
                                    <div class="ltn__product-details-menu-3">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0)" onclick="addToWishList({{ $detailedProduct->id }})" data-toggle="tooltip" title="{{ translate('Add to wishlist') }}" data-bs-toggle="modal">
                                                    <i class="far fa-heart"></i>
                                                    <span>{{translate('Add to Wishlist')}}</span>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                    <hr>
                                    <div class="ltn__social-media">
                                        <ul>
                                            <li>{{translate('Share')}}:</li>
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
                                            {{--<li>--}}
                                                {{--<a href="#" title="Instagram" target="_blank">--}}
                                                    {{--<i class="fab fa-instagram"></i>--}}
                                                {{--</a>--}}
                                            {{--</li>--}}
                                        </ul>
                                    </div>
                                    <hr>
                                    <div class="ltn__safe-checkout">
                                        <h5>{{translate('Guaranteed Safe Checkout')}}</h5>
                                        <img src="{{ asset('public/assets/img/payment-2.png') }}" alt="Payment Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Tab Start -->
                    <div class="ltn__shop-details-tab-inner ltn__shop-details-tab-inner-2">
                        <div class="ltn__shop-details-tab-menu">
                            <div class="nav">
                                <a class="active show" data-bs-toggle="tab" href="#liton_tab_details_1_1">{{translate('Description')}}</a>
                                <a data-bs-toggle="tab" href="#liton_tab_details_1_2" class="">{{translate('Reviews')}}</a>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="liton_tab_details_1_1">
                                <div class="ltn__shop-details-tab-content-inner">
                                    <p><?php echo $detailedProduct->getTranslation('description'); ?></p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="liton_tab_details_1_2">
                                <div class="ltn__shop-details-tab-content-inner">
                                    <h4 class="title-2">{{translate('Customer Reviews')}}</h4>
                                    <div class="product-ratting">
                                        <ul>
                                            <li><i>{{ renderStarRating($detailedProduct->rating) }}</i></li>
                                            <li class="review-total"> ( {{ count($detailedProduct->reviews) }} {{translate('Reviews')}} )</li>
                                        </ul>
                                    </div>
                                    <hr>
                                    <!-- comment-area -->
                                    <div class="ltn__comment-area mb-30">
                                        <div class="ltn__comment-inner">
                                            <ul>
                                                @foreach ($detailedProduct->reviews as $key => $review)
                                                    @if($review->user != null)
                                                        <li>
                                                            <div class="ltn__comment-item clearfix">
                                                                <div class="ltn__commenter-img">
                                                                    <img
                                                                        class="lazyload"
                                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                                        @if($review->user->avatar_original !=null)
                                                                        data-src="{{ uploaded_asset($review->user->avatar_original) }}"
                                                                        @else
                                                                        data-src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                                        @endif
                                                                        alt="Image"
                                                                    >
                                                                </div>
                                                                <div class="ltn__commenter-comment">
                                                                    <h6>{{ $review->user->name }}</h6>
                                                                    <div class="product-ratting">
                                                                        <ul>
                                                                            <span class="rating rating-sm">
                                                                                @for ($i=0; $i < $review->rating; $i++)
                                                                                    <i class="fas fa-star active"></i>
                                                                                @endfor
                                                                                @for ($i=0; $i < 5-$review->rating; $i++)
                                                                                    <i class="fas fa-star"></i>
                                                                                @endfor
                                                                            </span>
                                                                        </ul>
                                                                    </div>
                                                                    <p>{{ $review->comment }}</p>
                                                                    <span class="ltn__comment-reply-btn">{{ date('F j, Y', strtotime($review->created_at)) }}</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                                @if(count($detailedProduct->reviews) <= 0)
                                                    <div class="text-center fs-18 opacity-70">
                                                        {{  translate('There have been no reviews for this product yet.') }}
                                                    </div>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- comment-reply -->
                                    @if(Auth::check())
                                        @php
                                            $commentable = false;
                                        @endphp
                                        @foreach ($detailedProduct->orderDetails as $key => $orderDetail)
                                            @if($orderDetail->order != null && $orderDetail->order->user_id == Auth::user()->id && $orderDetail->delivery_status == 'delivered' && \App\Review::where('user_id', Auth::user()->id)->where('product_id', $detailedProduct->id)->first() == null)
                                                @php
                                                    $commentable = true;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if ($commentable)
                                            <div class="ltn__comment-reply-area ltn__form-box mb-30">
                                                <form action="{{ route('reviews.store') }}" method="POST">
                                                    @csrf
                                                    <h4 class="title-2">{{ translate('Add a Review') }}</h4>
                                                    <div class="mb-30">
                                                        <div class="add-a-review">
                                                            <h6>{{ translate('Your Ratings:') }}</h6>
                                                            <div class="form-group">
                                                                <div class="rating rating-input">
                                                                    <label>
                                                                        <input type="radio" name="rating" value="1" required>
                                                                        <i class="fas fa-star"></i>
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" name="rating" value="2">
                                                                        <i class="fas fa-star"></i>
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" name="rating" value="3">
                                                                        <i class="fas fa-star"></i>
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" name="rating" value="4">
                                                                        <i class="fas fa-star"></i>
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" name="rating" value="5">
                                                                        <i class="fas fa-star"></i>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                                                    <div class="input-item input-item-textarea ltn__custom-icon">
                                                        <textarea rows="4" name="comment" placeholder="{{ translate('Type your comments....') }}" required></textarea>
                                                    </div>
                                                    <div class="input-item input-item-name ltn__custom-icon">
                                                        <input type="text" name="name" value="{{ Auth::user()->name }}" placeholder="{{ translate('Type your name....') }}" required disabled>
                                                    </div>
                                                    <div class="input-item input-item-email ltn__custom-icon">
                                                        <input type="email" name="email" value="{{ Auth::user()->email }}" placeholder="{{ translate('Type your email....') }}" required disabled>
                                                    </div>
                                                    <div class="btn-wrapper">
                                                        <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">{{translate('Submit')}}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Tab End -->
                </div>
                <div class="col-lg-4">
                    <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar">
                        <!-- Top Rated Product Widget -->
                        <div class="widget ltn__top-rated-product-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">{{translate('Top Selling Products')}}</h4>
                            <ul>
                                @foreach (filter_products(\App\Product::where('user_id', $detailedProduct->user_id)->orderBy('num_of_sale', 'desc'))->limit(6)->get() as $key => $top_product)
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
                                                <h6>
                                                    <a href="{{ route('product', $top_product->slug) }}" data-toggle="tooltip" title="View Details">
                                                        {{ $top_product->getTranslation('name') }}
                                                    </a>
                                                </h6>
                                                <div class="product-price">
                                                    <span>{{ home_discounted_base_price($top_product) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Banner Widget -->
                        {{--<div class="widget ltn__banner-widget">--}}
                            {{--<a href="shop.html"><img src="img/banner/2.jpg" alt="#"></a>--}}
                        {{--</div>--}}
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- SHOP DETAILS AREA END -->

    <!-- PRODUCT SLIDER AREA START -->
    <div class="ltn__product-slider-area ltn__product-gutter pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2">
                        <h4 class="title-2">{{ translate('Related products')}}<span>.</span></h4>
                    </div>
                </div>
            </div>
            <div class="row ltn__related-product-slider-one-active slick-arrow-1">
                <!-- ltn__product-item -->
                @foreach (filter_products(\App\Product::where('category_id', $detailedProduct->category_id)->where('id', '!=', $detailedProduct->id))->limit(10)->get() as $key => $product)
                    <div class="col-lg-12">
                        @include('n_frontend.partials.product_box_1',['product' => $product])
                    </div>
                @endforeach
                <!-- ltn__product-item -->
                <!--  -->
            </div>
        </div>
    </div>
    <!-- PRODUCT SLIDER AREA END -->
@endsection
 @section('script')


 @endsection

{{--<script type="text/javascript">--}}
    {{--function addToCartProductDetails(){--}}
        {{--addToCart();--}}
    {{--}--}}
{{--</script>--}}