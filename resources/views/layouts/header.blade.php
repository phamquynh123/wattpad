<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from kodeforest.net/html/books/library/index.html by HTTrack Website Copier/3.x [XR&CO'2010], Tue, 22 Oct 2019 02:52:11 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Book Library </title>
<!-- CUSTOM STYLE -->
<link href="{{ asset('bower_components/css/style.css') }}" rel="stylesheet">
<!-- THEME TYPO -->
<link href="{{ asset('bower_components/css/themetypo.css') }}" rel="stylesheet">
<!-- SHORTCODES -->
<link href="{{ asset('bower_components/css/shortcode.css') }}" rel="stylesheet">
<!-- BOOTSTRAP -->
<link href="{{ asset('bower_components/css/bootstrap.css') }}" rel="stylesheet">
<!-- COLOR FILE -->
<link href="{{ asset('bower_components/css/color.css') }}" rel="stylesheet">
<!-- FONT AWESOME -->
<link href="{{ asset('bower_components/css/font-awesome.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('bower_components/fontawesome/css/all.min.css') }}">
<!-- BX SLIDER -->
<link href="{{ asset('bower_components/css/jquery.bxslider.css') }}" rel="stylesheet">
<!-- Boostrap Slider -->
<link href="{{ asset('bower_components/css/bootstrap-slider.css') }}" rel="stylesheet">
<!-- Widgets -->
<link href="{{ asset('bower_components/css/widget.css') }}" rel="stylesheet">
<!-- Owl Carusel -->
<link href="{{ asset('bower_components/css/owl.carousel.css') }}" rel="stylesheet">
<!-- responsive -->
<link href="{{ asset('bower_components/css/responsive.css') }}" rel="stylesheet">
<!-- Component -->
<link href="{{ asset('bower_components/js/dl-menu/component.css') }}" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="{{ asset('bower_component/css/bookblock.css') }}" />
<link rel="stylesheet" href="{{  asset('bower_components/admin/css/toastr.min.css') }}">
@routes
@yield('css')
</head>
<body>
<div id="loader-wrapper">
    <div id="loader"></div>

    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<!--WRAPPER START-->
<div class="wrapper">
    <!--HEADER START-->
    <header class="header-1">
        <div class="top-strip">
            <div class="container">
                <div class="pull-left">
                    <p> @if(Auth::check())
                        {{ Auth::user()->name }}
                        @endif
                         - Welcome to library</p>
                </div>
                <ul class="my-account">
                        <li><a href="#"><i class="fa fa-list"></i> Wishlist</a></li>
                        <li><a href="#"><i class="far fa-user"></i></i> My Account</a></li>
                        <li><a href="#"><i class="fa fa-compress"></i> Compare</a></li>
                        <li><a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> Login</a></li>
                        <li><a href="#"><i class="fa fa-shopping-cart"></i> 0Item</a></li>                        
                    </ul>
            </div>
        </div>
        <div class="logo-container">
            <div class="container">
                <!--LOGO START-->
                <div class="logo">
                    <a href="#" style="color:white; font-size: 20px">TQUYNH - LIBRARY</a>
                </div>
                <!--LOGO END-->
                <div class="kode-navigation">
                    <ul>
                        <li><a href="{{ asset('/') }}">{{ trans('message.home') }}</a>
                            <ul>
                                <li><a href="index-1.html">Home page 1</a></li>
                            </ul>
                        </li>
                        
                        <li><a href="#">{{ trans('message.about_us') }}</a></li>
                        <li><a href="{{ route('list_story') }}">{{ trans('message.book') }}</a>
                            <ul>
                                <li><a href="#">Book With Sidebar</a></li>
                                <li><a href="#">Book Detail</a></li>                                
                            </ul>
                        </li>
                        <li><a href="#">{{ trans('message.blog') }}</a>
                            <ul>
                                <li><a href="#">Blog 2 Column</a></li>
                                <li><a href="#">Blog Full</a></li>
                                <li><a href="#">Blog Detail</a></li>
                            </ul>
                        </li>
                        <li><a href="#">{{ trans('message.author') }}</a>
                            <ul>
                                <li><a href="#">Authors</a></li>
                                <li><a href="#">Authors Detail</a></li>                                        
                            </ul>
                        </li>
                        <li class="last"><a href="#">{{ trans('message.event') }}</a>
                            <ul>
                                <li><a href="#">Event 2 Column</a></li>
                                <li><a href="#">Event 3 Column</a></li>
                                <li><a href="#">Event Single</a></li>
                                <li><a href="#">Event Detail</a></li>
                            </ul>
                        </li>

                        <li class="last"><a href="#">{{ trans('message.contact') }}</a></li>
                    </ul>
                </div>
                <div id="kode-responsive-navigation" class="dl-menuwrapper">
                    <button class="dl-trigger">Open Menu</button>
                    <ul class="dl-menu">
                        <li class="menu-item kode-parent-menu"><a href="index-2.html">Home</a>
                            <ul class="dl-submenu">
                                <li><a href="index-1.html">Home page 1</a></li>
                            </ul>
                        </li>
                        <li><a href="about-us.html">About Us</a></li>
                        <li class="menu-item kode-parent-menu"><a href="books.html">Our Books</a>
                            <ul class="dl-submenu">
                                <li><a href="books3-sidebar.html">Book With Sidebar</a></li>
                                <li><a href="books-detail.html">Book Detail</a></li>                                
                            </ul>
                        </li>
                        <li class="menu-item kode-parent-menu"><a href="blog.html">Blog</a>
                            <ul class="dl-submenu">
                                <li><a href="blog-2column.html">Blog 2 Column</a></li>
                                <li><a href="blog-full.html">Blog Full</a></li>
                                <li><a href="blog-detail.html">Blog Detail</a></li>
                            </ul>
                        </li>
                        <li><a href="authors.html">Authors</a></li>
                        <li class="menu-item kode-parent-menu last"><a href="#">Events</a>
                            <ul class="dl-submenu">
                                <li><a href="events-2column.html">Event 2 Column</a></li>
                                <li><a href="events-3column.html">Event 3 Column</a></li>
                                <li><a href="event-full.html">Event Single</a></li>
                                <li><a href="event-detail.html">Event Detail</a></li>
                            </ul>
                        </li>
                        <li class="menu-item kode-parent-menu last"><a href="#">Pages</a>
                            <ul class="dl-submenu">
                                <li><a href="error-404.html">Error 404</a></li>
                                <li><a href="coming-soon.html">Comming Soon</a></li>
                                <li class="menu-item kode-parent-menu last"><a href="gallery-2col.html">Gallery</a>
                                    <ul class="dl-submenu">
                                        <li><a href="gallery-2col.html">Gallery 2 Col</a></li>
                                        <li><a href="gallery-3col.html">Gallery 3 Col</a></li>
                                        <li><a href="gallery-4col.html">Gallery 4 Col</a></li>    
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="last"><a href="contact-us.html">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!--HEADER END-->
    <!--BANNER START-->
    <div class="kode-banner">
        <ul class="bxslider">
            <li>
                <img src="{{ asset('bower_components/images/banner-1.png') }}" alt="">
                <div class="kode-caption-2">
                    <h5>BẠN ĐANG TÌM SÁCH...?</h5>
                    <h2>THƯ VIỆN SÁCH LỚN NHẤT</h2>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolor emque laudantium, totam rem aperiam.ipsam voluptatem.</p>
                    <div class="caption-btns">
                        <a href="#">See More</a>
                        <a href="#">Buy Now</a>
                    </div>                  
                </div>
            </li>
            <li>
                <img src="{{ asset('bower_components/images/banner-2.png') }}" alt="">
                <div class="kode-caption-2">
                    <h5>BẠN ĐANG TÌM SÁCH...?</h5>
                    <h2>THƯ VIỆN SÁCH LỚN NHẤT</h2>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolor emque laudantium, totam rem aperiam.ipsam voluptatem.</p>
                    <div class="caption-btns">
                        <a href="#">See More</a>
                        <a href="#">Buy Now</a>
                    </div>                  
                </div>
            </li>
            <li>
                <img src="{{ asset('bower_components/images/banner-3.png') }}" alt="">
                <div class="kode-caption-2">
                    <h5>BẠN ĐANG TÌM SÁCH...?</h5>
                    <h2>THƯ VIỆN SÁCH LỚN NHẤT</h2>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolor emque laudantium, totam rem aperiam.ipsam voluptatem.</p>
                    <div class="caption-btns">
                        <a href="#">See More</a>
                        <a href="#">Buy Now</a>
                    </div>                  
                </div>
            </li>
        </ul>
    </div>
    <!--BANNER END-->
    <!--BUT NOW START-->
    <div class="search-section">
        <div class="container">
            <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation"><a href="#Basic" aria-controls="Basic" role="tab" data-toggle="tab">Basic</a></li>
                <li role="presentation" class="active"><a href="#Author" aria-controls="Author" role="tab" data-toggle="tab">Author</a></li>
                <li role="presentation"><a href="#Publications" aria-controls="Publications" role="tab" data-toggle="tab">Publications</a></li>
              </ul>
            
              <!-- Tab panes -->
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="Basic">
                    <div class="form-container">
                        <div class="row">
                            <div class="col-md-3 col-sm-4">
                                <input type="text" placeholder="First Name">
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <input type="text" placeholder="Middle Name">
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <input type="text" placeholder="Last Name">
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <button>Search Author</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="Author">
                    <div class="form-container">
                        <div class="row">
                            <div class="col-md-3 col-sm-4">
                                <input type="text" placeholder="First Name">
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <input type="text" placeholder="Middle Name">
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <input type="text" placeholder="Last Name">
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <button>Search Author</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="Publications">
                    <div class="form-container">
                        <div class="row">
                            <div class="col-md-3 col-sm-4">
                                <input type="text" placeholder="First Name">
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <input type="text" placeholder="Middle Name">
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <input type="text" placeholder="Last Name">
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <button>Search Author</button>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
        </div>
    </div>
    <!--BUT NOW END-->
    <!--CONTENT START-->
    <div class="kode-content">
        
        <!--BOOK GUIDE SECTION START-->
        @yield('BOOKGUIDE')
        <!--BOOK GUIDE SECTION END-->
        <!--TOP CATEGORY SECTION START-->
        @yield('home.content')
        <!--TOP SELLERS SECTION END-->

        <!--BECOME A MEMBER START-->
        <section class="kode-membership">
            <div class="container">
                <!--SECTION HEADING START-->
                <div class="section-heading-1 dark-sec">
                    <h2>Become a member</h2>
                    <p>Submit your books idea and you can become an Author.</p>
                    <div class="kode-icon"><i class="fa fa-book"></i></div>
                </div>
                <!--SECTION HEADING END-->
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="input-container">
                            <i class="fa fa-user"></i>
                            <input type="text" placeholder="Your Name">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="input-container">
                            <i class="fa fa-envelope-o"></i>
                            <input type="text" placeholder="Your Email">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="input-container">
                            <i class="fa fa-home"></i>
                            <input type="text" placeholder="Your Address">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="input-container">
                            <i class="fa fa-phone"></i>
                            <input type="text" placeholder="Your Phone">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="input-container">
                            <i class="fa fa-calendar"></i>
                            <input type="text" placeholder="Your Age">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="input-container">
                            <i class="fa fa-check-square-o"></i>
                            <select>
                                <option>Select Package</option>
                                <option>Package One</option>
                                <option>Package Two</option>
                                <option>Package Three</option>
                                <option>Package Four</option>
                                <option>Package Five</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <a href="#" class="reg-btn">Register</a>
                    </div>
                </div>
            </div>
        </section>
        <!--BECOME A MEMBER END-->
        <!--NEWSLETTERS SECTION START-->
        <section class="kode-newsletters-2">
            <div class="container">
                <!--SECTION CONTENT START-->
                <div class="section-heading-1">
                    <h2>Subscribe Our Newsletter</h2>
                    <p>Subscribe here with your email us and get up to date.</p>
                    <div class="kode-icon"><i class="fa fa-book"></i></div>
                </div>
                <!--SECTION CONTENT END-->
                <div class="newsletters-container">
                    <div class="row">
                    <div class="col-md-9 col-sm-8">
                        <div class="input-container">
                            <i class="fa fa-envelope-o"></i>
                            <input type="text" placeholder="Subscribe us">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <button>Subscribe<i class="fa fa-paper-plane"></i></button>
                    </div>
                </div>
                </div>
            </div>
        </section>
        <!--NEWSLETTERS SECTION END-->
        <section class="lib-contact-section">
            <div class="location-text">
                <i class="fa fa-map-marker"></i>
                <h2>All create<br> and develop</h2>
                <h4>200 capacity</h4>
                <p>Esse cillum dolore eu fugiat nulla USA</p>
                <span><i class="fa fa-phone"></i>037 435 2428</span>
            </div>
            <div class="kode-thumb">
                
            </div>
            {{-- <div class="map-canvas" id="map-canvas"></div> --}}
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.6888436908225!2d105.84343494986697!3d21.005106393894035!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad5569f4fbf1%3A0x5bf30cadcd91e2c3!2zxJDhuqBJIEjhu4xDIELDgUNIIEtIT0EgQ-G7lE5HIFRS4bqmTiDEkOG6oEkgTkdIxKhB!5e0!3m2!1svi!2s!4v1591028430772!5m2!1svi!2s" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </section>
    </div>
    <!--CONTENT END-->
    <footer class="footer-2">
        <div class="container">
            <div class="lib-copyrights">
                <p>Copyrights © 2020-Quynh. All rights reserved</p>
                <div class="social-icon">
                    <ul>
                        <li><a href="#" data-toggle="tooltip" title="Facebook"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" title="Tumblr"><i class="fab fa-tumblr"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
@extends('layouts.footer');
