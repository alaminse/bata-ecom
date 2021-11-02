<!-- PRODUCT AREA START (product-item-3) -->
<div class="ltn__product-area ltn__product-gutter pt-115 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title">{{translate('Best Selling Item')}}</h1>
                </div>
            </div>
        </div>
        <div class="row ltn__tab-product-slider-one-active--- slick-arrow-1">
            @foreach (filter_products(\App\Product::where('published', 1)->orderBy('num_of_sale','DESC'))->limit(12)->get() as $key => $product)
            <!-- ltn__product-item -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                @include('n_frontend.partials.product_box_1',['product' => $product])
            </div>
            @endforeach
            <div class="d-flex flex-row-reverse bd-highlight">
                <div class="bd-highlight">
                    <a class="" href="{{ route('all.products',['sort_by'=>'popular']) }}">
                        {{translate('View all')}} <span class="fas fa-arrow-alt-circle-right"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script type="text/javascript">
        $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
            $('#section_best_selling').html(data);
            AIZ.plugins.slickCarousel();
        });
    </script>
@endpush
<!-- PRODUCT AREA END -->