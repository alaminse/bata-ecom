
    <!-- SMALL PRODUCT LIST AREA START -->
    <div class="ltn__small-product-list-area section-bg-1 pt-115 pb-90 mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2 text-center">
                        <h1 class="section-title">{{translate('Featured Products')}}</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- small-product-item -->
                @foreach (filter_products(\App\Product::where('published', 1)->where('featured', '1'))->limit(9)->get() as $key => $product)
                    <div class="col-lg-4 col-md-6 col-12">
                    <div class="ltn__small-product-item">
                        <div class="small-product-item-img">
                            <a href="{{ route('product', $product->slug) }}">
                                <img src="{{ uploaded_asset($product->thumbnail_img)}}" alt="Image">
                            </a>
                        </div>
                        <div class="small-product-item-info">
                            <div class="product-ratting">
                                <ul>
                                    <li>{{ renderStarRating($product->rating) }}</li>
                                </ul>
                            </div>
                            <h2 class="product-title">
                                <a href="{{ route('product', $product->slug) }}" data-toggle="tooltip" title="{{ translate('View details') }}">{{ $product->name }}</a>
                            </h2>
                            <div class="product-price">
                                <span>${{ $product->unit_price }}</span>
                                @if(home_base_price($product) != home_discounted_base_price($product))
                                    <del>${{ home_base_price($product) }}</del>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!--  -->
            </div>
            <div class="d-flex flex-row-reverse bd-highlight">
                <div class="bd-highlight">
                    <a class="" href="{{ route('all.products',['is_featured'=>'yes']) }}">
                        {{translate('View all')}} <span class="fas fa-arrow-alt-circle-right"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- SMALL PRODUCT LIST AREA END -->
