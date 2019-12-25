@extends('layouts.header')

@section('css')
<link rel="stylesheet" href="{{ asset('/bower_components/MyCSSJS/bs4Class.css') }}">
<style>
    .bg-red{
        color:#F44336;
    }
</style>

@endsection

@section('home.content')
<div class="container">

    <div class="row">
        <div class="col-xs-12 col-sm-3">
            <div class="card profile-card">
                <div class="profile-body">
                    <div class="">
                        @if ($story['img'] != '')
                            <img src="{{ asset('/') . config('Custom.linkImgDefaul') . $story->img }}" alt="" class=" img-fluid">
                        @else
                            <img src="{{ asset('/') . config('Custom.ImgDefaul') }}" alt="" class=" img-fluid">
                        @endif
                    </div>
                </div>
                <div class="profile-footer">
                    @if($story->use_status == config('Custom.VipStory'))
                        <ul>
                            <li class="bg-red">
                                <p><b>{{ trans('message.story') }} {{ trans('message.stories.Vip') }}</b></p>
                            </li>
                        </ul>
                     @endif
                    <ul>
                        <li>
                            <span>{{ trans('message.stories.total_vote') }}</span>
                            <span class="total_vote">{{ $story->total_vote }}</span>
                        </li>
                        <li>
                            <span>{{ trans('message.stories.view_count') }}</span>
                            <span>{{ $story->view_count }}</span>
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
                                <h2>{{ $story->title }}</h2>

                                <p id="created"></p>
                            </div>
                            <ul>
                                <li>
                                    <span><b>{{ trans('message.stories.public_status') }} : </b> </span>
                                    <span>
                                        @if($story->public_status == 1 ) 
                                            {{ trans('message.stories.public') }}
                                        @else
                                            {{ trans('message.stories.draft') }}
                                        @endif
                                    </span>
                                </li>
                                <li>
                                    <span><b>{{ trans('message.stories.use_status') }} : </b></span>
                                    <span>
                                        @if($story->use_status == 0 ) 
                                            {{ trans('message.stories.normal') }}
                                        @else
                                            {{ trans('message.stories.normal') }}
                                        @endif
                                    </span>
                                </li>
                                <li>
                                    <span><b>{{ trans('message.stories.numChapter') }} : </b></span>
                                    <span>{{ $story->numChapter }}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="panel-body">
                            <div class="post">
                                <div class="post-heading">
                                    <p>{{ $chapter->title }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="post">
                                <div class="post-heading">
                                    <p>{!! $chapter->content !!}</p>
                                </div>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <h3>{{ trans('message.comment') }}</h3>
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="fas fa-thumbs-up" class="notlike"></i>
                                        <span class="total_vote">{{ $story->total_vote }} </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fas fa-comments" class="notlike"></i>
                                        <span class="comment">{{ $story->numComment }} </span><span>{{ trans('message.stories.comment') }}</span>
                                    </a>
                                </li>
                            </ul>

                            @if(Auth::check())
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Type a comment" />
                                </div>
                            </div>

                            @else 
                                <p class="bg-red">{{ trans('message.loginToComment') }}</p>
                            @endif

                            <div class="form-group">
                                @foreach($story->comment as $value)
                                    <div class="image-cmt float-left">
                                        <img src="{{ asset('/') . $value->user->avatar }}" alt="">
                                    </div>
                                    <div class="float-left">
                                        <p><b>{{ $value->user->name }}</b></p>
                                        <p>{{ $value->content }}</p>
                                    </div>
                                    <div class="clear"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>

    {{-- <div class="center">
        @foreach($selectCategory as $value)
            <a href="{{ asset('/category/' . $value->slug . '') }}" class="btn btn-info waves-effect"> {{ $value->title }}</a>
        @endforeach
    </div> --}}

    <div class="row">
        @foreach($recommentStory as $value)
            <div class="col-md-4 col-sm-4 col-12 center">
                <a href="{{ asset($value->slug) }}"><img src="{{ asset('/' . config('Custom.linkImgDefaul') . '/' . $value->img) }}" alt="" style="width: 200px"></a>
                <a href="{{ asset($value->slug) }}"><p>{{ $value->title }}</p></a>
                <p>
                    @foreach($value['authors'] as $author)
                        {{ $author->name }}
                    @endforeach
                </p>
            </div>
        @endforeach
    </div>

</div>
</div>
@endsection

@section('script')
    <script src='{{ asset('bower_components/MyCSSJS/home.js') }}'></script>
@endsection