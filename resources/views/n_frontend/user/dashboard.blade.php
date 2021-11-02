@extends('n_frontend.layouts.app')
@section('title')
    Profile
@endsection
@section('content')
    <!-- BREADCRUMB AREA START -->
    <div class="text-left bg-overlay-white-30 bg-image py-4"  data-bs-bg="img/bg/14.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">My Account</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="index.html"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li>My Account</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->
     <!-- WISHLIST AREA START -->
     <div class="liton__wishlist-area pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- PRODUCT TAB AREA START -->
                    <div class="ltn__product-tab-area" id="test">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="ltn__tab-menu-list mb-50">
                                        <div class="nav">
                                            <a class="{{ !isset($_GET['show_orders']) ? 'active show': null }}" data-bs-toggle="tab" href="#liton_tab_1_1">{{ translate('Dashboard') }}<i class="fas fa-home"></i></a>
                                            <a class="{{ isset($_GET['show_orders']) ? 'active show': null }}" data-bs-toggle="tab" href="#liton_tab_1_2">{{ translate('Orders') }}<i class="fas fa-file-alt"></i></a>
                                            <a data-bs-toggle="tab" href="#liton_tab_1_4">{{translate('Address')}}<i class="fas fa-map-marker-alt"></i></a>
                                            <a data-bs-toggle="tab" href="#liton_tab_1_5">{{ translate('Account Details') }}<i class="fas fa-user"></i></a>
                                            <a href="{{ route('logout') }}">{{ translate('Logout') }}<i class="fas fa-sign-out-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="tab-content">
                                        <div class="tab-pane fade {{ !isset($_GET['show_orders']) ? 'active show': null }}" id="liton_tab_1_1">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <p>Hello <strong>{{ Auth::user()->name }}</strong> (not <strong>{{ Auth::user()->name }}</strong>? <small><a href="{{ route('logout') }}">Log out</a></small> )</p>
                                                <p>From your account dashboard you can view your <span>recent orders</span>, manage your <span>shipping and billing addresses</span>, and <span>edit your password and account details</span>.</p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade {{ isset($_GET['show_orders']) ? 'active show': null }}" id="liton_tab_1_2">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Order</th>
                                                                <th>Date</th>
                                                                <th>Delivery Status</th>
                                                                <th>Payment Status</th>
                                                                <th>Total</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach (\App\Order::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->orderBy('code', 'desc')->get() as $key => $order)
                                                            <tr>
                                                                <td>{{ $key+1 }}</td>
                                                                <td>{{ date('d m Y', $order->date) }}</td>
                                                                <td>
                                                                    {{ translate(ucfirst(str_replace('_', ' ', $order->orderDetails->first()->delivery_status))) }}
                                                                    @if($order->delivery_viewed == 0)
                                                                        <span class="ml-2" style="color:green"><strong>*</strong></span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($order->payment_status == 'paid')
                                                                        <span class="badge badge-inline badge-success">{{translate('Paid')}}</span>
                                                                    @else
                                                                        <span class="badge badge-inline badge-danger">{{translate('Unpaid')}}</span>
                                                                    @endif
                                                                    @if($order->payment_status_viewed == 0)
                                                                        <span class="ml-2" style="color:green"><strong>*</strong></span>
                                                                    @endif
                                                                </td>
                                                                <td>{{ single_price($order->grand_total) }}</td>
                                                                <td><a href="cart.html">View</a></td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="liton_tab_1_4">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <p>The following addresses will be used on the checkout page by default.</p>
                                                <div class="row" id="address">
                                                    <div class="col-md-6 mx-auto mb-3" >
                                                        <div class="border p-3 rounded mb-3 c-pointer text-center bg-white h-100 d-flex flex-column justify-content-center" onclick="add_new_address()">
                                                            <i class="fa fa-plus la-2x mb-3"></i>
                                                            <div class="alpha-7">{{ translate('Add New Address') }}</div>
                                                        </div>
                                                    </div>
                                                    @foreach (\Illuminate\Support\Facades\Auth::user()->addresses as $key => $address)
                                                        <div class="col-md-6 col-12 learts-mb-30">
                                                            <div class="card card-body">
                                                                <h4>@if($address->set_default) Shipping @else Your @endif Address
                                                                    <small>
                                                                        <button
                                                                                class="badge badge-success"
                                                                                onclick="show_edit_form(
                                                                                        '{{ $address->address }}',
                                                                                        '{{ $address->city }}',
                                                                                        '{{ $address->postal_code }}',
                                                                                        '{{ $address->phone }}',
                                                                                         {{ $address->set_default }},
                                                                                         {{ $address->id }}
                                                                                        );"
                                                                                style="width: 40px!important;">edit
                                                                        </button>
                                                                    </small>
                                                                </h4>
                                                                <address>
                                                                    <p><strong>{{ $address->address }}</strong>
                                                                        @if($address->set_default == 1)
                                                                            <span class="badge badge-primary" style="width: 58px!important;">
                                                                            Default
                                                                        </span>
                                                                        @endif
                                                                    </p>
                                                                    <p>{{ $address->city }}, {{ $address->postal_code }} <br>
                                                                        {{ $address->country }} </p>
                                                                    <p>Mobile: {{ $address->phone }}</p>
                                                                </address>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="row" id="address_edit">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4>Update Your Adress</h4>
                                                            <button
                                                                class="badge badge-danger"
                                                                style="width: 23px!important;"
                                                                onclick="hideForm();">
                                                                X
                                                            </button>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="ltn__form-box">
                                                                <form action="{{ route('customer.address.update') }}" method="POST">
                                                                    @csrf
                                                                    <div class="row mb-50">
                                                                        <div class="col-md-6">
                                                                            <label>{{ translate('Address') }}:</label>
                                                                            <input type="text" name="house_address" id="house_address">
                                                                            <input type="hidden" name="address_id" id="address_id">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label>{{ translate('City') }}:</label>
                                                                            <select name="city" class="select">
                                                                                @foreach (\App\City::where('country_id', 18)->get() as $city)
                                                                                    <option value="{{ translate($city->name) }}">{{ translate($city->name) }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-50">
                                                                        <div class="col-md-6">
                                                                            <label>{{ translate('Contact Number') }}:</label>
                                                                            <input type="text" name="phone" id="phone">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label>{{ translate('Postal Code') }}:</label>
                                                                            <input type="text" name="postal_code" id="postal_code">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-50">
                                                                        <div class="col-md-6">
                                                                            <input id="is_default" type="checkbox" name="is_default" value="1">
                                                                            <label>{{ translate('Make Default') }}</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="btn-wrapper">
                                                                        <button type="submit" class="btn theme-btn-1 btn-effect-1 text-uppercase">{{ translate('Save Changes') }}</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="liton_tab_1_5">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Basic Information</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="ltn__form-box">
                                                        <form action="{{ route('customer.profile.update') }}" method="POST">
                                                            @csrf
                                                            <div class="row mb-50">
                                                                <div class="col-md-6">
                                                                    <label>{{ translate('Name') }}:</label>
                                                                    <input type="text" name="name" value="{{ \Illuminate\Support\Facades\Auth::user()->name }}" >
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label>{{ translate('Phone') }}:</label>
                                                                    <input type="text" name="phone" value="{{ Auth::user()->phone }}" >
                                                                </div>
                                                            </div>
                                                            <div class="row mb-50">
                                                                <label class="col-md-2 col-form-label">{{ translate('Photo') }}</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                                                        </div>
                                                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                                        <input type="hidden" name="photo" value="{{ Auth::user()->avatar_original }}" class="selected-files">
                                                                    </div>
                                                                    <div class="file-preview box sm">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <fieldset>
                                                                <legend>Password change</legend>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <label>New password (leave blank to leave unchanged):</label>
                                                                        <input type="password" name="new_password">
                                                                        <label>Confirm new password:</label>
                                                                        <input type="password" name="confirm_password">
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            <div class="btn-wrapper">
                                                                <button type="submit" class="btn theme-btn-1 btn-effect-1 text-uppercase">{{ translate('Save Changes') }}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Update Email Adress</h4>
                                                </div>
                                                <div class="card card-body">
                                                <div class="ltn__form-box">
                                                    <form action="{{ route('user.change.email') }}" method="POST">
                                                        @csrf
                                                        <div class="row mb-50">
                                                            <div class="col-md-9">
                                                                <input type="email" name="email" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <button type="button" class="btn btn-outline-secondary new-email-verification pull-right">
                                                                    <span class="d-none loading">
                                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                                        {{ translate('Sending Email...') }}
                                                                    </span>
                                                                    <span class="default">{{ translate('Verify') }}</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="btn-wrapper">
                                                            <button type="submit" class="btn theme-btn-1 btn-effect-1 text-uppercase">{{ translate('Save Changes') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- PRODUCT TAB AREA END -->
                </div>
            </div>
        </div>
    </div>
    <!-- WISHLIST AREA START -->
@endsection

@section('modal')
    @include('n_frontend.address_modal')
@endsection

@section('script')
    <script type="text/javascript">
        $('.new-email-verification').on('click', function() {
            $(this).find('.loading').removeClass('d-none');
            $(this).find('.default').addClass('d-none');
            var email = $("input[name=email]").val();

            $.post('{{ route('user.new.verify') }}', {_token:'{{ csrf_token() }}', email: email}, function(data){
                data = JSON.parse(data);
                $('.default').removeClass('d-none');
                $('.loading').addClass('d-none');
                if(data.status == 2)
                    AIZ.plugins.notify('warning', data.message);
                else if(data.status == 1)
                    AIZ.plugins.notify('success', data.message);
                else
                    AIZ.plugins.notify('danger', data.message);
            });
        });

        function hideForm () {
            $('#address').show();
            $('#address_edit').hide();
        }

        $(function () {
            hideForm();
        });

        function show_edit_form(address, city, postal_code, phone, set_default, address_id) {
            $('#address_id').val(address_id);
            $('#house_address').val(address);
            $('#city').val(city);
            $('#postal_code').val(postal_code);
            $('#phone').val(phone);
            console.log(address_id);
            if (set_default == 1) {
                $('#is_default').prop('checked', true);
            } else {
                $('#is_default').prop('checked', false);
            }

            $('#address').hide();
            $('#address_edit').show();
        };

        $(document).on('change', '[name=country]', function() {
            var country = $(this).val();
            get_city(country);
        });

        function get_city(country) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('get-city')}}",
                type: 'POST',
                data: {
                    country_name: country
                },
                success: function (response) {
                    var obj = JSON.parse(response);
                    if(obj != '') {
                        $('[name="city"]').html(obj);
                        AIZ.plugins.bootstrapSelect('refresh');
                    }
                }
            });
        }

        function add_new_address(){
            window.scrollTo(0,document.querySelector("#test").scrollHeight);
            $('#new-address-modal').modal('show');
        };

    </script>

@endsection