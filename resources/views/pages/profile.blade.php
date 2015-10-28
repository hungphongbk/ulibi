@extends('layouts.default')
@section('title','Profile')
@section('content')

<?php
/** @var \App\Ulibier $ulibier */
$myProfile=Auth::user()==$ulibier;
?>

<div class="cover background cover-ulibier-profile" style="background-image: url(img/showcase-1.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-fixed-sm-200">
                <div class="ratio-500-500 background img-circle shadow" style="background-image: url('{{ $ulibier->thumbnail_400 }}');">
                    @if($myProfile)
                        <div class="wrapper replace-image text-center">
                            <span class="fa fa-2x fa-camera" style="top: 50%;position: relative;display: block;margin-top: -16px;"></span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-fixed-offset-sm-200">
                <div class="divide20"></div>
                <h3 class="profile-item">
                    {{ $ulibier->full_name }}
                    @if($myProfile)
                        <span class="replace-text-inline">
                            <a href=""><i class="fa fa-pencil"></i></a>
                        </span>
                    @endif
                </h3>
                <p class="profile-item">
                    <i class="fa fa-map-marker"></i>
                    {{ $ulibier->profile->basicinfo_currentPlace }}
                    @if($myProfile)
                        <span class="replace-text-inline">
                            <a href=""><i class="fa fa-pencil"></i></a>
                        </span>
                        @endif
                </p>
                <p class="profile-item">
                    <i class="fa fa-birthday-cake"></i>
                    {{ $ulibier->profile->birthday->formatLocalized('%d %B %Y') }}
                    (<strong>{{ Carbon\Carbon::now()->diff($ulibier->profile->birthday)->y }}</strong> tuổi)
                    @if($myProfile)
                        <span class="replace-text-inline">
                            <a href=""><i class="fa fa-pencil"></i></a>
                        </span>
                    @endif
                </p>
            </div>
        </div>
        @if($myProfile)
            <div style="position: absolute;right: 20px;bottom: 20px;">
                <div class="replace-text">
                    <div style="border: 2px solid #ffffff;border-radius: 4px;padding: 8px 15px;">
                        <span><i class="fa fa-camera"></i> Thay đổi cover</span>
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
@include("pages.profile.$tab", ["ulibier" => $ulibier, "profile" => $profile]);
@stop
@section('head-page-scripts')
    <style>
        body{
            background-color: #f2f4f8;
        }
        .profile-tabs {
            background-color: #fff;
        }
    </style>
@stop