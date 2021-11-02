{{-- <div class="modal-body p-4 added-to-cart">
    <div class="text-center text-success mb-4">
        <i class="las la-check-circle la-3x"></i>
        <h3>{{ translate('Item added to your cart!')}}</h3>
    </div>
    <div class="media mb-4">
        <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ uploaded_asset($product->thumbnail_img) }}" class="mr-3 lazyload size-100px img-fit rounded" alt="Product Image">
        <div class="media-body pt-3 text-left">
            <h6 class="fw-600">
                {{  $product->getTranslation('name')  }}
            </h6>
            <div class="row mt-3">
                <div class="col-sm-2 opacity-60">
                    <div>{{ translate('Price')}}:</div>
                </div>
                <div class="col-sm-10">
                    <div class="h6 text-primary">
                        <strong>
                            {{ single_price(($data['price'] + $data['tax']) * $data['quantity']) }}
                        </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button class="btn btn-outline-primary mb-3 mb-sm-0" data-dismiss="modal">{{ translate('Back to shopping')}}</button>
        <a href="{{ route('cart') }}" class="btn btn-primary mb-3 mb-sm-0">{{ translate('Proceed to Checkout')}}</a>
    </div>
</div> --}}
<div class="modal-body p-4 added-to-cart">
<div class="ltn__quick-view-modal-inner">
    <div class="modal-product-item">
       <div class="row">
           <div class="col-12">
               <div class="modal-product-img">
                   <div class="modal-product-info">
                    <div class="d-flex bd-highlight">
                        <div class="p-2 flex-grow-1 bd-highlight">
                            <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ uploaded_asset($product->thumbnail_img) }}" class="mr-3 lazyload size-100px img-fit rounded" alt="Product Image">
                        </div>
                        <div class="p-2 bd-highlight">
                            <h5><a href="#">{{  $product->getTranslation('name')  }}</a></h5>
                            <p class="added-cart"><i class="fa fa-check-circle" style="color: #77c720;"></i>{{ translate('Successfully added to your Cart!')}}</p>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="h6 product-price">
                            {{ translate('Price')}}: <strong>{{ single_price(($data['price'] + $data['tax']) * $data['quantity']) }}</strong>
                        </div>
                    </div>
                        <a href="{{ route('home') }}" class="theme-btn-1 btn btn-effect-1" data-dismiss="modal">{{ translate('Back to shopping')}}</a>
                        <a href="{{ route('cart') }}" class="theme-btn-2 btn btn-effect-2">{{ translate('Checkout')}}</a>
                        {{-- <a href="cart.html" class="theme-btn-1 btn btn-effect-1">View Cart</a>
                       <a href="checkout.html" class="theme-btn-2 btn btn-effect-2">Checkout</a>  --}}
                </div>
                <!-- additional-info -->
                <div class="additional-info d-none">
                   {{-- <p>We want to give you <b>10% discount</b> for your first order, <br>  Use discount code at checkout</p>  --}}
                   <div class="payment-method">
                        <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ uploaded_asset($product->thumbnail_img) }}" class="mr-3 lazyload size-100px img-fit rounded" alt="Product Image">
                       {{-- <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="#"> --}}
                   </div>
                </div>
           </div>
       </div>
    </div>
</div>
</div>
