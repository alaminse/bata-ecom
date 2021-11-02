@extends('n_frontend.layouts.app')

@if (isset($category_id))
    @php
        $meta_title = \App\Category::find($category_id)->meta_title;
        $meta_description = \App\Category::find($category_id)->meta_description;
    @endphp
@elseif (isset($brand_id))
    @php
        $meta_title = \App\Brand::find($brand_id)->meta_title;
        $meta_description = \App\Brand::find($brand_id)->meta_description;
    @endphp
@else
    @php
        $meta_title         = get_setting('meta_title');
        $meta_description   = get_setting('meta_description');
    @endphp
@endif

@section('meta_title'){{ $meta_title }}@stop
@section('meta_description'){{ $meta_description }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $meta_title }}">
    <meta itemprop="description" content="{{ $meta_description }}">

    <!-- Twitter Card data -->
    <meta name="twitter:title" content="{{ $meta_title }}">
    <meta name="twitter:description" content="{{ $meta_description }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_description }}" />
@endsection

@section('content')

    <section class="mb-4">
        <div style="margin-bottom: 35px!important; padding-top: 80px!important; padding-bottom: 40px!important;" class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="{{ asset('public/assets/img/bg.jpg')}}">
            <div class="container">
            <form class="" action="{{ route('all.products') }}" id="search-form" method="GET">
                <input type="hidden" name="category_id" value="{{ isset($category_id)? $category_id : null }}">
                <input type="hidden" name="is_featured" value="{{ isset($is_featured)? $is_featured : null }}">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner">
                            <h1 class="page-title">@if(isset($category_id)){{ \App\Category::find($category_id)->getTranslation('name') }}@endif</h1>
                            <div class="ltn__breadcrumb-list">
                                <ul>
                                    <li><a href="{{ route('home') }}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                    <li>@if(isset($category_id)){{ \App\Category::find($category_id)->getTranslation('name') }}@endif</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container sm-px-0">
            <div class="row">
                <div class="col-lg-8 order-lg-2 mb-120">
                    <div class="ltn__shop-options">
                        <ul>
                            <li>
                                <div class="ltn__grid-list-tab-menu ">
                                    <div class="nav">
                                        <a class="active show" data-bs-toggle="tab" href="#liton_product_grid"><i class="fas fa-th-large"></i></a>
                                        <a data-bs-toggle="tab" href="#liton_product_list"><i class="fas fa-list"></i></a>
                                    </div>
                                </div>
                            </li>
                            {{-- <li>
                                <div class="showing-product-number text-right">
                                    <span>{{translate('Showing 1–12 of 18 results')}}</span>
                                </div>
                            </li> --}}
                            <li>
                                <div class="short-by text-center">
                                    <select class="nice-select" name="sort_by" onchange="formSubmit()">
                                        <option value="" @isset($sort_by) @if ($sort_by == 'default') selected @endif @endisset>
                                            {{ translate('Default Sorting') }}
                                        </option>
                                        <option value="popular" @isset($sort_by) @if ($sort_by == 'popular') selected @endif @endisset>
                                            {{ translate('Sort by popularity') }}
                                        </option>
                                        <option value="newest" @isset($sort_by) @if ($sort_by == 'newest') selected @endif @endisset>
                                            {{ translate('Sort by new arrivals') }}
                                        </option>
                                        <option value="price-asc" @isset($sort_by) @if ($sort_by == 'price-asc') selected @endif @endisset>
                                            {{ translate('Sort by price: low to high') }}
                                        </option>
                                        <option value="price-desc" @isset($sort_by) @if ($sort_by == 'price-desc') selected @endif @endisset>
                                            {{ translate('Sort by price: high to low') }}
                                        </option>
                                    </select>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="liton_product_grid">
                            <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                                <div class="row">
                                    <!-- ltn__product-item -->
                                    @if(isset($products))
                                        @foreach($products as $key=>$product)
                                            <div class="col-xl-4 col-sm-6 col-6">
                                                @include('n_frontend.partials.product_box_1')
                                            </div>
                                        @endforeach
                                    @endif
                                <!--  -->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="liton_product_list">
                            <div class="ltn__product-tab-content-inner ltn__product-list-view">
                                <div class="row">
                                    @if(isset($products))
                                        @foreach($products as $key=>$product)
                                        <!-- ltn__product-item -->
                                            <div class="col-lg-12">
                                                @include('n_frontend.partials.product_box_1')
                                            </div>
                                            <!--  -->
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="bd-highlight">
                            @if(isset($products))
                                {{ $products->links() }}
                            @endif
                        </div>
                    </div>

                </div>
                <div class="col-lg-4  mb-120">
                    <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar">
                        <!-- Category Widget -->
                        <div class="widget ltn__menu-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">{{translate('Product categories')}}</h4>
                            <div class="ltn__category-menu-toggle ltn__one-line-active">
                                <ul>
                                    <!-- Submenu Column - 4 -->
                                    @foreach(\App\Category::where('level', 0)->orderBy('order_level', 'desc')->get()->take(8) as $key => $category)
                                        <li class="ltn__category-menu-item ltn__category-menu-drop" data-id="{{ $category->id }}">
                                            <a href="{{ route('products.category', $category->slug) }}">
                                                <img
                                                        class="cat-image lazyload mr-2"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ uploaded_asset($category->icon) }}"
                                                        width="20"
                                                        alt="{{ $category->getTranslation('name') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                >
                                                {{ $category->getTranslation('name') }} </a>
                                            @if(count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id))>0)
                                                <ul class="ltn__category-submenu ltn__category-column-4">
                                                    @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($category->id) as $key => $first_level_id)
                                                        <li class="ltn__category-submenu-title ltn__category-menu-drop"><a href="{{ route('products.category', \App\Category::find($first_level_id)->slug) }}">{{ \App\Category::find($first_level_id)->getTranslation('name') }}</a>
                                                            <ul class="ltn__category-submenu-children">
                                                                @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($first_level_id) as $key => $second_level_id)
                                                                    <li>
                                                                        <a href="{{ route('products.category', \App\Category::find($second_level_id)->slug) }}">{{ \App\Category::find($second_level_id)->getTranslation('name') }}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- Price Filter Widget -->
                        <div class="widget ltn__price-filter-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">{{translate('Filter by price')}}</h4>
                            <div class="price_filter">
                                <div class="price_slider_amount">
                                    <input type="submit"  value="Your range:"/>
                                    <input type="text" class="amount" name="price"  placeholder="Add Your Price" id="amount"/>
                                    <input type="hidden" name="min_price" id="min_price" value="{{ isset($min_price) ? $min_price : 1 }}">
                                    <input type="hidden" name="max_price" id="max_price" value="{{ isset($max_price) ? $max_price : 100000}}">
                                </div>
                                <div class="slider-range" id="slider"></div>
                            </div>
                        </div>
                        <!-- Top Rated Product Widget -->
                        @if(filter_products(\App\Product::where('rating', '>', 0)->orderBy('rating', 'desc'))->limit(4)->count() > 0)
                        <div class="widget ltn__top-rated-product-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">{{ translate('Top Rated Product') }}</h4>
                            <ul>
                                @foreach (filter_products(\App\Product::where('rating', '>', 0)->orderBy('rating', 'desc'))->limit(4)->get() as $key => $top_rated)
                                    <li>
                                        <div class="top-rated-product-item clearfix">
                                            <div class="top-rated-product-img">
                                                <a href="{{ route('product', $top_rated->slug) }}">
                                                    <img src="{{ uploaded_asset($top_rated->thumbnail_img) }}"
                                                         alt="{{ $top_rated->getTranslation('name') }}"
                                                         onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                </a>
                                            </div>
                                            <div class="top-rated-product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><i>{{ renderStarRating($top_rated->rating) }}</i></li>
                                                    </ul>
                                                </div>
                                                <h6>
                                                    <a href="{{ route('product', $top_rated->slug) }}">
                                                        {{ $top_rated->getTranslation('name') }}
                                                    </a>
                                                </h6>
                                                <div class="product-price">
                                                    <span>{{ home_discounted_base_price($top_rated) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        
                    <!-- Banner Widget -->
                        <div class="widget ltn__banner-widget">
                            <a href="{{ route('home')}}"><img src="{{static_asset('frontend/img/banner/banner-2.jpg')}}" alt="Banner"></a>
                        </div>

                    </aside>
                </div>
            </div>
        </div>
        
        </form>
    </section>

@endsection


@section('script')
    <script type="text/javascript">
        $(window).on('load',function(){
            console.log('yes');
            $('.loader').fadeOut(5000);
        });

        $( function() {
            let min = $('#min_price').val();
            let max = $('#max_price').val();
            $( ".slider-range" ).slider({
                range: true,
                min: 1,
                max: 100000,
                values: [ min, max ],
                slide: function( event, ui ) {
                    $( ".amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                    productSortingByPrice(ui.values[ 0 ], ui.values[ 1 ]);
                }
            });
            $( ".amount" ).val( "$" + $( ".slider-range" ).slider( "values", 0 ) +
                " - $" + $( ".slider-range" ).slider( "values", 1 ) );
        });

        function productSortingByPrice(minPrice, maxPrice) {
            $('input[name=min_price]').val(minPrice);
            $('input[name=max_price]').val(maxPrice);
            formSubmit();
        }

        $('.colorCode').on('click', function () {
            let colorCode = $(this).attr('colorCode');
            console.log(colorCode);
            $('#color').val(colorCode);
            formSubmit();
        });

        function formSubmit() {
            $('#search-form').submit();
            $('.c-preloader').show();
        }
    </script>
@endsection
