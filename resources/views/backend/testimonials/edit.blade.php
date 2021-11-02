@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Client Information')}}</h5>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-body p-0">
                <form class="p-4" action="{{ route('testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PATCH">
                	@csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Client Name')}}</label>
                        <div class="col-md-9">
                            <input type="text" name="client_name" value="{{ $testimonial->client_name }}" class="form-control" id="client_name" placeholder="{{translate('Client Name')}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Designation')}}</label>
                        <div class="col-md-9">
                            <select class="select2 form-control aiz-selectpicker" name="designation" data-toggle="select2" data-placeholder="Choose ..."data-live-search="true" data-selected="{{$testimonial->designation}}">
                                <option value="">{{ translate('Choose One') }}</option>
                                <option {{$testimonial->designation == 'Founder' ? 'selected' : ''}} value="Founder">{{ translate('Founder') }}</option>
                                <option {{$testimonial->designation == 'CEO' ? 'selected' : ''}} value="CEO">{{ translate('CEO') }}</option>
                                <option {{$testimonial->designation == 'CTO' ? 'selected' : ''}} value="CTO">{{ translate('CTO') }}</option>
                                <option {{$testimonial->designation == 'Manager' ? 'selected' : ''}} value="Manager">{{ translate('Manager') }}</option>
                                <option {{$testimonial->designation == 'HR' ? 'selected' : ''}} value="HR">{{ translate('HR') }}</option>
                            </select>
                        </div>
                    </div>
                    
    	           <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="client_photo">{{translate('Client Photo')}}</label>
                        <div class="col-md-9">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="client_photo" class="selected-files" value="{{ $testimonial->client_photo }}">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Opionion')}}</label>
                        <div class="col-md-9">
                            <textarea name="opinion" rows="3" class="form-control">{{ $testimonial->opinion }}</textarea>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{translate('Update')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
