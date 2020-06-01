@extends('layouts.header')

@section('css')
<link rel="stylesheet" href="{{ asset('bower_components/MyCSSJS/custom.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/MyCSSJS/bs4Class.css') }}">
@endsection
@section('BOOKGUIDE')

<!--VIP STORY SECTION START-->
<section>
    <div class="container">
    <!--SECTION HEADING START-->
    <div class="container">
        <div class="section-heading-1">
            <h2>{{ trans('message.stories.Vip') }} {{ trans('message.story') }}</h2>
            <p> {{ trans('message.story') }} {{ trans('message.stories.vip') }} </p>
            <div class="kode-icon"><i class="fa fa-book"></i></div>
        </div>
    </div>
    <!--SECTION HEADING END-->
    <div class="row list_story">
        @foreach($data as $value)
            <div class="col-md-3" >
                <div class="kode-thumb">
                    @if ($value['img'] != '')
                        <img src="{{ asset('/') . config('Custom.linkImgDefaul') .$value['img'] }}" alt="" style="width: 41%">
                    @else
                        <img src="{{ asset('/') . config('Custom.ImgDefaul') }}" alt="" style="width:200px">
                    @endif
                </div>
                <div class="kode-text">
                    <h2 style="text-align: center; margin-top:10px"><a href="{{ asset('/') . $value['slug'] }}">{{ $value['title'] }}</a></h2>
                    <ul>
                        <li>
                            <p>by: 
                                @foreach($value['authors'] as $author)
                                <a href="#">{{ $author['name'] }}</a>
                                @endforeach
                            </p>
                        </li>
                        <li><p><a href="#">{{ $value['updated_at'] }}</a></p></li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
    <div class="float-right">
        {{ $data->links() }}
    </div>
    </div>
</section>
@endsection
@extends('layouts.footer');