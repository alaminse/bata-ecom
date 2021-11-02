@extends('n_frontend.layouts.app')

@section('content')
    </div>
     <!-- BREADCRUMB AREA START -->
     <div class="text-left bg-overlay-white-30 bg-image py-5"  data-bs-bg="{{ asset('public/frontend/img/bg/14.jpg') }}">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-12 py-5">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">{{ translate('Wishlist')}}</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="index.html"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> {{ translate('Home')}}</a></li>
                                <li>{{ translate('Wishlist')}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->
    
    <div class="liton__wishlist-area mb-105 py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping-cart-inner">
                        <div class="shoping-cart-table table-responsive">
                            <table class="table">
                                <!-- <thead>
                                    <th class="cart-product-remove">X</th>
                                    <th class="cart-product-image">Image</th>
                                    <th class="cart-product-info">Title</th>
                                    <th class="cart-product-price">Price</th>
                                    <th class="cart-product-quantity">Quantity</th>
                                    <th class="cart-product-subtotal">Subtotal</th>
                                </thead> -->
                                <tbody>
                                    @forelse ($wishlists as $key => $wishlist)
                                        @if ($wishlist->product != null)
                                            <tr id="wishlist_{{ $wishlist->id }}">
                                                <td class="cart-product-remove">
                                                    <a href="#" class="link link--style-3" data-toggle="tooltip" data-placement="top" title="Remove from wishlist" onclick="removeFromWishlist({{ $wishlist->id }})">x</a>
                                                </td>
                                                <td class="cart-product-image">
                                                    <a href="{{ route('product', $wishlist->product->slug) }}"><img src="{{ uploaded_asset($wishlist->product->thumbnail_img) }}" alt="#"></a>
                                                </td>
                                                <td class="cart-product-info">
                                                    <h4><a href="{{ route('product', $wishlist->product->slug) }}">{{ $wishlist->product->getTranslation('name') }}</a></h4>
                                                </td>
                                                <td class="cart-product-price">
                                                    @if(home_base_price($wishlist->product) != home_discounted_base_price($wishlist->product))
                                                        <del>{{ home_base_price($wishlist->product) }}</del>
                                                    @endif
                                                        <span>{{ home_discounted_base_price($wishlist->product) }}</span>
                                                </td>
                                                <td class="cart-product-stock">{{ translate('In Stock')}}</td>
                                                <td class="cart-product-add-cart">
                                                    <a href="javascript:void(0)" onclick="showAddToCartModal({{ $wishlist->product->id }})" title="{{translate('Add to cart')}} "data-bs-toggle="modal" data-placement="left" data-bs-target="#addToCart" {{-- data-bs-toggle="modal" data-bs-target="#quick_view_modal" --}}>
                                                        <i class="fa fa-shopping-cart"></i> {{ translate('Add to cart')}}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                        <div class="col">
                                            <div class="text-center bg-white p-4 rounded shadow">
                                                <img class="mw-100 h-200px" src="{{ static_asset('assets/img/nothing.svg') }}" alt="Image">
                                                <h5 class="mb-0 h5 mt-3">{{ translate("There isn't anything added yet")}}</h5>
                                            </div>
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="aiz-pagination">
                                {{ $wishlists->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row gutters-5">
        @forelse ($wishlists as $key => $wishlist)
            @if ($wishlist->product != null)
                <div class="col-xxl-3 col-xl-4 col-lg-3 col-md-4 col-sm-6" id="wishlist_{{ $wishlist->id }}">
                    <div class="card mb-2 shadow-sm">
                        <div class="card-body">
                            <a href="{{ route('product', $wishlist->product->slug) }}" class="d-block mb-3">
                                <img src="{{ uploaded_asset($wishlist->product->thumbnail_img) }}" class="img-fit h-140px h-md-200px">
                            </a>

                            <h5 class="fs-14 mb-0 lh-1-5 fw-600 text-truncate-2">
                                <a href="{{ route('product', $wishlist->product->slug) }}" class="text-reset">{{ $wishlist->product->getTranslation('name') }}</a>
                            </h5>
                            <div class="rating rating-sm mb-1">
                                {{ renderStarRating($wishlist->product->rating) }}
                            </div>
                            <div class=" fs-14">
                                  @if(home_base_price($wishlist->product) != home_discounted_base_price($wishlist->product))
                                      <del class="opacity-60 mr-1">{{ home_base_price($wishlist->product) }}</del>
                                  @endif
                                      <span class="fw-600 text-primary">{{ home_discounted_base_price($wishlist->product) }}</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="link link--style-3" data-toggle="tooltip" data-placement="top" title="Remove from wishlist" onclick="removeFromWishlist({{ $wishlist->id }})">
                                <i class="la la-trash la-2x"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-block btn-primary ml-3" onclick="showAddToCartModal({{ $wishlist->product->id }})">
                                <i class="la la-shopping-cart mr-2"></i>{{ translate('Add to cart')}}
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="col">
                <div class="text-center bg-white p-4 rounded shadow">
                    <img class="mw-100 h-200px" src="{{ static_asset('assets/img/nothing.svg') }}" alt="Image">
                    <h5 class="mb-0 h5 mt-3">{{ translate("There isn't anything added yet")}}</h5>
                </div>
            </div>
        @endforelse
    </div> --}}
    {{-- <div class="aiz-pagination">
        {{ $wishlists->links() }}
    </div> --}}
@endsection

@section('modal')

<div class="modal fade" id="addToCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="c-preloader">
                <i class="fa fa-spin fa-spinner"></i>
            </div>
            <button type="button" class="close absolute-close-btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div id="addToCart-modal-body">

            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        function removeFromWishlist(id){
            $.post('{{ route('wishlists.remove') }}',{_token:'{{ csrf_token() }}', id:id}, function(data){
                $('#wishlist').html(data);
                $('#wishlist_'+id).hide();
                AIZ.plugins.notify('success', '{{ translate('Item has been renoved from wishlist') }}');
            })
        }
    </script>
@endsection
