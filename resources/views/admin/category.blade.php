@extends('layouts/adminHeader')
@section('content')
    <div class="block-header">
        <h2>{{ trans('message.category') }}</h2>
    </div>
    
    <div class="row clearfix">
        <table class="table table-hover" id="category" data-url="{{ route('category.datatable') }}">
            <thead>
                <tr>
                    <th>{{ trans('message.id') }}</th>
                    <th>{{ trans('message.title') }}</th>
                    <th>{{ trans('message.category') }} {{ trans('message.parent') }}</th>
                    <th>{{ trans('message.created_at') }}</th>
                    <th style="width: 100px">{{ trans('message.action') }}</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
{{-- translate category --}}
<div id="category-trans" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ trans('message.trans') }} {{ trans('message.category') }}</h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" role="form" novalidate id="transData">
                    @csrf
                    {{-- <legend>{{ trans('message.trans') }} {{ trans('message.category') }} </legend> --}}
                    <div class="form-group">
                        <label for="">{{ trans('message.language') }}</label>
                        <select name="language" id="language" class="form-control">
                            @foreach ($languages as $language)
                                <option value="{{ $language->id }}" >{{ $language->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">{{ trans('message.title') }} {{ trans('message.category') }}</label>
                        <input type="text" class="form-control" id="add-name" name="title" placeholder="Input field">
                    </div>
                </form>
            </div>
            <div class="modal-footer float-right">
                <button type="button" class="btn btn-default float-right " data-dismiss="modal">{{ trans('message.close') }}</button>
                <button type="button" class="btn btn-info float-right submit-add">{{ trans('message.submit') }}</button>
            </div>
        </div>

    </div>
</div>

@section('script')
    <script src="{{ asset('/') }}bower_components/MyCSSJS/category.js"></script>
@endsection