@extends('layouts.default')
@section('title','Photos')
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
                    @for($i=0;$i<8;$i++)
                    <div class="mix col-sm-3 margin30">
                        <div class="item-img-wrap ">
                            <img src="img/img-1.jpg" class="img-responsive" alt="workimg">
                            <div class="item-img-overlay">
                                <a href="img/img-1.jpg" class="show-image">
                                    <span></span>
                                </a>
                            </div>
                        </div> 

                    </div>
                    @endfor
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