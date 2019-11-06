@extends('layouts/adminHeader')
@section('content')
    <div class="block-header">
        <h2>{{ trans('message.category') }}</h2>
    </div>
    
    <div class="row clearfix">
        <table class="table table-hover" id="category">
            <thead>
                <tr>
                    <th>{{ trans('message.id') }}</th>
                    <th>{{ trans('message.title') }}</th>
                    <th>{{ trans('message.created_at') }}</th>
                    <th>{{ trans('message.action') }}</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('script')
    <script src="{{ asset('/') }}bower_components/MyCSSJS/category.js"></script>

    {{-- <script>
        $('#category').DataTable({
    processing: true,
    serverSide: true,
    ajax: route('category.datatable'),
    columns: [
        { data: 'id', name: 'id' },
        { data: 'title', name: 'title' },
        { data: 'created_at', name: 'created_at' },
        { data: 'action', name: 'action' },
    ],
});
    </script> --}}
@endsection