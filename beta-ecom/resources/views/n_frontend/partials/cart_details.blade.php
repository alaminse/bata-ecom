 <div class="container">
    @if( $carts && count($carts) > 0 )
         <div class="row">
             <div class="col-xxl-8 col-xl-10 mx-auto">
                 <div class="shadow-sm bg-white p-3 p-lg-4 rounded text-left">
                     <table class="table">
                         <thead>
                         <th class="cart-product-remove">{{ translate('Remove')}}</th>
                         <th class="cart-product-image">{{ translate('Product')}}</th>
                         <th class="cart-product-info">{{ translate('Price')}}</th>
                         <th class="cart-product-price">{{ translate('Tax')}}</th>
                         <th class="cart-product-quantity">{{ translate('Quantity')}}</th>
                         <th class="cart-product-subtotal">{{ translate('Total')}}</th>
                         </thead>
                         <tbody>
                         @php
                             $total = 0;
                         @endphp
                         @foreach ($carts as $key => $cartItem)
                             @php
                                 $product = \App\Product::find($cartItem['product_id']);
                                 $product_stock = $product->stocks->where('variant', $cartItem['variation'])->first();
                                 $total = $total + ($cartItem['price'] + $cartItem['tax']) * $cartItem['quantity'];
                                 $product_name_with_choice = $product->getTranslation('name');
                                 if ($cartItem['variation'] != null) {
                                     $product_name_with_choice = $product->getTranslation('name').' - '.$cartItem['variation'];
                                 }
                             @endphp
                             <tr>
                                 <td class="cart-product-remove">
                                     <a href="javascript:void(0)" onclick="removeFromCartView(event, {{ $cartItem['id'] }})" class="btn btn-icon btn-sm btn-soft-primary btn-circle">
                                         <i class="fa fa-trash"></i>
                                     </a>
                                 </td>
                                 <td class="cart-product-image">
                                     <a href="#">
                                         <img
                                             src="{{ uploaded_asset($product->thumbnail_img) }}"
                                             class="img-fit size-60px rounded"
                                             alt="{{ $product->getTranslation('name')  }}"
                                         >
                                         <span>{{ $product_name_with_choice }}</span>
                                     </a>
                                 </td>
                                 <td class="cart-product-info">
                                     <h4>{{ single_price($cartItem['price']) }}</h4>
                                 </td>
                                 <td class="cart-product-price">{{ single_price($cartItem['tax']) }}</td>
                                 <td class="cart-product-quantity">
                                     @if($cartItem['digital'] != 1 && $product->auction_product == 0)
                                         <div class="row no-gutters aiz-plus-minus mr-3" style="width: 180px;">
                                             <button class="btn col-auto btn-icon btn-sm btn-circle btn-light mt-3" type="button" data-type="minus"  data-field="quantity[{{ $cartItem['id'] }}]">
                                                 <i class="fa fa-minus"></i>
                                             </button>
                                             <input type="text" name="quantity[{{ $cartItem['id'] }}]" class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="{{ $cartItem['quantity'] }}" min="{{ $product->min_qty }}" max="{{ $product_stock->qty }}" onchange="updateQuantity({{ $cartItem['id'] }}, this)" style="margin-bottom: 0;">
                                             <button class="btn  mt-3 col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="plus" data-field="quantity[{{ $cartItem['id'] }}]">
                                                 <i class="fa fa-plus"></i>
                                             </button>
                                         </div>
                                     @elseif($product->auction_product == 1)
                                         <span class="fw-600 fs-16">1</span>
                                     @endif
                                     {{--  <div class="cart-plus-minus">
                                          <input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">
                                      </div> --}}
                                 </td>
                                 <td class="cart-product-subtotal">$298.00</td>
                             </tr>
                             {{-- <div class="row gutters-5">
                                 <div class="col-lg-5 d-flex">
                                     <span class="mr-2 ml-0">
                                         <img
                                             src="{{ uploaded_asset($product->thumbnail_img) }}"
                                             class="img-fit size-60px rounded"
                                             alt="{{ $product->getTranslation('name')  }}"
                                         >
                                     </span>
                                     <span class="fs-14 opacity-60">{{ $product_name_with_choice }}</span>
                                 </div>

                                 <div class="col-lg col-4 order-1 order-lg-0 my-3 my-lg-0">
                                     <span class="opacity-60 fs-12 d-block d-lg-none">{{ translate('Price')}}</span>
                                     <span class="fw-600 fs-16">{{ single_price($cartItem['price']) }}</span>
                                 </div>
                                 <div class="col-lg col-4 order-2 order-lg-0 my-3 my-lg-0">
                                     <span class="opacity-60 fs-12 d-block d-lg-none">{{ translate('Tax')}}</span>
                                     <span class="fw-600 fs-16">{{ single_price($cartItem['tax']) }}</span>
                                 </div>

                                 <div class="col-lg col-6 order-4 order-lg-0">
                                     @if($cartItem['digital'] != 1 && $product->auction_product == 0)
                                         <div class="row no-gutters align-items-center aiz-plus-minus mr-2 ml-0">
                                             <button class="btn col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="minus" data-field="quantity[{{ $cartItem['id'] }}]">
                                                 <i class="las la-minus"></i>
                                             </button>
                                             <input type="number" name="quantity[{{ $cartItem['id'] }}]" class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="{{ $cartItem['quantity'] }}" min="{{ $product->min_qty }}" max="{{ $product_stock->qty }}" onchange="updateQuantity({{ $cartItem['id'] }}, this)">
                                             <button class="btn col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="plus" data-field="quantity[{{ $cartItem['id'] }}]">
                                                 <i class="las la-plus"></i>
                                             </button>
                                         </div>
                                     @elseif($product->auction_product == 1)
                                         <span class="fw-600 fs-16">1</span>
                                     @endif
                                 </div>
                                 <div class="col-lg col-4 order-3 order-lg-0 my-3 my-lg-0">
                                     <span class="opacity-60 fs-12 d-block d-lg-none">{{ translate('Total')}}</span>
                                     <span class="fw-600 fs-16 text-primary">{{ single_price(($cartItem['price'] + $cartItem['tax']) * $cartItem['quantity']) }}</span>
                                 </div>
                                 <div class="col-lg-auto col-6 order-5 order-lg-0 text-right">
                                     <a href="javascript:void(0)" onclick="removeFromCartView(event, {{ $cartItem['id'] }})" class="btn btn-icon btn-sm btn-soft-primary btn-circle">
                                         <i class="las la-trash"></i>
                                     </a>
                                 </div>
                             </div> --}}
                         </tbody>
                         @endforeach
                     </table>
                 </div>

                 <div class="px-3 py-2 mb-4 border-top d-flex justify-content-between">
                     <span class="opacity-60 fs-15">{{translate('Subtotal')}}</span>
                     <span class="fw-600 fs-17">{{ single_price($total) }}</span>
                 </div>
                 <div class="d-flex bd-highlight">
                     <div class="btn-wrapper text-right flex-grow-1 bd-highlight">
                         <a href="{{ route('home') }}" class="theme-btn-1 btn btn-effect-1">
                             <i class="las la-arrow-left"></i>
                             {{ translate('Return to shop')}}
                         </a>
                     </div>
                     <div class="btn-wrapper text-right bd-highlight">
                         @if(Auth::check())
                             <a href="{{ route('checkout.shipping_info') }}" class="theme-btn-1 btn btn-effect-1">
                                 {{ translate('Continue to Shipping')}}
                             </a>
                         @else
                             <a href="{{ route('user.login') }}" class="theme-btn-1 btn btn-effect-1">{{ translate('Login')}}</a>
                             {{-- <button class="" onclick="showCheckoutModal()">{{ translate('Continue to Shipping')}}</button> --}}
                         @endif
                     </div>
                 </div>
             </div>
         </div>
    @else
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="shadow-sm bg-white p-4 rounded">
                    <div class="text-center p-3">
                        <i class="las la-frown la-3x opacity-60 mb-3"></i>
                        <h3 class="h4 fw-700">{{translate('Your Cart is empty')}}</h3>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script type="text/javascript">
    AIZ.extra.plusMinus();
</script>
