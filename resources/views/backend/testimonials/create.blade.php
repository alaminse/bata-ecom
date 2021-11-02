@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Client Information')}}</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
                	@csrf

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Client Name')}}</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="{{translate('Client Name')}}" id="client_name" name="client_name" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Client Designation')}}</label>
                        <div class="col-md-9">
                            <select class="select2 form-control aiz-selectpicker" name="designation" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
                                <option value="">{{ translate('Choose One') }}</option>
                                <option value="Founder">{{ translate('Founder') }}</option>
                                <option value="CEO">{{ translate('CEO') }}</option>
                                <option value="CTO">{{ translate('CTO') }}</option>
                                <option value="Manager">{{ translate('Manager') }}</option>
                                <option value="HR">{{ translate('HR') }}</option>
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
                                <input type="hidden" name="client_photo" class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Opinion')}}</label>
                        <div class="col-md-9">
                            <textarea name="opinion" rows="3" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
