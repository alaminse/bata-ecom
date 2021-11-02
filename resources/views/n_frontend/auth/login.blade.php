@extends('n_frontend.layouts.app')
@section('title')
    Login
@endsection
@section('content')
    
    <!-- BREADCRUMB AREA START -->
    <div class="text-left bg-overlay-white-30 bg-image py-3"  data-bs-bg="img/bg/14.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">Account</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="index.html"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li>Login</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- LOGIN AREA START -->
    <div class="ltn__login-area pb-65">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area text-center">
                        <h1 class="section-title">{{ translate('Sign In To  Your Account')}}</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="account-login-inner">
                        <form class="ltn__form-box contact-form-box" role="form" action="{{ route('login') }}" method="POST">
                            @csrf
                            @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                <input type="text" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ translate('Email Or Phone')}}" name="email" id="email">
                            @else
                                <input type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                            @endif
                            @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                <span class="opacity-60">{{  translate('Use country code before number') }}</span>
                            @endif
                            <input type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ translate('Password')}}" name="password" id="password">
                            <label class="aiz-checkbox py-2">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class=opacity-60>{{  translate('Remember Me') }}</span>
                                <span class="aiz-square-check"></span>
                            </label>
                            <div class="btn-wrapper mt-0">
                                <button class="theme-btn-1 btn btn-block" type="submit">SIGN IN</button>
                            </div>
                            <div class="go-to-btn mt-20">
                                <a href="{{ route('password.request') }}"><small>{{ translate('FORGOTTEN YOUR PASSWORD?')}}</small></a>
                            </div>
                        </form>
                    </div>
                </div>
                
                @if (env("DEMO_MODE") == "On")
                <div class="mb-5">
                    <table class="table table-bordered mb-0">
                        <tbody>
                            <tr>
                                <td>{{ translate('Seller Account')}}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" onclick="autoFillSeller()">{{ translate('Copy credentials') }}</button>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ translate('Customer Account')}}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" onclick="autoFillCustomer()">{{ translate('Copy credentials') }}</button>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ translate('Delivery Boy Account')}}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" onclick="autoFillDeliveryBoy()">{{ translate('Copy credentials') }}</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif

            @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1)
                <div class="separator mb-3">
                    <span class="bg-white px-3 opacity-60">{{ translate('Or Login With')}}</span>
                </div>
                <ul class="list-inline social colored text-center mb-5">
                    @if (get_setting('facebook_login') == 1)
                        <li class="list-inline-item">
                            <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                <i class="lab la-facebook-f"></i>
                            </a>
                        </li>
                    @endif
                    @if(get_setting('google_login') == 1)
                        <li class="list-inline-item">
                            <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                <i class="lab la-google"></i>
                            </a>
                        </li>
                    @endif
                    @if (get_setting('twitter_login') == 1)
                        <li class="list-inline-item">
                            <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                <i class="lab la-twitter"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            @endif
                <div class="col-lg-6">
                    <div class="account-create text-center pt-50">
                        <h4>{{ translate('DONT HAVE AN ACCOUNT?')}}</h4>
                        <p>Add items to your wishlistget personalised recommendations <br>
                            check out more quickly track your orders register</p>
                        <div class="btn-wrapper">
                            <a href="{{ route('user.registration') }}" class="theme-btn-1 btn black-btn">{{ translate('CREATE ACCOUNT')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- LOGIN AREA END -->
@endsection

@section('script')
    <script type="text/javascript">
        function autoFillSeller(){
            $('#email').val('seller@example.com');
            $('#password').val('123456');
        }
        function autoFillCustomer(){
            $('#email').val('customer@example.com');
            $('#password').val('123456');
        }
        function autoFillDeliveryBoy(){
            $('#email').val('deliveryboy@example.com');
            $('#password').val('123456');
        }
    </script>
@endsection