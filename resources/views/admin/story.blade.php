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

        <table class="table table-hover" id="story" data-url="{{ route('story.datatable', $nowLanguage_id) }}">
            <thead>
                <tr>
                    <th>{{ trans('message.id') }}</th>
                    <th>{{ trans('message.title') }}</th>
                    <th>{{ trans('message.stories.public_status') }}</th>
                    <th>{{ trans('message.stories.original') }}</th>
                    <th style="width: 100px">{{ trans('message.stories.img') }}</th>
                    <th>{{ trans('message.action') }}</th>
                </tr>
            </thead>
        </table>

        {{-- <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation" class="active"><a href="{{ route('story.datatable', config('Custom.VipStory')) }}" data-toggle="tab">{{ trans('message.stories.vip') }}</a></li>
            <li role="presentation"><a href="{{ route('story.datatable', config('Custom.VipStory')) }}" data-toggle="tab">{{ trans('message.stories.normal') }}</a></li>
            <li role="presentation"><a href="#messages" data-toggle="tab">{{ trans('message.stories.public') }}</a></li>
            <li role="presentation"><a href="#settings" data-toggle="tab">{{ trans('message.stories.draft') }}</a></li>
        </ul> --}}

        <!-- Tab panes -->
        {{-- <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="home">
                <b>Home Content</b>
                <table class="table table-hover" id="story" data-url="{{ route('story.datatable') }}">
                    <thead>
                        <tr>
                            <th>{{ trans('message.id') }}</th>
                            <th>{{ trans('message.title') }}</th>
                            <th>{{ trans('message.story') }} {{ trans('message.parent') }}</th>
                            <th>{{ trans('message.created_at') }}</th>
                            <th style="width: 100px">{{ trans('message.action') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="profile">
                <b>Profile Content</b>
                <p>
                    Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                    Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                    pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                    sadipscing mel.
                </p>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="messages">
                <b>Message Content</b>
                <p>
                    Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                    Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                    pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                    sadipscing mel.
                </p>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="settings">
                <b>Settings Content</b>
                <p>
                    Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                    Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                    pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                    sadipscing mel.
                </p>
            </div>
        </div> --}}
    
@endsection

{{-- Add new category --}}
<div id="story-detail" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">{{ trans('action.detail') }} {{ trans('message.story') }}</h2>
            </div>
            <div class="modal-body">
                <div class="col-xs-12 col-sm-3">
                    <div class="card profile-card">
                        <div class="profile-header">&nbsp;</div>
                        <div class="profile-body">
                            <div class="image-area">
                                <img src="{{ asset('/') }}" alt="AdminBSB" class=" img-fluid" />
                            </div>
                            <div class="content-area">
                                <h3 id="nameStory"></h3>
                            </div>
                        </div>
                        <div class="profile-footer">
                            <ul>
                                <li>
                                    <span>{{ trans('message.stories.total_vote') }}</span>
                                    <span class="total_vote"></span>
                                </li>
                                <li>
                                    <span>{{ trans('message.stories.public_status') }}</span>
                                    <span id="public_status"></span>
                                </li>
                                <li>
                                    <span>{{ trans('message.stories.use_status') }}</span>
                                    <span id ="use_status"></span>
                                </li>
                                <li>
                                    <span>{{ trans('message.stories.view_count') }}</span>
                                    <span id ="view_count"></span>
                                </li>
                            </ul>
                            <button class="btn btn-primary btn-lg waves-effect btn-block disable">VOTE</button>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-9">
                    <div class="card">
                        <div class="body">
                            <div>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                                        <div class="panel panel-default panel-post">
                                            <div class="panel-heading">
                                                <div class="media">
                                                    <h2 id="titlee"></h2>
                                                    <p class="authors">{{ trans('message.stories.author') }} : </p>
                                                    <p id="created"></p>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="post">
                                                    <div class="post-heading">
                                                        <p id="description"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-footer">
                                                <ul>
                                                    <li>
                                                        <a href="#">
                                                            <i class="material-icons">thumb_up</i>
                                                            <span class="total_vote"></span><span>{{ trans('message.stories.total_vote') }}</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="material-icons">comment</i>
                                                            <span class="comment"></span><span>{{ trans('message.stories.comment') }}</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="material-icons">share</i>
                                                            <span>Share</span>
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" placeholder="Type a comment" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <button type="button" class="btn btn-default float-right" data-dismiss="modal">{{ trans('message.close') }}</button>
                <div class="clear"></div>
        </div>
    </div>
</div>

@section('script')
    <script src="{{ asset('/') }}bower_components/MyCSSJS/story.js"></script>
@endsection
