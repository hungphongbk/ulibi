@extends('layouts.default')
@section('title','Profile')
@section('content')

<?php
/** @var \App\Ulibier $ulibier */
$myProfile=Auth::user()==$ulibier;
?>

<div class="cover background cover-ulibier-profile" style="background-size: cover; background: url('{{ $ulibier->cover }}') 50% 50%;">
    <div class="container">
        <div class="row">
            <div class="col-fixed-sm-200">
                <div class="ratio-500-500 background img-circle shadow" style="background-image: url('{{ $ulibier->thumbnail_400 }}');">
                    @if($myProfile)
                        <div class="wrapper replace-image text-center">
                            <span id="changeAvatar" href="#selectImage" class="fa fa-2x fa-camera" style="top: 50%;position: relative;display: block;margin-top: -16px;"></span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-fixed-offset-sm-200">
                <div class="divide20"></div>
                <h3 class="profile-item">
                    {{ $ulibier->full_name }}
                    {!! HTML::profileEditable($ulibier, 1) !!}
                </h3>

                @if(!empty($ulibier->profile->basicinfo_currentPlace))
                <p class="profile-item">
                    <i class="fa fa-map-marker"></i>
                    {{ $ulibier->profile->basicinfo_currentPlace }}
                    {!! HTML::profileEditable($ulibier, 1) !!}
                </p>
                @endif

                @if(!empty($ulibier->profile->birthday))
                <p class="profile-item">
                    <i class="fa fa-birthday-cake"></i>
                    {{ $ulibier->profile->birthday->formatLocalized('%d %B %Y') }}
                    (<strong>{{ Carbon\Carbon::now()->diff($ulibier->profile->birthday)->y }}</strong> tuổi)
                    {!! HTML::profileEditable($ulibier, 1) !!}
                </p>
                @endif
            </div>
        </div>
        @if($myProfile)
            <div style="position: absolute;right: 20px;bottom: 20px;">
                <div class="replace-text">
                    <div style="border: 2px solid #ffffff;border-radius: 4px;padding: 8px 15px;">
                        <span id="changeCover" href="#selectImage"><i class="fa fa-camera"></i> Thay đổi cover</span>
                    </div>
                </div>
            </div>
            @endif
    </div>
</div>
<!--breadcrumb light-->
<!--use it as tab navigation-->
<div>
    <ul class="list-inline profile-tabs">
        <li {{ $tab=='info'?"class=selected":"" }}>
            <a href="{{ url(Request::url()."?tab=info") }}">Thông tin Ulibier</a>
        </li>
        <li {{ $tab=='articles'?"class=selected":"" }}>
            <a href="{{ url(Request::url()."?tab=articles") }}">Bài viết</a>
        </li>
        <li {{ $tab=='photos'?"class=selected":"" }}>
            <a href="{{ url(Request::url()."?tab=photos") }}">Ảnh</a>
        </li>
        <li {{ $tab=='travels'?"class=selected":"" }}>
            <a href="{{ url(Request::url()."?tab=travels") }}">Nhật kí du lịch</a>
        </li>
    </ul>
</div>
@include("pages.profile.$tab", ["ulibier" => $ulibier, "profile" => $profile])
<!-- dialogs -->
<div id="selectImage" class="mfp-hide mfp-dialog-zoom-in select-image-dialog">
    @include('dialogs.selectImage')
</div>
<div id="editInformation" class="mfp-hide mfp-dialog-zoom-in edit-information-dialog">
    @include('dialogs.editProfileInformation')
</div>
<!-- dialogs end -->
@stop
@section('head-page-scripts')
    <link href="sky-form/css/sky-forms.css" rel="stylesheet">
    <link rel="stylesheet" href="css/sweetalert.css" type="text/css">
    <style>
        body{
            background-color: #f2f4f8;
        }
        .profile-tabs {
            background-color: #fff;
        }
    </style>
@stop
@section('post-page-scripts')
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
        var debug=true;
        $('#changeAvatar').UlibiImageSelector({
            debug: debug,
            html:{
                parentId:'#selectFromExistingImages',
                childrenSelector:'.selectable',
                uploaderId:'#uploadImageFromPC'
            },
            ajax: '{!! base64_encode(json_encode([
                "url" => route("profile.update", [$profile]),
                "method" => "PUT",
                "dataTemplate" => "_token=".csrf_token()."&avatar_id={0}"
            ])) !!}'
        });
        $('#changeCover').UlibiImageSelector({
            debug: debug,
            html:{
                parentId:'#selectFromExistingImages',
                childrenSelector:'.selectable',
                uploaderId:'#uploadImageFromPC'
            },
            ajax: '{!! base64_encode(json_encode([
                "url" => route("profile.update", [$profile]),
                "method" => "PUT",
                "dataTemplate" => "_token=".csrf_token()."&cover_id={0}"
            ])) !!}'
        });
        $(".edit-information").UlibiProfileInformationEditor({
            debug: debug,
            html: {
                dialogSelector: '#editInformation',
                formSelector: '#sky-form'
            }
        });
    </script>
@stop