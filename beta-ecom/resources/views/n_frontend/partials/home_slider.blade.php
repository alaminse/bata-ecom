<div class="ltn__slide-active-2 slick-slide-arrow-1 slick-slide-dots-1">
    <!-- ltn__slide-item -->
    @if (get_setting('home_slider_images') != null)
    @php $slider_images = json_decode(get_setting('home_slider_images'), true);  @endphp
        @foreach ($slider_images as $key => $value)
        <div class="ltn__slide-item ltn__slide-item-10 section-bg-1 bg-image" data-bs-bg="{{ uploaded_asset($slider_images[$key]) }}" alt="{{ env('APP_NAME')}} promo" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
            <div class="ltn__slide-item-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-7 col-sm-7 align-self-center">
                            <div class="slide-item-info">
                                <div class="slide-item-info-inner ltn__slide-animation">
                                    <h5 class="slide-sub-title ltn__secondary-color animated text-uppercase"></h5>
                                    <h1 class="slide-title  animated">{{translate('Gold Standard')}} <br>{{translate('Pre-Workout')}}</h1>
                                    <h5 class="color-orange  animated">{{translate('Starting at &16.99')}}</h5>
                                    <div class="slide-brief animated d-none">
                                        <p>{{translate('Predictive analytics is drastically changing the real estate industry. In the past, providing data for quick')}}</p>
                                    </div>
                                    <div class="btn-wrapper  animated">
                                        <a href="{{route('all.products')}}" class="theme-btn-1 btn btn-effect-1 text-uppercase">{{translate('Shop now')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>