@extends('layouts.default')
@section('title','Blog details')
@section('content')
    <div class="divide80"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="blog-post">
                    <div class="ratio-1920-850 hover-zoomout-darken">
                        <div class="background" style="background-image: url('{{ $article->thumbnail_1000 }}');">
                        </div>
                    </div>
                    @include('includes.templates.postDetail',[
                        'article' => $article,
                        'showCommentCount' => true
                    ])
                    <h2>{{ $article->article_title }}</h2>
                    {!! $article->content_as_html !!}
                    <div class="divide20">
                    </div>
                    <div class="blog-like">

                        {!! Form::open(array('route'=>'ulibier.like', 'id'=>'likeForm')) !!}
                        {!! Form::hidden('content_id', $article->content->content_id) !!}

                        <p>
                            <a class='blog-like-btn' href='javascript:document.getElementById("likeForm").submit()'>
                                <i class="fa {{ ($article->content->liked)?'fa-heart':'fa-heart-o' }}"></i>
                            </a>
                            <span class='like-count'>{{ $article->content->like_count }}</span> lượt thích
                            <i class="fa fa-comment" style="margin-left: 1em;"></i>
                            <span class="comment-count">{{ $article->content->comment_count }}</span> lượt bình luận
                        </p>

                        {!! Form::close() !!}

                    </div>
                </div><!--about author-->
                <div id="comment-container-article" data-id="{{ $article->article_id }}"></div>
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
@section('head-page-scripts')
    <meta name="author" content="{{ $article->ulibier->full_name }}">
@stop
@section('post-page-scripts')
    <script>
        $('#comment-container-article').UlibiArticleComment();
    </script>
@stop