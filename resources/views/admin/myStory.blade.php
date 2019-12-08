@extends('layouts/adminHeader')
@section('style')
<link rel="stylesheet" href="{{ asset('bower_components/MyCSSJS/bs4Class.css') }}">
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


@section('script')
    <script src="{{ asset('/') }}bower_components/MyCSSJS/story.js"></script>
@endsection
