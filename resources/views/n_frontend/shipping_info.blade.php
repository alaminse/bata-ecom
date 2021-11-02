@extends('n_frontend.layouts.app')

@section('content')

<style>
    .nice-select.open .list {
        max-height: 200px;
        overflow: scroll;
    }
    /*dropdown*/
    .dropdown-toggle {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
    }
    .dropdown-toggle::after {
        border: 0;
        content: "\f107";
        font-family: "Line Awesome Free";
        font-weight: 900;
        font-size: 80%;
        margin-left: 0.3rem;
    }
    .dropup .dropdown-toggle::after {
        border: 0;
        content: "\f106";
    }
    .dropdown-toggle.no-arrow::after {
        content: none;
    }
    .dropdown-menu {
        border-color: #e2e5ec;
        margin: 0;
        border-radius: 0;
        min-width: 14rem;
        font-size: inherit;
        padding: 0;
        -webkit-box-shadow: 0 0 50px 0 rgba(82, 63, 105, 0.15);
        box-shadow: 0 0 50px 0 rgba(82, 63, 105, 0.15);
        padding: 0.5rem 0;
        border-radius: 4px;
        max-width: 100%;
    }
    .dropdown-menu-animated {
        display: block;
        visibility: hidden;
        opacity: 0;
        -webkit-transition: margin-top 0.3s, visibility 0.3s, opacity 0.3s;
        transition: margin-top 0.3s, visibility 0.3s, opacity 0.3s;
        margin-top: 20px !important;
    }
    .show.dropdown-menu {
        visibility: visible;
        opacity: 1;
        margin-top: 0 !important;
    }
    .dropdown-menu.dropdown-menu-xs {
        width: 160px;
        min-width: 160px;
    }
    .dropdown-menu.dropdown-menu-sm {
        width: 240px;
        min-width: 240px;
    }
    .dropdown-menu.dropdown-menu-md {
        width: 260px;
        min-width: 260px;
    }
    .dropdown-menu.dropdown-menu-lg {
        width: 320px;
        min-width: 320px;
    }
    .dropdown-menu.dropdown-menu-xl {
        width: 380px;
        min-width: 380px;
    }
    .dropdown-item {
        display: block;
        width: 100%;
        padding: 0.5rem 1.5rem;
        clear: both;
        font-weight: 400;
        color: #74788d;
        text-align: inherit;
        white-space: nowrap;
        background-color: transparent;
        border: 0;
    }
    .dropdown-item.active,
    .dropdown-item:hover,
    .dropdown-item:active {
        color: #fff !important;
        background-color: var(--primary);
    }

    .bootstrap-select .dropdown-menu .inner::-webkit-scrollbar {
        width: 4px;
        background: rgba(24, 28, 41, 0.08);
        border-radius: 3px;
    }
    .bootstrap-select .dropdown-menu .inner::-webkit-scrollbar-track {
        background: transparent;
    }
    .bootstrap-select .dropdown-menu .inner::-webkit-scrollbar-thumb {
        background: rgba(24, 28, 41, 0.1);
        border-radius: 3px;
    }
    .bootstrap-select .dropdown-menu .inner {
        scrollbar-color: rgba(24, 28, 41, 0.08);
        scrollbar-width: thin;
    }
    /*bootstrap select */
    .bootstrap-select .dropdown-toggle:focus,
    .bootstrap-select > select.mobile-device:focus + .dropdown-toggle {
        outline: none !important;
    }
    .bootstrap-select .dropdown-toggle {
        color: #898b92;
        background-color: transparent !important;
        border-color: #e2e5ec;
    }
    .bootstrap-select.form-control-sm .dropdown-toggle {
        padding: 0.416rem 0.7rem;
        height: calc(1.5rem + 0.8rem + 2px);
    }
    .bootstrap-select.form-control-lg .dropdown-toggle {
        height: calc(1.5rem + 1.5rem + 2px);
        padding: 0.75rem 1rem;
        font-size: 1rem;
    }
    .bootstrap-select .dropdown-toggle:active,
    .bootstrap-select .dropdown-toggle:focus,
    .show.bootstrap-select .dropdown-toggle {
        border-color: var(--primary) !important;
    }
    .bootstrap-select .dropdown-menu .selected span.check-mark {
        right: 12px;
        top: 11px;
    }
    .bootstrap-select .bs-ok-default:after {
        width: 6px;
        height: 12px;
        border-width: 0 2px 2px 0;
        border-color: #6f6f80;
    }
    .dropdown-item:hover .bs-ok-default:after {
        border-color: #fff;
    }
    .bootstrap-select .no-results {
        padding: 8px 10px;
        background: #f5f5f5;
        margin: 0 8px;
        border-radius: 3px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 100%;
    }
    .bootstrap-select .dropdown-menu .notify {
        width: calc(100% - 20px);
        margin: 0 10px;
        min-height: 26px;
        padding: 8px 12px;
        background: #f2f3f8;
        border: 1px solid #e3e3e3;
        border-radius: 3px;
        -webkit-box-shadow: none;
        box-shadow: none;
        opacity: 1;
    }
    .bootstrap-select .notify.fadeOut {
        -webkit-animation: bs-notify-fadeOut 2s linear 0.2s;
        -o-animation: bs-notify-fadeOut 2s linear 0.2s;
        animation: bs-notify-fadeOut 2s linear 0.2s;
    }
    .bootstrap-select .bs-actionsbox .btn-group button:first-child {
        border-right: 1px solid #fff;
    }

    .bootstrap-select .bs-actionsbox .btn-group button:last-child {
        border-left: 1px solid #fff;
    }

    .bootstrap-select .bs-actionsbox .btn-group button {
        padding: 0.6rem 0.5rem;
        line-height: 1;
    }
    .bootstrap-select .dropdown-menu li,
    .bootstrap-select .dropdown-toggle .filter-option-inner-inner {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .bootstrap-select .dropdown-menu li a span.text {
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        margin-right: 0;
        vertical-align: bottom;
    }
    [dir="rtl"] .bootstrap-select .dropdown-toggle .filter-option{
        float: right;
        text-align: right;
    }
</style>

<section class="pt-5 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="row aiz-steps arrow-divider">
                    <div class="col done">
                        <div class="text-center text-success">
                            <i class="la-3x mb-2 fas fa-shopping-cart"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block ">{{ translate('1. My Cart')}}</h3>
                        </div>
                    </div>
                    <div class="col active">
                        <div class="text-center text-primary">
                            <i class="la-3x mb-2 fas fa-map"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block ">{{ translate('2. Shipping info')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 fas fa-truck"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 ">{{ translate('3. Delivery info')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 fas fa-credit-card"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 ">{{ translate('4. Payment')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 fas fa-check-circle"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 ">{{ translate('5. Confirmation')}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mb-4 gry-bg" id="test">
    <div class="container">
        <div class="row cols-xs-space cols-sm-space cols-md-space">
            <div class="col-xxl-8 col-xl-10 mx-auto">
                <form class="form-default" data-toggle="validator" action="{{ route('checkout.store_shipping_infostore') }}" role="form" method="POST">
                    @csrf
                        @if(Auth::check())
                        <div class="shadow-sm bg-white p-4 rounded mb-4">
                            <div class="row gutters-5">
                                @foreach (Auth::user()->addresses as $key => $address)
                                    <div class="col-md-6 mb-3">
                                        <label class="aiz-megabox d-block bg-white mb-0">
                                            <input type="radio" name="address_id" value="{{ $address->id }}" @if ($address->set_default)
                                                checked
                                            @endif required>
                                            <span class="d-flex p-3 aiz-megabox-elem">
                                                <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                <span class="flex-grow-1 pl-3 text-left">
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Address') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->address }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Postal Code') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->postal_code }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-60">{{ translate('City') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->city }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Country') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->country }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Phone') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->phone }}</span>
                                                    </div>
                                                </span>
                                            </span>
                                        </label>
                                        <div class="dropdown position-absolute right-0 top-0">
                                            <button class="btn bg-gray px-2" type="button" data-toggle="dropdown">
                                                <i class="la la-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" onclick="edit_address('{{$address->id}}')">
                                                    {{ translate('Edit') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <input type="hidden" name="checkout_type" value="logged">
                                <div class="col-md-6 mx-auto mb-3" >
                                    <div class="border p-3 rounded mb-3 c-pointer text-center bg-white h-100 d-flex flex-column justify-content-center" onclick="add_new_address()">
                                        <i class="fa fa-plus la-2x mb-3"></i>
                                        <div class="alpha-7">{{ translate('Add New Address') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                            <div class="shadow-sm bg-white p-4 rounded mb-4">
                                <div class="form-group">
                                    <label class="control-label">{{ translate('Name')}}</label>
                                    <input type="text" class="form-control" name="name" placeholder="{{ translate('Name')}}" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">{{ translate('Email')}}</label>
                                    <input type="text" class="form-control" name="email" placeholder="{{ translate('Email')}}" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">{{ translate('Address')}}</label>
                                    <input type="text" class="form-control" name="address" placeholder="{{ translate('Address')}}" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">{{ translate('Select your country')}}</label>
                                            <select class="form-control aiz-selectpicker" data-live-search="true" name="country">
                                                @foreach (\App\Country::where('status', 1)->get() as $key => $country)
                                                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">

                                            <label class="control-label">{{ translate('City')}}</label>
                                            <select class="form-control aiz-selectpicker" data-live-search="true" name="city" required>
                                                @foreach (\App\City::get() as $key => $city)
                                                    <option value="{{ $city->name }}">{{ $city->getTranslation('name') }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <div class="form-group">

                                            <label class="control-label">{{ translate('City')}}</label>
                                            <select class="form-control aiz-selectpicker" data-live-search="true" name="city" required>
                                                @foreach (\App\City::get() as $key => $city)
                                                    <option value="{{ $city->name }}">{{ $city->getTranslation('name') }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div> --}}
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">{{ translate('Postal code')}}</label>
                                            <input type="text" class="form-control" placeholder="{{ translate('Postal code')}}" name="postal_code" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">{{ translate('Phone')}}</label>
                                            <input type="number" lang="en" min="0" class="form-control" placeholder="{{ translate('Phone')}}" name="phone" required>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="checkout_type" value="guest">
                            </div>
                        @endif
                        <div class="d-flex bd-highlight">
                            <div class="flex-grow-1 bd-highlight">
                                <a href="{{ route('home') }}" class="theme-btn-1 btn btn-effect-1">
                                    <i class="las la-arrow-left"></i>
                                    {{ translate('Return to shop')}}
                                </a>
                            </div>
                            <div class="p-2 bd-highlight">
                                <button type="submit" class="theme-btn-1 btn btn-effect-1">{{ translate('Continue to Delivery Info')}}</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('modal')
    @include('n_frontend.address_modal')
@endsection

@section('script')
    <script type="text/javascript">
        function edit_address(address) {
            var url = '{{ route("addresses.edit", ":id") }}';
            url = url.replace(':id', address);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: 'GET',
                success: function (response) {
                    $('#edit_modal_body').html(response.html);
                    $('#edit-address-modal').modal('show');
                    AIZ.plugins.bootstrapSelect('refresh');

                    var country = $("#edit_country").val();
                    get_city(country);

                    @if (get_setting('google_map') == 1)
                        var lat     = -33.8688;
                        var long    = 151.2195;

                        if(response.data.address_data.latitude && response.data.address_data.longitude) {
                            lat     = parseFloat(response.data.address_data.latitude);
                            long    = parseFloat(response.data.address_data.longitude);
                        }

                        initialize(lat, long, 'edit_');
                    @endif
                }
            });
        }

        // $(document).on('change', '[name=country]', function() {
        //     var country = $(this).val();
        //     get_city(country);
        // });

        {{--function get_city(country) {--}}
            {{--$.ajax({--}}
                {{--headers: {--}}
                    {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                {{--},--}}
                {{--url: "{{route('get-city')}}",--}}
                {{--type: 'POST',--}}
                {{--data: {--}}
                    {{--country_name: country--}}
                {{--},--}}
                {{--success: function (response) {--}}
                    {{--var obj = JSON.parse(response);--}}
                    {{--if(obj != '') {--}}
                        {{--$('[name="city"]').html(obj);--}}
                        {{--AIZ.plugins.bootstrapSelect('refresh');--}}
                    {{--}--}}
                {{--}--}}
            {{--});--}}
        {{--}--}}

        function add_new_address(){
            window.scrollTo(0,document.querySelector("#test").scrollHeight);
            $('#new-address-modal').modal('show');
        }
    </script>

    @if (get_setting('google_map') == 1)
    
        @include('frontend.partials.google_map')
        
    @endif

@endsection
