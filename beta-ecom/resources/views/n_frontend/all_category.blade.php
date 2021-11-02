@extends('n_frontend.layouts.app')
@section('title')
    All categories
@endsection
@section('content')

    <!-- SMALL PRODUCT LIST AREA START -->
    <div class="ltn__small-product-list-area section-bg-1 pt-115 pb-90 mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2 text-center">
                        <h1 class="section-title">{{ translate('All Categories') }}</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- small-product-item -->
                @foreach ($categories as $category)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="ltn__small-product-item">
                            <div class="small-product-item-img">
                                <a href="{{ route('products.category', $category->slug) }}">
                                    <img src="{{ uploaded_asset($category->icon) }}" alt="Image">
                                </a>
                            </div>
                            <div class="small-product-item-info">
                                <h2 class="product-title">
                                    <a href="{{ route('products.category', $category->slug) }}" data-toggle="tooltip" title="{{ translate('See products') }}">{{ $category->getTranslation('name') }}</a>
                                </h2>
                                @php $product_qty = \App\Product::where('category_id', $category->id)->count(); @endphp
                                <div class="product-ratting">
                                    <ul>
                                        <li> {{ $product_qty }} products</li>
                                    </ul>
                                </div>
                                <a class="" href="{{ route('products.category', $category->slug) }}">
                                    {{translate('View products')}} <span class="fas fa-arrow-alt-circle-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
            @endforeach
            <!--  -->
            </div>
            <div class="d-flex flex-row-reverse bd-highlight">
                <div class="bd-highlight">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- SMALL PRODUCT LIST AREA END -->

@endsection