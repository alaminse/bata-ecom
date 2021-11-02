@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{translate('All Messages From Customers')}}</h1>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-block d-md-flex">
            <h5 class="mb-0 h6">{{ __('Messages') }}</h5>
            <form class="" id="sort_categories" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type email and press enter') }}">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th>{{translate('Client Name')}}</th>
                    <th data-breakpoints="lg">{{translate('Email')}}</th>
                    <th data-breakpoints="lg">{{translate('Phone')}}</th>
                    <th data-breakpoints="lg">{{translate('Message')}}</th>
                    {{--<th width="10%" class="text-right">{{translate('Options')}}</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($contacts as $key => $contact)
                    <tr>
                        <td>{{ ($key+1) + ($contacts->currentPage() - 1)*$contacts->perPage() }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>{{ $contact->message }}</td>
                        {{--<td class="text-right">--}}
                            {{--<a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('testimonials.edit', $testimonial->id)}}" title="{{ translate('Edit') }}">--}}
                                {{--<i class="las la-edit"></i>--}}
                            {{--</a>--}}
                            {{--<a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('testimonials.destroy', $testimonial->id)}}" title="{{ translate('Delete') }}">--}}
                                {{--<i class="las la-trash"></i>--}}
                            {{--</a>--}}
                        {{--</td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $contacts->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
@endsection