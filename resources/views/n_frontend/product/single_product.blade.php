    <div class="ltn__product-item ltn__product-item-3 text-center">
        <div class="product-img">
            <a href="{{ route('product', $product->slug) }}"><img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="#"></a>
            {{--<div class="product-badge">--}}
            {{--<ul>--}}
            {{--<li class="sale-badge">-19%</li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            <div class="product-hover-action">
                <ul>
                    <li>
                        <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                            <i class="far fa-eye"></i>
                        </a>
                    </li>
                    {{--<li>--}}
                        {{--<a href="#" title="Add to Cart" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">--}}
                            {{--<i class="fas fa-shopping-cart"></i>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    <li>
                        <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                            <i class="far fa-heart"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="product-info">
            <div class="product-ratting">
                <ul>
                    <li><a href="#">{{ renderStarRating($product->rating) }}</a></li>
                    {{--<li class="review-total"> <a href="#"> (24)</a></li>--}}
                </ul>
            </div>
            <h2 class="product-title"><a href="#">{{ $product->name }}</a></h2>
            <div class="product-price">
                <span>{{ $product->unit_price }}</span>
                @if(home_base_price($product) != home_discounted_base_price($product))
                    <del>{{ home_base_price($product) }}</del>
                @endif
            </div>
        </div>
    </div>
