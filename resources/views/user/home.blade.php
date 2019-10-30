@extends('layouts.header')
@section('BOOKGUIDE')
    <a href="{!! route('change-language', ['en']) !!}">English</a>
    <a href="{!! route('change-language', ['vi']) !!}">Vietnam</a> 

{{ trans('message.hello') }}
<!--BOOK GUIDE SECTION START-->
        <section>
            <div class="container">
                <!--SECTION CONTENT START-->
                <div class="section-heading-1">
                    <h2>Welcome to the library</h2>
                    <p>Welcome to the Most Popular Library Today</p>
                    <div class="kode-icon"><i class="fa fa-book"></i></div>
                </div>
                <!--SECTION CONTENT END-->
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="kode-service-3">
                            <i class="fa fa-gift"></i>
                            <h3><a href="#">Ebooks</a></h3>
                            <p>an electronic version of a printed book that can be read on a computer.</p>
                            <a href="#" class="read-more">Read More</a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="kode-service-3">
                            <i class="fa fa-book"></i>
                            <h3><a href="#">audiobooks</a></h3>
                            <p>an audiocassette or CD recording of a reading of a book, typically a novel.</p>
                            <a href="#" class="read-more">Read More</a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="kode-service-3">
                            <i class="fa fa-clone"></i>
                            <h3><a href="#">Magazine</a></h3>
                            <p>a periodical publication containing articles and illustrations information.</p>
                            <a href="#" class="read-more">Read More</a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="kode-service-3">
                            <i class="fa fa-calculator"></i>
                            <h3><a href="#">Teans &amp; Kids</a></h3>
                            <p>the years of a person's age from 13 to 19 and are the kids and teens.</p>
                            <a href="#" class="read-more">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--BOOK GUIDE SECTION END-->
@endsection
