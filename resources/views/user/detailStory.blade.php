@extends('layouts.header')

@section('css')
<link rel="stylesheet" href="{{ asset('/bower_components/MyCSSJS/myCustom.css') }}">
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
    <div class="col-md-9 col-sm-12 col-xs-12">
        <div class="row">
            <div class="col-xs-12 col-sm-3">
                <div class="card profile-card">
                    <div class="profile-body">
                        <div class="">
                            @if ($data['img'] != '')
                                <img src="{{ asset('/') . config('Custom.linkImgDefaul') . $data->img }}" alt="" class=" img-fluid">
                            @else
                                <img src="{{ asset('/') . config('Custom.ImgDefaul') }}" alt="" class=" img-fluid">
                            @endif
                        </div>
                        
                    </div>
                    <div class="profile-footer">
                        <ul>
                            <li class="bg-red">
                                @if($data->use_status == config('Custom.VipStory'))
                                    <p><b>{{ trans('message.story') }} {{ trans('message.stories.Vip') }}</b></p>
                                @endif
                            </li>
                        </ul>
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
                                            @if($data->use_status == config('Custom.NormalStory') ) 
                                                {{ trans('message.stories.normal') }}
                                            @else
                                                {{ trans('message.stories.vip') }}
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
                                        <h3>{{ trans('message.description') }}</h3>
                                        <p>{{ $data->description }}</p>
                                    </div>
                                </div>
                                
                                @if($data->use_status == config('Custom.VipStory'))
                                    @if(Gate::allows('vipAccount') || Gate::allows('admin'))
                                        <div class="chapter">
                                            <b>{{ trans('message.chapter') }}</b>
                                            <ol>
                                            @foreach($data->chapter as $value)
                                            <li><a href="{{ route('viewChapter', [$data->slug, $data->id, $value->slug]) }}">
                                                {{ $value->title }}
                                            </a></li>
                                            @endforeach
                                            </ol>
                                        </div>
                                    @else 
                                        <div class="chapter bg-red">
                                            <a href="#" class="upgrateAccount bg-red">
                                                {{ trans('message.upgrateAccountToRead') }}
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    <div class="chapter">
                                        <b>{{ trans('message.chapter') }}</b>
                                        <ol>
                                        @foreach($data->chapter as $value)
                                        <li><a href="{{ route('viewChapter', [$data->slug, $data->id, $value->slug]) }}">
                                            {{ $value->title }}
                                        </a></li>
                                        @endforeach
                                        </ol>
                                    </div>
                                @endif
                            </div>
                            <div class="panel-footer">
                                <h3>{{ trans('message.comment') }}</h3>
                                <ul>
                                    @if($data['vote'] == false)
                                        <li class="vote">
                                            <a href="#"  class="notlike vote-Story" data-id={{ $data->id }}>
                                                <i class="fas fa-thumbs-up"></i>
                                                <span class="total_vote">{{ $data->total_vote }} </span>
                                            </a>
                                        </li>
                                    @elseif ($data['vote'] == true)
                                        <li class="vote">
                                            <a href="#" class="vote-Story" data-id={{ $data->id }}>
                                                <i class="fas fa-thumbs-up"></i>
                                                <span class="total_vote">{{ $data->total_vote }} </span>
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="#">
                                            <i class="fas fa-comments"></i>
                                            <span class="comment">{{ $data->numComment }} </span><span>{{ trans('message.stories.comment') }}</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="clear"></div>

                                @if(Auth::check())
                                <div class="form-group">
                                    <div class="form-line">
                                        <form action="#" method="POST" role="form" id="comment-story">
                                            @csrf
                                            <input type="hidden" name="story_id" value="{{ $data->id }}">
                                            <div class="form-group">
                                                <textarea type="text" class="form-control" id="" placeholder="add comment" name="content"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>

                                @else 
                                    <p class="bg-red">{{ trans('message.loginToComment') }}</p>
                                @endif

                                <div class="form-group div-comment">
                                    @foreach($data->comment as $value)
                                        <div class="image-cmt float-left">
                                            @if($value->user->avatar == '')
                                                <img src="{{ asset('/') .config('Custom.ImgDefaul') }}" alt="">
                                            @else 
                                                <img src="{{ asset('/') .config('Custom.linkImgDefaul') . $value->user->avatar }}" alt="">
                                            @endif
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
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
        @foreach($selectCategory as $value)
            <a href="{{ asset('/category/' . $value->slug . '') }}" class="btn btn-info waves-effect"> {{ $value->title }}</a>
        @endforeach
        <div class="recomment-story">
            @foreach ($recomment as $value)
            {{-- {{ dd($value) }} --}}
            <div class="row">
                <div class="col-md-5 col-sm-12 col-xs-12">
                    <a href="{{ asset('/' . $value->slug ) }}">
                        @if ($value->img == '')
                            <img src="{{ asset('/') .config('Custom.ImgDefaul') }}" alt="" style="width: 100%">
                        @else 
                            <img src="{{ asset('/') .config('Custom.linkImgDefaul') . $value->img }}" alt=""  style="width: 100%">
                        @endif
                    </a>
                </div>
                <div class="col-md-7 col-sm-12 col-xs-12">
                    <a href="{{ asset('/' . $value->slug ) }}">{{ $value->title }}</a>
                    @if ($value->use_status == config('Custom.VipStory'))
                        <p class="bg-red"> {{ trans('message.story') }} {{ trans('message.stories.Vip') }}</p>
                    @else
                        <p class="bg-red"> {{ trans('message.story') }} {{ trans('message.stories.Normal') }}</p>
                    @endif
                </div>
            </div>
            <hr>
            @endforeach
        </div>

    </div>
</div>
</div>
@endsection

@section('script')
    <script src='{{ asset('bower_components/MyCSSJS/home.js') }}'></script>
@endsection
