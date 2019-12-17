@extends('layouts.header')

@section('css')
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
                        
                        @if(Gate::allows('vipAcconut') || Gate::allows('admin'))
                            <div class="chapter">
                                <b>{{ trans('message.chapter') }}</b>
                                <ol>
                                @foreach($data->chapter as $value)
                                <li><a href="{{ route('viewChapter', [$data->id, $value->slug]) }}">
                                    {{ $value->title }}
                                </a></li>
                                @endforeach
                                </ol>
                            </div>
                        @else 
                            <div class="chapter bg-red">{{ trans('message.upgrateAccountToRead') }}</div>
                        @endif
                    </div>
                    <div class="panel-footer">
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

                        @if(Auth::check())
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="Type a comment" />
                            </div>
                        </div>
                        @endif

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
</div>
</div>
@endsection

@section('script')
    <script src='{{ asset('bower_components/MyCSSJS/home.js') }}'></script>
@endsection
