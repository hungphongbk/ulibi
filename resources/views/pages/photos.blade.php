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
                    @foreach($photos as $photo)
                    <div class="mix col-sm-3 margin30">
                        <div class="item-img-wrap ratio-500-333 thumbnail background" style="background-image: url('{{ $photo->src }}')">
                            <div class="item-img-overlay">
                                <a href="{{ $photo->src }}" class="show-image">
                                    <span></span>
                                </a>
                            </div>
                        </div> 

                    </div>
                    @endforeach
                </div><!--#grid-->
            </div>
        </div>
        <div class="row gallery-bottom">
            <div class="col-sm-6">
                {!! $photos->render() !!}
            </div>
            <div class="col-sm-6 text-right">
                <em>Displaying 1 to 8 (of 100 posts)</em>
            </div>
        </div>
    </div><!--gallery container-->
    <div class="divide60"></div>
@stop