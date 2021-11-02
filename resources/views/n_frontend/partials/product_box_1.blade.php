<div class="ltn__product-item ltn__product-item-3 text-center">
    <div class="product-img">
        <a href="{{ route('product', $product->slug) }}">
            <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}">
        </a>
        <div class="product-badge">
            <ul>
                {{-- <li class="sale-badge">-19%</li> --}}
            </ul>
        </div>
        <div class="product-hover-action">
            <ul>
                <li>
                    <a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})" data-toggle="tooltip" title="{{translate('Quick View')}}" data-bs-toggle="modal" data-placement="top" data-bs-target="#addToCart" {{-- data-bs-toggle="modal" data-bs-target="#quick_view_modal" --}}>
                        <i class="far fa-eye"></i>
                    </a>
                </li>
                {{-- <li>
                    <a class="buy-now add-to-cart" href="javascript:void(0)" onclick="addToCartDirectly({{ $product->id }})" data-toggle="tooltip" title="{{translate('Add to Cart')}}" data-bs-toggle="modal" data-placement="left" data-bs-target="#addToCart" >
                        <i class="fa fa-shopping-cart"></i>
                    </a>
                    <button type="button" class="theme-btn-1 btn btn-effect-1 buy-now fw-600 add-to-cart" onclick="addToCart()">
                        <i class="la la-shopping-cart"></i>
                        <span class="d-none d-md-inline-block"> {{ translate('Add to cart')}}</span>
                    </button> 
                </li> --}}
                <li>
                    <a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})" data-toggle="tooltip" title="{{ translate('Add to wishlist') }}" data-placement="top" data-bs-toggle="modal">
                        <i class="far fa-heart"></i></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="product-info">
        <div class="product-ratting">
            <ul>
                <li>{{ renderStarRating($product->rating) }}</li>
            </ul>
        </div>
        <h2 class="product-title">
            <a href="{{ route('product', $product->slug) }}" data-toggle="tooltip" title="{{ translate('View details') }}">
                {{  $product->getTranslation('name')  }}
            </a>
        </h2>
        <div class="product-price">
            <span>{{ home_discounted_base_price($product) }}</span>
            @if(home_base_price($product) != home_discounted_base_price($product))
                <del>{{ home_base_price($product) }}</del>
            @endif
        </div>
    </div>
</div>
