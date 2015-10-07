@extends('layouts.default')
@section('title','Email Confirmation')
@section('content')
    <div class="breadcrumb-wrap">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h4>Đăng kí thành công</h4>
                </div>
            </div>
        </div>
    </div><!--breadcrumbs-->
    <div class="divide80"></div>
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-6 col-sm-offset-3">
                <h4 class="text-success">
                    Chúc mừng {{ $user->lastname }}, từ bây giờ bạn đã có thể đăng nhập vào Ulibi với email {{ $user->email }} hoặc tên đăng nhập là {{ $user->username }}
                </h4>
                <a href="/" class="btn btn-success btn-lg">QUAY TRỞ LẠI TRANG CHỦ</a>
            </div>
        </div>
    </div>
    <div class="divide80"></div>
    <div class="divide80"></div>
@stop