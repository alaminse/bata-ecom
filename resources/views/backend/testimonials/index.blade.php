@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{translate('All Testimonials')}}</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('testimonials.create') }}" class="btn btn-primary">
                <span>{{translate('Add New Testimonial')}}</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header d-block d-md-flex">
        <h5 class="mb-0 h6">{{ __('Testimonials') }}</h5>
        <form class="" id="sort_categories" action="" method="GET">
            <div class="box-inline pad-rgt pull-left">
                <div class="" style="min-width: 200px;">
                    <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type Client name & Enter') }}">
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
                    <th data-breakpoints="lg">{{translate('Photo')}}</th>
                    <th data-breakpoints="lg">{{translate('Designation')}}</th>
                    <th data-breakpoints="lg">{{translate('Opinion')}}</th>
                    <th width="10%" class="text-right">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($testimonials as $key => $testimonial)
                    <tr>
                        <td>{{ ($key+1) + ($testimonials->currentPage() - 1)*$testimonials->perPage() }}</td>
                        <td>{{ $testimonial->client_name }}</td>
                        <td>
                            @if($testimonial->client_photo != null)
                                <img src="{{ uploaded_asset($testimonial->client_photo) }}" alt="{{translate('Client Photo')}}" class="h-50px">
                            @else
                                —
                            @endif
                        </td>
                        <td>{{ $testimonial->designation }}</td>
                        <td>{{ $testimonial->opinion }}</td>
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('testimonials.edit', $testimonial->id)}}" title="{{ translate('Edit') }}">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('testimonials.destroy', $testimonial->id)}}" title="{{ translate('Delete') }}">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $testimonials->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection


@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')
    <script type="text/javascript">
        function update_featured(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('categories.featured') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Featured categories updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>
@endsection
