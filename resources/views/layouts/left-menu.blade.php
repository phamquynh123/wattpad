@section('left-menu')
<div class="menu">
                <ul class="list">
                    {{-- <li class="header">MAIN NAVIGATION</li> --}}
                    <li>
                        <a href="{{ asset('/admin') }}">
                            <i class="material-icons fa fa-home"></i>
                            <span>{{ trans('message.home') }}</span>
                        </a>
                    </li>

                    @if (Gate::allows('admin'))
                    <li>
                        <a href="{{ asset('/admin/category') }}">
                            <i class="material-icons fa fa-bars"></i>
                            <span>{{ trans('message.category') }}</span>
                        </a>
                    </li>
                    @endif

                    @if (Gate::allows('admin'))
                    <li>
                        <a href="{{ asset('/admin/menu') }}">
                            <i class="material-icons fa fa-bars"></i>
                            <span>{{ trans('message.menu') }}</span>
                        </a>
                    </li>
                    @endif

                    @if (Gate::allows('admin'))
                    <li>
                        <a href="{{ asset('/admin/story/') }}">
                            <i class="material-icons fa fa-book-open"></i>
                            <span>{{ trans('message.storyManagement') }}</span>
                        </a>
                    </li>
                    @endif

                    @if(Gate::allows('vipAccount') || Gate::allows('myStory') || Gate::allows('admin'))
                    <li>
                        <a href="{{ asset('/manageMyStory') }}">
                            <i class="material-icons fa fa-book-reader"></i>
                            <span>{{ trans('message.myStory') }}</span>
                        </a>
                    </li>
                    @endif

                    @if (Auth::user()->role_id == config('Custom.roleNormaluser'))
                        <li>
                            <a href="{{ asset('/manageMyStory') }}">
                                <i class="material-icons">layers</i>
                                <span>{{ trans('message.createStory') }}</span>
                            </a>
                        </li>
                    @endif

                    @if (Gate::allows('admin'))
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons fa fa-user"></i>
                            <span>{{ trans('message.user') }}</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{ asset('/admin/normalUser') }}"> {{ trans('message.normalUser') }}</a>
                            </li>
                            <li>
                                <a href="{{ asset('/admin/vipUser') }}">{{ trans('message.vipUser') }}</a>
                            </li>
                            <li>
                                <a href="{{ asset('/admin/author') }}">{{ trans('message.author') }}</a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if (Gate::allows('admin'))
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>{{ trans('message.permission') }}</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{ asset('permission/permissionlist') }}">{{ trans('message.permissionlist') }}</a>
                            </li>
                            <li>
                                <a href="{{ asset('permission/Capquyen') }}">{{ trans('message.Capquyen') }}</a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if (Gate::allows('admin'))
                    <li>
                        <a href="{{ asset('/admin/news') }}">
                            <i class="material-icons fa fa-newspaper" ></i>
                            <span>{{ trans('message.news') }}</span>
                        </a>
                    </li>
                    @endif

                </ul>
            </div>
@endsection