<div class="modal fade" id="new-address-modal" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true"  tabindex="-1">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">{{ translate('New Address')}}</h6>
                {{-- Note: This button is commented because it breaks the layout --}}
                {{--<button type="button" class="close" data-dismiss="modal">--}}
                {{-- <span aria-hidden="true"></span> --}}
                {{--</button>--}}
            </div>
            <form class="form-default" role="form" action="{{ route('addresses.store') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 input-item input-item-name ltn__custom-icon">
                            <label>{{ translate('Address')}}</label>
                            <textarea class="" placeholder="{{ translate('Your Address')}}" rows="1" name="address" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>{{ translate('City')}}</label>
                            <div class="input-item">
                                <input type="hidden" name="country" value="Bangladesh">
                                <select class="nice-select" data-live-search="true" name="city" id="city" required>
                                    <option style="position: absolute;" value="">{{ translate('Select City') }}</option>
                                    @foreach(\App\City::where('country_id', 18)->get() as $city)
                                        <option style="position: absolute;" value="{{ $city->name }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label>{{ translate('Postal code')}}</label>
                            <div class="input-item">
                                <input type="text"  placeholder="{{ translate('Your Postal Code')}}" name="postal_code" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>{{ translate('Phone')}}</label>
                            <div class="input-item">
                                <input type="text" placeholder="{{ translate('+880')}}" name="phone" value="" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn theme-btn-1 btn-effect-1 text-uppercase">{{  translate('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="edit-address-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ translate('Address Edit') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="edit_modal_body">

            </div>
        </div>
    </div>
</div>