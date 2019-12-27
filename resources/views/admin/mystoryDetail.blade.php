@extends('layouts/adminHeader')
@section('style')
<link rel="stylesheet" href="{{ asset('bower_components/MyCSSJS/bs4Class.css') }}">
<style>
    th, td{
        font-size: 15px;
    }
</style>
@endsection
    <div class="block-header">
        <h2>{{ trans('message.story') }} {{ trans('message.detail') }}</h2>
    </div>
    <div class="row clearfix"></div>
        
    </div>
@section('content')
    <div class="col-xs-12 col-sm-3">
        <div class="card profile-card">
            <div class="profile-body">
                <div class="">
                    <img src="{{ asset('/') . config('Custom.linkImgDefaul') . '/' . $data->img }}" alt="AdminBSB" class=" img-fluid" />
                </div>
                {{-- <div class="content-area">
                    <h3> {{ $data->title }}</h3>
                </div> --}}
            </div>
            <div class="profile-footer">
                <ul>
                    <li>
                        <span>{{ trans('message.stories.total_vote') }}</span>
                        <span class="total_vote">{{ $data->total_vote }}</span>
                    </li>
                    <li>
                        <span>{{ trans('message.stories.view_count') }}</span>
                        <span>{{ $data->view_count }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-9">
        <div class="card">
            <div class="body">
                <div class="panel panel-default panel-post">
                    <div class="panel-heading">
                        <div class="media">
                            <h2>{{ $data->title }}</h2>
                            <p class="authors">{{ trans('message.stories.author') }} : 
                                @foreach ($data->authors as $value)
                                    <span>{{ $value->name }},</span>
                                @endforeach
                            </p>
                            <p id="created"></p>
                        </div>
                        <ul>
                            <li>
                                <span><b>{{ trans('message.stories.public_status') }} : </b> </span>
                                <span>
                                    @if($data->public_status == 1 ) 
                                        {{ trans('message.stories.public') }}
                                    @else
                                        {{ trans('message.stories.draft') }}
                                    @endif
                                </span>
                            </li>
                            <li>
                                <span><b>{{ trans('message.stories.use_status') }} : </b></span>
                                <span>
                                    @if($data->use_status == 0 ) 
                                        {{ trans('message.stories.normal') }}
                                    @else
                                        {{ trans('message.stories.normal') }}
                                    @endif
                                </span>
                            </li>
                            <li>
                                <span><b>{{ trans('message.stories.numChapter') }} : </b></span>
                                <span>{{ $data->numChapter }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="post">
                            <div class="post-heading">
                                <p>{{ $data->description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="post">
                            <div class="post-heading"><h3>Danh Sách Chương</h3></div>
                            @foreach($data->chapter as $value)
                                <div class="post-heading">
                                    <a href="{{ asset('/' . $data->slug . '/' . $data->id . '/' . $value->slug) }}">{{ $value->title }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="panel-footer">
                        <h3>{{ trans('message.comment') }}</h3>
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="material-icons">thumb_up</i>
                                    <span class="total_vote">{{ $data->total_vote }} </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="material-icons">comment</i>
                                    <span class="comment">{{ $data->numComment }} </span><span>{{ trans('message.stories.comment') }}</span>
                                </a>
                            </li>
                        </ul>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="Type a comment" />
                            </div>
                        </div>

                        <div class="form-group">
                            @foreach($data->comment as $value)
                                <div class="row">
                                    <div class="image-cmt float-left">
                                        <img src="{{ asset('/') . $value->user->avatar }}" alt="">
                                    </div>
                                    <div class="float-left">
                                        <p><b>{{ $value->user->name }}</b></p>
                                        <p>{{ $value->content }}</p>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="clear"></div>
@endsection

@section('script')
    <script src="{{ asset('/') }}bower_components/MyCSSJS/story.js"></script>
@endsection