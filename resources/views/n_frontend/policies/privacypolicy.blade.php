@extends('n_frontend.layouts.app')

@section('content')
@php
    $privacy_policy =  \App\Page::where('type', 'privacy_policy_page')->first();
@endphp
<!-- BREADCRUMB AREA START -->
<div style="margin-bottom: 35px!important; padding-top: 80px!important; padding-bottom: 40px!important;" class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="{{ asset('public/assets/img/bg.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">{{ $privacy_policy->getTranslation('title') }}</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li>
                                <a href="{{ route('home') }}">
                                    <span class="ltn__secondary-color"><i class="fas fa-home"></i></span>
                                    {{ translate('Home') }}
                                </a>
                            </li>
                            <li>{{ translate('privacypolicy') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMB AREA END -->
<section class="mb-4">
    <div class="container">
        <div class="p-4 bg-white rounded shadow-sm overflow-hidden mw-100 text-left">
            @php
                echo $privacy_policy->getTranslation('content');
            @endphp
        </div>
    </div>
</section>
@endsection
