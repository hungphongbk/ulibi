@extends('layouts.default')
@section('title','Photos')
@section('content')
	<div class="breadcrumb-wrap">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4>Gallery</h4>
                    <div style="display: inline-block; width: 40px"></div>
                    @if(!Auth::guest())
                        <a id="uploadNewPhoto" href="#selectImage" class="btn btn-theme-dark visible-xs-inline-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><span class="fa fa-pencil"></span>&nbsp;&nbsp;Upload ảnh </a>
                    @endif
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
                    <div class="mix col-sm-3 margin10">
                        <div class="item-img-wrap ratio-500-333 thumbnail background" style="background-image: url('{{ $photo->src }}')">
                            <div class="item-img-overlay">
                                <a href="{{ $photo->src }}" class="show-img" data-encoded="{{ base64_encode(json_encode($photo)) }}" data-author-encoded="{{ base64_encode(json_encode($photo->owner)) }}" data-content-encoded="{{ base64_encode(json_encode($photo->content)) }}" data-comment-encoded="{{ base64_encode(json_encode($photo->content->comments)) }}" data-own="{{ (Auth::user()==null | Auth::user()->username!=$photo->owner->username)?'0':'1' }}">
                                    <div class="hover-info">
                                        <div>
                                            <div class="hover-info-content">
                                                <p><i class="fa fa-user"></i> {{ $photo->owner->lastname }}</p>
                                                <hr>
                                                <p>
                                                    <i class="fa fa-heart"></i>{{ $photo->content->like_count }}
                                                    <i class="fa fa-comment"></i>{{ $photo->content->comment_count }}</p>
                                            </div>
                                        </div>
                                    </div>
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
    @if(!Auth::guest())
        <div id="selectImage" class="mfp-hide mfp-dialog-zoom-in select-image-dialog">
            @include('dialogs.selectImage', [ 'ulibier' => Auth::user() ])
        </div>
    @endif
@stop
@section('post-page-scripts')
    <script>
        $('.show-img').UlibiShowImage({
            debug: true
        });
        $('#uploadNewPhoto').UlibiImageSelector({
            debug: true,
            html:{
                parentId:'#selectFromExistingImages',
                childrenSelector:'.selectable',
                uploaderId:'#uploadImageFromPC'
            },
            ajax: '{!! base64_encode(json_encode([
                "url" => route("photo.store"),
                "method" => "POST",
                "dataTemplate" => "avatar_id={0}"
            ])) !!}',
            uploadCallback: function(){
                location.reload(true);
            }
        })
    </script>
@stop