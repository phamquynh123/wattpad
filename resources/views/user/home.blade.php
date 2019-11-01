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


@section('home.category')
<section class="lib-categories-section">
    <div class="container">
        <div class="section-heading-1 dark-sec">
            <h2>Our Top Categories</h2>
            <p>Here are some of the Top Categories of the Books Available.</p>
            <div class="kode-icon"><i class="fa fa-book"></i></div>
        </div>
        <ul class="nav nav-tabs" role="tablist">
            @foreach ($categories as $category)
                @if($category['parent_id'] == 1) 
                    <li role="presentation" ><a href="#{{ $category->slug }}" aria-controls="{{ $category->slug }}" role="tab" data-toggle="tab" class="category-content" data-categoryId={{ $category['id'] }} >{{ $category['title'] }}</a></li>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="container">
        <!--SECTION CONTENT START-->
        <div class="section-heading-1 dark-sec">
            <h2>Our Top Categories</h2>
            <p>Here are some of the Top Categories of the Books Available.</p>
            <div class="kode-icon"><i class="fa fa-book"></i></div>
        </div>
        <!--SECTION CONTENT END-->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#Photography" aria-controls="Photography" role="tab" data-toggle="tab">Arts &amp; Photography</a></li>
            <li role="presentation"><a href="#Biographies" aria-controls="Biographies" role="tab" data-toggle="tab">Biographies &amp; Memoirsa</a></li>
            <li role="presentation"><a href="#Business" aria-controls="Business" role="tab" data-toggle="tab">Business</a></li>
            <li role="presentation"><a href="#Computers" aria-controls="Computers" role="tab" data-toggle="tab">Computers &amp; Internet</a></li>
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="Photography">
                <ul class="bxslider">
                    <li>
                        <!--PRODUCT GRID START-->
                        <div class="col-md-3 col-sm-6 best-seller-pro">
                            <figure>
                                <img src="images/book5.png" alt="">
                            </figure>
                            <div class="kode-text">
                                <h3>PENDRAGON</h3>
                            </div>
                            <div class="kode-caption">
                                <h3>PENDRAGON Dr.Machale</h3>
                                <div class="rating">
                                    <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                                </div>
                                <p>Dr.Machale</p>
                                <p class="price">$224.20</p>
                                <a href="#" class="add-to-cart">Add To Cart</a>
                            </div>
                        </div>
                        <!--PRODUCT GRID END-->
                        <!--PRODUCT GRID START-->
                        <div class="col-md-3 col-sm-6 best-seller-pro">
                            <figure>
                                <img src="images/book6.png" alt="">
                            </figure>
                            <div class="kode-text">
                                <h3><a href="#">Bridget Jones</a></h3>
                            </div>
                            <div class="kode-caption">
                                <h3>Mad About the Boy</h3>
                                <div class="rating">
                                    <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                                </div>
                                <p>Helen Fielding</p>
                                <p class="price">$77.70</p>
                                <a href="#" class="add-to-cart">Add To Cart</a>
                            </div>
                        </div>
                        <!--PRODUCT GRID END-->
                        <!--PRODUCT GRID START-->
                        <div class="col-md-3 col-sm-6 best-seller-pro">
                            <figure>
                                <img src="images/book7.png" alt="">
                            </figure>
                            <div class="kode-text">
                                <h3><a href="#">Burnt Siena</a></h3>
                            </div>
                            <div class="kode-caption">
                                <h3>Art History Mystery</h3>
                                <div class="rating">
                                    <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                                </div>
                                <p>Sara Wisseman</p>
                                <p class="price">$334.50</p>
                                <a href="#" class="add-to-cart">Add To Cart</a>
                            </div>
                        </div>
                        <!--PRODUCT GRID END-->
                        <!--PRODUCT GRID START-->
                        <div class="col-md-3 col-sm-6 best-seller-pro">
                            <figure>
                                <img src="images/book8.png" alt="">
                            </figure>
                            <div class="kode-text">
                                <h3><a href="#">Chrysalis</a></h3>
                            </div>
                            <div class="kode-caption">
                                <h3>The Brave Girl</h3>
                                    <div class="rating">
                                        <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                                    </div>
                                <p>William S.</p>
                                <p class="price">$24.75</p>
                                <a href="#" class="add-to-cart">Add To Cart</a>
                            </div>
                        </div>
                        <!--PRODUCT GRID END-->
                    </li>
                    <li>
                        <!--PRODUCT GRID START-->
                        <div class="col-md-3 col-sm-6 best-seller-pro">
                            <figure>
                                <img alt="" src="images/book10.png">
                            </figure>
                            <div class="kode-text">
                                <h3><a href="#">The Winning</a></h3>
                            </div>
                            <div class="kode-caption">
                                <h3>The Winning Story</h3>
                                <div class="rating">
                                    <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                                </div>
                                    <p>Mind Set</p>
                                <p class="price">$447.75</p>
                                <a class="add-to-cart" href="#">Add To Cart</a>
                            </div>
                        </div>
                        <!--PRODUCT GRID END-->
                        <!--PRODUCT GRID START-->
                        <div class="col-md-3 col-sm-6 best-seller-pro">
                            <figure>
                            <img alt="" src="images/book3.png">
                        </figure>
                        <div class="kode-text">
                            <h3><a href="#">Dead Water</a></h3>
                        </div>
                        <div class="kode-caption">
                            <h3>Dead Water in the Sea</h3>
                            <div class="rating">
                                <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                            </div>
                            <p>Ann Grannger</p>
                            <p class="price">$777.75</p>
                            <a class="add-to-cart" href="#">Add To Cart</a>
                            </div>
                        </div>
                        <!--PRODUCT GRID END-->
                        <!--PRODUCT GRID START-->
                        <div class="col-md-3 col-sm-6 best-seller-pro">
                           <figure>
                            <img alt="" src="images/book4.png">
                        </figure>
                        <div class="kode-text">
                            <h3><a href="#">The Fault In our Stars</a></h3>
                        </div>
                        <div class="kode-caption">
                            <h3>Paper Towns</h3>
                                <div class="rating">
                            <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                            </div>
                                <p>Daniel Abraham</p>
                            <p class="price">$770.75</p>
                            <a class="add-to-cart" href="#">Add To Cart</a>
                            </div>
                        </div>
                        <!--PRODUCT GRID END-->
                        <!--PRODUCT GRID START-->
                        <div class="col-md-3 col-sm-6 best-seller-pro">
                            <figure>
                            <img alt="" src="images/book5.png">
                        </figure>
                        <div class="kode-text">
                            <h3><a href="#">The Ruby Of Egypt</a></h3>
                        </div>
                        <div class="kode-caption">
                            <h3>The Ruby Of Egypt</h3>
                            <div class="rating">
                            <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                            </div>
                                <p>Cat Howard</p>
                            <p class="price">$996.75</p>
                            <a class="add-to-cart" href="#">Add To Cart</a>
                            </div>
                        </div>
                        <!--PRODUCT GRID END-->
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection



@section('script')
    <script src='{{ asset('bower_components/MyCSSJS/home.js') }}'></script>
@endsection
