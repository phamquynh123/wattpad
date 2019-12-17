@extends('layouts/adminHeader')
@section('style')
<link rel="stylesheet" href="{{ asset('bower_components/MyCSSJS/bs4Class.css') }}">
<style>
    th, td{
        font-size: 15px;
    }
</style>
@endsection

@section('content')

    <div class="block-header">
        <h2>{{ trans('message.permission') }}</h2>
    </div>
    {{-- {{ dd($get_all_language) }} --}}
    <div class="row clearfix"></div>

        <p><b>{{ trans('message.permission') }}</b></p>
        <button class="btn btn-info float-right permissionrole-add" data-toggle="modal" data-type="permission" data-target="#permissionrole-add">{{ trans('action.add') }} {{ trans('message.permission') }}</button>
        <div class="clear"></div>
        <table class="table table-hover" id="addVip" data-url="{{ route('permission.addVipDatatable', $nowLanguage_id) }}">
            <thead>
                <tr>
                    <th>{{ trans('message.id') }}</th>
                    <th>{{ trans('message.email') }}</th>
                    <th>{{ trans('message.name') }}</th>
                    <th>{{ trans('message.avatar') }}</th>
                    <th>{{ trans('message.role') }}</th>
                    <th>{{ trans('message.changePermission') }}</th>
                </tr>
            </thead>
        </table>

@endsection

@section('script')
    <script src="{{ asset('/') }}bower_components/MyCSSJS/permission.js"></script>
@endsection
