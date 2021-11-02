 <!-- TESTIMONIAL AREA START (testimonial-4) -->
 <div class="ltn__testimonial-area section-bg-1 pt-290 pb-70">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h6 class="section-subtitle ltn__secondary-color">{{__('Testimonials')}}</h6>
                    <h1 class="section-title">{{translate('Clients Feedbacks')}}<span>.</span></h1>
                </div>
            </div>
        </div>
        <div class="row ltn__testimonial-slider-3-active slick-arrow-1 slick-arrow-1-inner">
            @foreach(\App\Testimonial::orderBy('created_at', 'DESC')->cursor() as $testimonial)
            <div class="col-lg-12">
                <div class="ltn__testimonial-item ltn__testimonial-item-4">
                    <div class="ltn__testimoni-img">
                        <img src="{{ uploaded_asset($testimonial->client_photo) }}" alt="{{translate('Client Photo')}}">
                    </div>
                    <div class="ltn__testimoni-info">
                        <p>{{$testimonial->opinion}}</p>
                        <h4>{{$testimonial->client_name}}</h4>
                        <h6>{{Str::limit($testimonial->designation, 100)}}</h6>
                    </div>
                    <div class="ltn__testimoni-bg-icon">
                        <i class="far fa-comments"></i>
                    </div>
                </div>
            </div>
            @endforeach
            <!--  -->
        </div>
    </div>
</div>
<!-- TESTIMONIAL AREA END -->