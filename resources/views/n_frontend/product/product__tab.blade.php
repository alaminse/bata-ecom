 <!-- PRODUCT TAB AREA START (product-item-3) -->
<div class="ltn__product-tab-area ltn__product-gutter pt-115 pb-70">
    @php $home_categories = json_decode(get_setting('home_categories')); @endphp
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2--- text-center">
                    <h1 class="section-title">{{translate('Our Products')}}</h1>
                    <p>{{translate('A highly efficient slip-ring scanner for todays diagnostic requirements.')}}</p>
                </div>
                <div class="ltn__tab-menu ltn__tab-menu-2 ltn__tab-menu-top-right-- text-uppercase text-center">
                    <div class="nav">
                        @foreach ($home_categories as $key => $value)
                        @php $category = \App\Category::find($value); @endphp
                        <a class="{{$key == 0 ? 'active show': ''}}" data-bs-toggle="tab" href="#{{ 'selectorTab_'.$category->id.'_'.$key }}">{{ $category->getTranslation('name') }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="tab-content">
                    @foreach ($home_categories as $key => $value)
                    @php $category = \App\Category::find($value); @endphp
                    <div class="tab-pane fade {{$key == 0 ? 'active show': ''}}" id="{{ 'selectorTab_'.$category->id.'_'.$key }}">
                        <div class="ltn__product-tab-content-inner">
                            <div class="row ltn__tab-product-slider-one-active slick-arrow-1">
                                <div class="col-lg-12">
                                @foreach (get_cached_products($category->id)->take(24) as $product_key => $product)
                                    @include('n_frontend.partials.product_box_1',['product' => $product])
                                
                                @if ($loop->even)
                                </div>
                                <div class="col-lg-12">
                                @endif

                                @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row-reverse bd-highlight">
                            <div class="bd-highlight">
                                <a class="" href="{{ route('products.category', $category->slug) }}">
                                    View all <span class="fas fa-arrow-alt-circle-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- PRODUCT TAB AREA END -->