@extends('n_frontend.layouts.app')
@section('title')
    Home
@endsection
@section('content')
    @include('n_frontend.partials.slider')
    @include('n_frontend.feature.feature')
    @include('n_frontend.product.product__tab')

    

    <!-- ABOUT US AREA START -->
    {{-- <div class="ltn__about-us-area bg-image pt-115 pb-110 d-none" data-bs-bg="{{ asset('public/frontend/img/bg/26.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="about-us-img-wrap about-img-left">
                        <!-- <img src="{{ asset('public/frontend/img/others/7.png') }}" alt="About Us Image"> -->
                    </div>
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="about-us-info-wrap">
                        <div class="section-title-area ltn__section-title-2--- mb-20">
                            <h6 class="section-subtitle section-subtitle-2--- ltn__secondary-color">N95 Facial Covering Mask</h6>
                            <h1 class="section-title">Grade A Safety Masks
                                For Sale. Haurry Up!</h1>
                            <p>Over 39,000 people work for us in more than 70 countries all over the
                                This breadth of global coverage, combined with specialist services</p>
                        </div>
                        <ul class="ltn__list-item-half clearfix">
                            <li>
                                <i class="flaticon-home-2"></i>
                                Activated Carbon
                            </li>
                            <li>
                                <i class="flaticon-mountain"></i>
                                Breathing Valve
                            </li>
                            <li>
                                <i class="flaticon-heart"></i>
                                6 Layer Filteration
                            </li>
                            <li>
                                <i class="flaticon-secure"></i>
                                Rewashes & Reusable
                            </li>
                        </ul>
                        <div class="btn-wrapper animated">
                            <a href="service.html" class="ltn__secondary-color text-uppercase text-decoration-underline">View Products</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}
    <!-- ABOUT US AREA END -->

    @include('n_frontend.countdown.countdown')
    @include('n_frontend.product.product')
    @include('n_frontend.product.small__product');
    @include('n_frontend.others.video')
    @include('n_frontend.others.testimonial')
    @include('n_frontend.blog.blog__3')
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $.post('{{ route('home.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_featured').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_selling').html(data);
                AIZ.plugins.slickCarousel();
            });
            /*$.post('{{ route('home.section.auction_products') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#auction_products').html(data);
                AIZ.plugins.slickCarousel();
            });*/
            $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_home_categories').html(data);
                AIZ.plugins.slickCarousel();
            });

            {{-- @if (get_setting('vendor_system_activation') == 1) --}}
            // $.post('{{ route('home.section.best_sellers') }}', {_token:'{{ csrf_token() }}'}, function(data){
            //     $('#section_best_sellers').html(data);
            //     AIZ.plugins.slickCarousel();
            // });
            {{-- @endif --}}
        });
    </script>
@endsection