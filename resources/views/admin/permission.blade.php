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
        <button class="btn btn-info float-right" data-toggle="modal" data-target="#permission-add">{{ trans('action.add') }} {{ trans('message.permisson') }}</button>
        <div class="clear"></div>

        <table class="table table-hover" id="permission" data-url="{{ route('permission.datatable', $nowLanguage_id) }}">
            <thead>
                <tr>
                    <th>{{ trans('message.id') }}</th>
                    <th>{{ trans('message.title') }}</th>
                    <th>{{ trans('message.stories.public_status') }}</th>
                    <th>{{ trans('message.stories.original') }}</th>
                    <th style="width: 100px">{{ trans('message.stories.img') }}</th>
                    <th>{{ trans('message.stories.use_status') }}</th>
                    <th>{{ trans('message.action') }}</th>
                </tr>
            </thead>
        </table>
@endsection

{{-- modal edit story --}}
{{-- <div id="story-add" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">{{ trans('action.add') }} {{ trans('message.story') }}</h2>
            </div>
            <div class="modal-body">
                
            </div>
        </div>

    </div>
</div> --}}


@section('script')
    <script src="{{ asset('/') }}bower_components/MyCSSJS/permission.js"></script>
@endsection
