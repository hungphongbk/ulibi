@extends('layouts.default')
@section('title')
    Homepage
@stop
@section('content')
    <style>
        .section {
            padding: 40px 15px;
            text-align: center;
        }
        #main {

        }
    </style>
    <div class="row section" id="main">
        <h1>Ulibi</h1>
        <h3>Trang thông tin dành cho các bạn trẻ mê phượt</h3>
        <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
        <a class="btn btn-success" href="#reason">Bắt đầu</a>
    </div>
    <div class="row section" id="reason">
        <h3>Chia sẻ những khoảnh khắc và cảm nhận của bạn trong từng chuyến đi</h3>
        <div bootstrap-col="12 4 4 4">
            <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Blog</h2>
        </div>
        <div bootstrap-col="12 4 4 4">
            <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Photo</h2>
        </div>
        <div bootstrap-col="12 4 4 4">
            <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Share</h2>
        </div>
    </div>
    <div class="row section" id="how">
        <div bootstrap-col="12 7 7 7">
            <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It'll blow your mind.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div bootstrap-col="12 5 5 5">
            <img class="img-responsive center-block" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
    </div>
@stop