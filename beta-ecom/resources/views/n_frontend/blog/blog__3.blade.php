<!-- BLOG AREA START (blog-3) -->
<div class="ltn__blog-area pt-115 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2--- text-center">
                    <h6 class="section-subtitle section-subtitle-2--- ltn__secondary-color">{{ translate('News & Blogs')}}</h6>
                    <h1 class="section-title">{{ translate('Leatest News Feeds') }}</h1>
                </div>
            </div>
        </div>
        <div class="row  ltn__blog-slider-one-active slick-arrow-1 ltn__blog-item-3-normal">
            <!-- Blog Item -->
            @foreach (\App\Blog::where('status', 1)->orderBy('created_at', 'desc')->take(12)->get() as $key => $blog)
            <div class="col-lg-12">
                <div class="ltn__blog-item ltn__blog-item-3">
                    <div class="ltn__blog-img">
                        <a href="{{ url("blog").'/'. $blog->slug }}">
                            <img
                                src="{{ uploaded_asset($blog->banner) }}"
                                data-src="{{ uploaded_asset($blog->banner) }}"
                                alt="{{ $blog->title }}"
                            >
                        </a>
                    </div>
                    <div class="ltn__blog-brief">
                        <div class="ltn__blog-meta">
                            <ul>
                                <li class="ltn__blog-author">
                                    <a href="#"><i class="far fa-user"></i>by: {{ env('APP_NAME')}}</a>
                                </li>
                                <li class="ltn__blog-tags">
                                    <a href="#"><i class="fas fa-tags"></i>{{ $blog->category->category_name }}</a>
                                </li>
                            </ul>
                        </div>
                        <h3 class="ltn__blog-title">
                            <a href="{{ url("blog").'/'. $blog->slug }}">
                                {{ $blog->title }}
                            </a>
                        </h3>
                        <div class="ltn__blog-meta-btn">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>{{ date('d-m-Y', strtotime($blog->created_at)) }}</li>
                                </ul>
                            </div>
                            <div class="ltn__blog-btn">
                                <a href="{{ url("blog").'/'. $blog->slug }}">
                                    {{ translate('Read More') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="bd-highlight">
                <a class="" href="{{ route('all.products',['sort_by'=>'popular']) }}">
                    {{translate('View all')}} <span class="fas fa-arrow-alt-circle-right"></span>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- BLOG AREA END -->