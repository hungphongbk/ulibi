@extends('layouts.default')
@section('content')
	<div class="breadcrumb-wrap">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h4>Gallery</h4>
                </div>
                <div class="col-sm-6 hidden-xs text-right">
                    <ol class="breadcrumb">
                        <li><a href="index.html">Portfolio</a></li>
                        <li>gallery</li>
                    </ol>
                </div>
            </div>
        </div>
    </div><!--breadcrumbs-->
    <div class="divide80"></div>
    <div class="container">
        <div class="row">


            <div class="col-md-12">


                <div id="grid" class="row">
                    <div class="mix col-sm-3 page1 page4 margin30">
                        <div class="item-img-wrap ">
                            <img src="img/img-1.jpg" class="img-responsive" alt="workimg">
                            <div class="item-img-overlay">
                                <a href="img/img-1.jpg" class="show-image">
                                    <span></span>
                                </a>
                            </div>
                        </div> 

                    </div>
                    <div class="mix col-sm-3 page2 page3 margin30">
                        <div class="item-img-wrap ">
                            <img src="img/img-2.jpg" class="img-responsive" alt="workimg">
                            <div class="item-img-overlay">
                                <a href="img/img-2.jpg" class="show-image">
                                    <span></span>
                                </a>
                            </div>
                        </div> 

                    </div>
                    <div class="mix col-sm-3  page3 page2 margin30 ">
                        <div class="item-img-wrap ">
                            <img src="img/img-3.jpg" class="img-responsive" alt="workimg">
                            <div class="item-img-overlay">
                                <a href="img/img-3.jpg" class="show-image">
                                    <span></span>
                                </a>
                            </div>
                        </div> 

                    </div>
                    <div class="mix col-sm-3  page4 margin30">
                        <div class="item-img-wrap ">
                            <img src="img/img-4.jpg" class="img-responsive" alt="workimg">
                            <div class="item-img-overlay">
                                <a href="img/img-4.jpg" class="show-image">
                                    <span></span>
                                </a>
                            </div>
                        </div> 

                    </div>
                    <div class="mix col-sm-3 page1 margin30 ">
                        <div class="item-img-wrap ">
                            <img src="img/img-5.jpg" class="img-responsive" alt="workimg">
                            <div class="item-img-overlay">
                                <a href="img/img-5.jpg" class="show-image">
                                    <span></span>
                                </a>
                            </div>
                        </div> 

                    </div>
                    <div class="mix col-sm-3  page2 margin30">
                        <div class="item-img-wrap ">
                            <img src="img/img-6.jpg" class="img-responsive" alt="workimg">
                            <div class="item-img-overlay">
                                <a href="img/img-6.jpg" class="show-image">
                                    <span></span>
                                </a>
                            </div>
                        </div> 

                    </div>
                    <div class="mix col-sm-3  page3 margin30">
                        <div class="item-img-wrap ">
                            <img src="img/img-7.jpg" class="img-responsive" alt="workimg">
                            <div class="item-img-overlay">
                                <a href="img/img-7.jpg" class="show-image">
                                    <span></span>
                                </a>
                            </div>
                        </div> 

                    </div>
                    <div class="mix col-sm-3 page4  margin30">
                        <div class="item-img-wrap ">
                            <img src="img/img-8.jpg" class="img-responsive" alt="workimg">
                            <div class="item-img-overlay">
                                <a href="img/img-8.jpg" class="show-image">
                                    <span></span>
                                </a>
                            </div>
                        </div> 

                    </div>                                                            

                </div><!--#grid-->
            </div>
        </div>
        <div class="row gallery-bottom">
            <div class="col-sm-6">
                <ul class="pagination">
                    <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-6 text-right">
                <em>Displaying 1 to 8 (of 100 posts)</em>
            </div>
        </div>
    </div><!--gallery container-->
    <div class="divide60"></div>
@stop