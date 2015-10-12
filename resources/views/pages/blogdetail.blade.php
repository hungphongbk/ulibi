@extends('layouts.default')
@section('title','Blog details')
@section('content')
	<div class="breadcrumb-wrap">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h4>Blog Single</h4>
                </div>
                <div class="col-sm-6 hidden-xs text-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>blog-Single</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="divide80"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="blog-post">
                    <div class="ratio-1920-850 hover-zoomout-darken">
                        <div class="wrapper">
                            @if(is_null($article->first_related_destination))
                                <img src="img/showcase-2.jpg" class="img-responsive" alt="workimg">
                            @else
                                <img src="{{ $article->first_related_destination->avatar }}" class="img-responsive" alt="workimg">
                            @endif
                        </div>
                    </div>
                    <ul class="list-inline post-detail">
                        <li>by <a href="#">{{ $article->ulibier->username }}</a></li>
                        <li><i class="fa fa-calendar"></i>
                            {{ $article->article_date->format('d M Y') }}
                        </li>
                        <li><i class="fa fa-tag"></i> <a href="#">Sports</a></li>
                        <li><i class="fa fa-comment"></i> <a href="#">6 Comments</a></li>
                    </ul>
                    <h2>{{ $article->article_title }}</h2>
                    {!! $article->content_as_html !!}
                </div><!--about author-->
                <div class="comment-post">
                    <h3>3 Comments</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="comment-list">
                                <h4><img src="img/team-2.jpg" class="img-responsive" alt="">
                                    by User <a href="#" class="btn btn-xs btn-theme-dark">Reply</a>
                                </h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem quam, adipiscing condimentum tristique vel, eleifend sed turpis. Pellentesque cursus arcu id magna euismod in elementum purus molestie
                                </p>
                            </div><!--comments list-->
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="comment-list">
                                <h4><img src="img/team-3.jpg" class="img-responsive" alt="">
                                    by User <a href="#" class="btn btn-xs btn-theme-dark">Reply</a>
                                </h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem quam, adipiscing condimentum tristique vel, eleifend sed turpis. Pellentesque cursus arcu id magna euismod in elementum purus molestie
                                </p>
                            </div><!--comments list-->
                        </div>
                        <div class="col-md-12">
                            <div class="comment-list">
                                <h4><img src="img/team-4.jpg" class="img-responsive" alt="">
                                    by User <a href="#" class="btn btn-xs btn-theme-dark">Reply</a>
                                </h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem quam, adipiscing condimentum tristique vel, eleifend sed turpis. Pellentesque cursus arcu id magna euismod in elementum purus molestie
                                </p>
                            </div><!--comments list-->
                        </div>
                    </div>
                </div><!--comments-->

                <ul class="pager">
                    <li class="previous"><a href="#">&larr; Previous Page</a></li>
                    <li class="next"><a href="#">Next Page &rarr;</a></li>
                </ul><!--pager-->
                <div class="divide60"></div>
                <div class="comment-form">
                    <h3>Leave Comment</h3>
                    <div class="form-contact">
                        <form role="form">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="email" class="form-control" id="name" required="">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="password" class="form-control" id="email" required="">
                            </div>
                            <div class="form-group">
                                <label for="message">Comment</label>
                                <textarea class="form-control" rows="7" id="message" required=""></textarea>
                            </div>                      
                            <button type="submit" class="btn btn-theme-bg btn-lg pull-right">Comment</button>
                        </form>
                    </div>
                </div>
            </div><!--col-->
            <div class="col-md-3 col-md-offset-1">
                <div class="sidebar-box margin40">
                    <h4>Search</h4>
                    <form role="form" class="search-widget">
                        <input type="text" class="form-control">
                        <i class="fa fa-search"></i>
                    </form>
                </div><!--sidebar-box-->
                <div class="sidebar-box margin40">
                    <h4>Text widget</h4>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem quam, adipiscing condimentum tristique vel, eleifend sed turpis. Pellentesque cursus arcu id magna euismod in elementum purus molestie.
                    </p>
                </div><!--sidebar-box-->
                <div class="sidebar-box margin40">
                    <h4>Categories</h4>
                    <ul class="list-unstyled cat-list">
                        <li> <a href="#">Marketing</a> <i class="fa fa-angle-right"></i></li>
                        <li> <a href="#">Videos</a> <i class="fa fa-angle-right"></i></li>
                        <li> <a href="#">Sports</a> <i class="fa fa-angle-right"></i></li>
                        <li> <a href="#">Fashion</a> <i class="fa fa-angle-right"></i></li>
                        <li> <a href="#">Media</a> <i class="fa fa-angle-right"></i></li>
                        <li> <a href="#">Seo</a> <i class="fa fa-angle-right"></i></li>
                        <li> <a href="#">Marketing</a> <i class="fa fa-angle-right"></i></li>
                    </ul>
                </div><!--sidebar-box-->
                <div class="sidebar-box margin40">
                    <h4>Popular Post</h4>
                   <ul class="list-unstyled popular-post">
                        <li>
                            <div class="popular-img">
                                <a href="#"> <img src="img/img-7.jpg" class="img-responsive" alt=""></a>
                            </div>
                            <div class="popular-desc">
                                <h5> <a href="#">blog post image</a></h5>
                                <h6>31st july 2014</h6>
                            </div>
                        </li>
                        <li>
                            <div class="popular-img">
                                <a href="#"> <img src="img/img-8.jpg" class="img-responsive" alt=""></a>
                            </div>
                            <div class="popular-desc">
                                <h5> <a href="#">blog post image</a></h5>
                                <h6>31st july 2014</h6>
                            </div>
                        </li>
                        <li>
                            <div class="popular-img">
                                <a href="#"> <img src="img/img-9.jpg" class="img-responsive" alt=""></a>
                            </div>
                            <div class="popular-desc">
                                <h5> <a href="#">blog post image</a></h5>
                                <h6>31st july 2014</h6>
                            </div>
                        </li>
                    </ul>
                </div><!--sidebar-box-->
                <div class="sidebar-box margin40">
                    <h4>Tag Cloud</h4>
                    <div class="tag-list">
                        <a href="#">Wordpress</a>
                        <a href="#">Design</a>
                        <a href="#">Graphics</a>
                        <a href="#">Seo</a>
                        <a href="#">Development</a>
                        <a href="#">Marketing</a>
                        <a href="#">fashion</a>
                        <a href="#">Media</a>
                        <a href="#">Photoshop</a>
                    </div>
                </div>
            </div><!--sidebar-col-->
        </div><!--row for blog post-->
    </div><!--blog full main container-->
    <div class="divide60"></div>
@stop