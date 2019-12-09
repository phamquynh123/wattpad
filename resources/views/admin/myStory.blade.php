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
        <h2>{{ trans('message.story') }}</h2>
        <select name="language" id="" class="">
            @foreach($get_all_languages as $get_all_languages)
                <option value="{{ $get_all_languages->id }}"> {{ $get_all_languages->name }}</option>
            @endforeach
        </select>
    </div>
    {{-- {{ dd($get_all_language) }} --}}
    <div class="row clearfix"></div>
        <button class="btn btn-info float-right" data-toggle="modal" data-target="#story-add">{{ trans('action.add') }} {{ trans('message.story') }}</button>
        <div class="clear"></div>

        <table class="table table-hover" id="myStory" data-url="{{ route('myStory.datatable', $nowLanguage_id) }}">
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
<div id="story-add" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">{{ trans('action.add') }} {{ trans('message.story') }}</h2>
            </div>
            <div class="modal-body">
                <form action="" method="POST" role="form" novalidate id="submitAdd">
                    @csrf
                    <div class="form-group">
                        <label for="" class="error"><h4>{{ trans('action.default') }} {{ trans('message.language') }} {{ trans('message.vi') }}</h4></label>
                    </div>
                    <div class="form-group">
                        <label for="">{{ trans('message.title') }} {{ trans('message.story') }}</label>
                        <input type="text" class="form-control" name="title" placeholder="Input field">
                    </div>
                    <div class="form-group">
                        <label for="">{{ trans('message.description') }} {{ trans('message.story') }}</label>
                        <textarea name="description" cols="30" rows="5" class="form-control no-resize" required="" aria-required="true"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">{{ trans('message.stories.original') }} {{ trans('message.story') }}</label>
                        <input type="text" class="form-control" name="original" placeholder="Input field">
                    </div>
                    <div class="form-group">
                        <label for="">{{ trans('message.stories.img') }} {{ trans('message.story') }}</label>
                        <input type="file" class="form-control" name="file" placeholder="Input field">
                    </div>
                    <div class="form-group">
                        <label for="">{{ trans('message.stories.public_status') }} {{ trans('message.story') }}</label>
                        <select name="public_status" id="" class="form-control">
                            <option value="">--- {{ trans('message.stories.public_status') }} ---</option>
                            <option value="{{ config('Custom.statusPublic') }}">{{ trans('message.stories.public') }}</option>
                            <option value="{{ config('Custom.statusDraft') }}">{{ trans('message.stories.draft') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">{{ trans('message.stories.use_status') }} {{ trans('message.story') }}</label>
                        <select name="use_status" id="" class="form-control">
                            <option value="">--- {{ trans('message.stories.use_status') }} ---</option>
                            <option value="{{ config('Custom.VipStory') }}">{{ trans('message.stories.vip') }}</option>
                            <option value="{{ config('Custom.NormalStory') }}">{{ trans('message.stories.normal') }}</option>
                        </select>
                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('message.close') }}</button>
                        <button type="submit" class="btn btn-info">{{ trans('message.submit') }}</button>
                    </div>
                   <div class="clear"></div>
                </form>
            </div>
        </div>

    </div>
</div>


@section('script')
    <script src="{{ asset('/') }}bower_components/MyCSSJS/story.js"></script>
@endsection
