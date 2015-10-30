@extends('layouts.default')
@section('title','Blogs')
@section('content')
	<div class="breadcrumb-wrap">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="visible-xs-inline-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">Blog 2 col</h4>
                    <div style="display: inline-block; width: 40px"></div>
                    @if(!Auth::guest())
                    <a href="{{ $createUrl }}" class="btn btn-theme-dark visible-xs-inline-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><span class="fa fa-pencil"></span>&nbsp;&nbsp;Bài viết mới</a>
                    @if(isset($manageUrl))
                    <a href="{{ $manageUrl }}" class="btn border-black visible-xs-inline-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><span class="fa fa-file-text"></span>&nbsp;&nbsp;Quản lý bài viết của bạn</a>
                    @endif
                    @endif
                </div>
                <div class="col-sm-6 hidden-xs text-right">
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li>blog-2col</li>
                    </ol>
                </div>
            </div>
        </div>
    </div><!--breadcrumbs-->
    <div class="divide80"></div>
    <div class="container">
        <div class="row">
            <div class="{{ $bsColumn['left'] }}">
                <div <?php /** @var string $viewTemplate */
                        if($viewTemplate=='blogitem2col') echo "class='mansory-2-col'";
                        ?>>
                    @each('includes.templates.'.$viewTemplate,$articles,'article')
                </div>
                {!! $articles->render() !!}
            </div>
            <div class="{{ $bsColumn['right'] }}">
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
        </div>
    </div><!--blog full main container-->
    <div class="divide60"></div>
@stop
@section('head-page-scripts')
    <link rel="stylesheet" href="css/sweetalert.css" type="text/css">
@stop
@section('post-page-scripts')
    @if(!Auth::guest())
        <script src="js/sweetalert.min.js" type="text/javascript"></script>
        <script>
            function refresh(){
                location.reload(true);
            }
            $('[data-action="deleteItem"]').DeleteBlogArticle({
                csrf_token: '{{ csrf_token() }}',
                debug: true,
                callback: refresh
            });
        </script>
    @endif
@stop