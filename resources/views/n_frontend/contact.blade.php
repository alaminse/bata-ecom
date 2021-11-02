@extends('n_frontend.layouts.app')

@section('content')
    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="{{ asset('public/frontend/img/bg/14.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">{{ translate('Contact Us') }}</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="{{ route('home') }}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span>{{ translate('Home') }}</a></li>
                                <li>{{ translate('Contact') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- CONTACT ADDRESS AREA START -->
    <div class="ltn__contact-address-area mb-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                        <div class="ltn__contact-address-icon">
                            <img src="{{ asset('public/frontend/img/icons/10.png') }}" alt="Icon Image">
                        </div>
                        <h3>{{ translate('Email Address') }}</h3>
                        <p><a href="mailto:{{ get_setting('contact_email') }}">{{ get_setting('contact_email')  }}</a></p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                        <div class="ltn__contact-address-icon">
                            <img src="{{ asset('public/frontend/img/icons/11.png') }}" alt="Icon Image">
                        </div>
                        <h3>{{ translate('Phone Number') }}</h3>
                        <p><a href="{{ get_setting('contact_phone') }}">{{ get_setting('contact_phone') }}</a></p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                        <div class="ltn__contact-address-icon">
                            <img src="{{ asset('public/frontend/img/icons/12.png') }}" alt="Icon Image">
                        </div>
                        <h3>{{ translate('Office Address') }}</h3>
                        <p>{{ get_setting('contact_address',null,App::getLocale()) }}<br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTACT ADDRESS AREA END -->

    <!-- CONTACT MESSAGE AREA START -->
    <div class="ltn__contact-message-area mb-120 mb--100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__form-box contact-form-box box-shadow white-bg">
                        <h4 class="title-2">{{ translate('Send a Message') }}</h4>
                        <form id="contact-form" action="{{ route('contact.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-item input-item-name ltn__custom-icon">
                                        <input type="text" name="name" placeholder="Enter your name" value="{{ (Auth::check())? Auth::user()->name : old('name') }}" required @if(Auth::check()) readonly @endif>
                                        @if ($errors->has('name'))
                                            <span class="" style="color:#ab2d50;" role="alert">
                                                <small>{{ $errors->first('name') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-item-email ltn__custom-icon">
                                        <input type="email" name="email" placeholder="Enter email address" value="{{ (Auth::check())? Auth::user()->email : old('email') }}" required @if(Auth::check()) readonly @endif>
                                        @if ($errors->has('email'))
                                            <span class="" style="color:#ab2d50;" role="alert">
                                                <small>{{ $errors->first('email') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-item-phone ltn__custom-icon">
                                        <input type="text" name="phone" placeholder="Enter phone number" value="{{ (Auth::check())? Auth::user()->addresses[0]->phone : old('phone') }}" required @if(Auth::check()) readonly @endif>
                                        @if ($errors->has('phone'))
                                            <span class="" style="color:#ab2d50;" role="alert">
                                                <small>{{ $errors->first('phone') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-item-textarea ltn__custom-icon">
                                        <input type="text" name="subject" placeholder="Enter subject" value="{{ old('subject') }}" required @if(Auth::check()) readonly @endif>
                                        @if ($errors->has('subject'))
                                            <span class="" style="color:#ab2d50;" role="alert">
                                                <small>{{ $errors->first('subject') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="input-item input-item-textarea ltn__custom-icon">
                                <textarea name="message" placeholder="Enter message">{{ old('message') }}</textarea>
                                @if ($errors->has('message'))
                                    <span class="" style="color:#ab2d50;" role="alert">
                                        <small>{{ $errors->first('message') }}</small>
                                    </span>
                                @endif
                            </div>
                            {{--<p><label class="input-info-save mb-0"><input type="checkbox" name="agree"> Save my name, email, and website in this browser for the next time I comment.</label></p>--}}
                            <div class="btn-wrapper mt-0">
                                <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">Send message</button>
                            </div>
                            <p class="form-messege mb-0 mt-20"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTACT MESSAGE AREA END -->

    <!-- GOOGLE MAP AREA START -->
    <div class="google-map mb-120">

        <iframe src="https://maps.google.com/maps?q=shyamoli%20road-1%20dhaka,%20bangladesh&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="85%" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

    </div>
    <!-- GOOGLE MAP AREA END -->
@endsection
