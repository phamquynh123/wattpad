@extends('layouts.header')

@section('css')
<link rel="stylesheet" href="{{ asset('/bower_components/MyCSSJS/myCustom.css') }}">
<link rel="stylesheet" href="{{ asset('/bower_components/MyCSSJS/bs4Class.css') }}">
<style>
    .bg-red{
        color:#F44336;
    }
    .center{
        text-align: center;
    }
    .border{
        border: 0.5px black solid;
    }
</style>

@endsection

@section('home.content')
<div class="container">
<div class="row">
    <div class="col-md-9 col-sm-12 col-sx-12 col-12 boder">
        <p class="center"> {{ $data['title'] }} </p>
        @foreach($data['stories'] as $value)
            <div class="col-md-4 col-sm-6 col-xs-12 col-12 center boder">
                <a href="{{ asset('/') . $value['slug'] }}"><img src="{{ asset('/') . config('Custom.linkImgDefaul') . $value['img'] }}" alt="" style="width: 40%"></a>
                <a href="{{ asset('/') . $value['slug'] }}"><p>{{ $value['title'] }}</p></a>
            </div>
        @endforeach
        {{-- {{ $data['stories']->links() }} --}}
    </div>
    <div class="col-md-3 col-sm-12 col-sx-12 col-12 boder">
        <p>{{ trans('message.category') }}</p>
        @foreach($selectCategory as $value)
            <a href="{{ asset('/category/' . $value->slug . '') }}" class="btn btn-info waves-effect"> {{ $value->title }}</a><br>
        @endforeach
    </div>
    {{-- {{ $data['stories']->links() }} --}}
</div>
</div>
@endsection

@section('script')
    <script src='{{ asset('bower_components/MyCSSJS/home.js') }}'></script>
@endsection
