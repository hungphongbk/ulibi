@extends('layouts.default')
@section('title','Register')
@section('content')
<div class="breadcrumb-wrap">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h4>ĐĂNG KÍ</h4>
            </div>
        </div>
    </div>
</div><!--breadcrumbs-->
<div class="divide40"></div>
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="row">
                <div class="col-sm-12">
                    <h4>Tạo một tài khoản Ulibier mới, hoàn toàn miễn phí ^^</h4>
                    <br />
                </div>
                <form role="form" method="POST" action="/ulibier/register" data-toggle="validator">
                    <div class="col-sm-6">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="fullName" style="clear: both;">Họ và tên </label>
                            <div id="fullName">
                                <input type="text" class="form-control" id="firstName" placeholder="Họ" name="firstname" style="width: 60%; float: left;">
                                <input type="text" class="form-control" id="lastName" placeholder="Tên" name="lastname" style="width: 40%">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputname">Tên đăng nhập </label>
                            <input type="text" class="form-control" id="exampleInputname1" placeholder="Name" name="username">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail11">Địa chỉ Email </label>
                            <input type="email" class="form-control" id="exampleInputEmail11" placeholder="Enter email" name="email" data-error="Địa chỉ Email không hợp lệ :)" required>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword11">Mật khẩu </label>
                            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required data-minlength="6" >
                            <span class="help-block">Cố gắng chọn mật khẩu dài ít nhất 6 kí tự nhé bạn!</span>
                        </div>
                        <div class="form-group">
                            <label for="passwordConfirm">Nhập lại mật khẩu </label>
                            <input type="password" class="form-control" id="passwordConfirm" placeholder="Password" required data-match="#password" data-match-error="Hai mật khẩu không giống nhau">
                            <div class="help-block with-errors"></div>
                        </div>
                        <!--<div class="form-group">
                            <label for="exampleInputPassword111">Re-Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword111" placeholder="Password">
                        </div> -->


                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label style="margin-right: 2em;display: block;margin-bottom: 14px;">Giới tính </label>
                            <label class="radio-inline">
                                <input type="radio" name="sex" value="male">
                                Nam
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="sex" value="female">
                                Nữ
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="birthday">Sinh nhật của bạn</label>
                            <div class="input-group date">
                                <input id="birthday" name="birthday" type="text" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phonenumber">Số điện thoại</label>
                            <input class="form-control" id="phonenumber" type="text">
                        </div>
                        <div class="form-group">
                            <label for="province">Bạn đến từ đâu?</label>
                            <select class="form-control" name="nationality" id="province">
@include('partials.vnprovinces')
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="pull-left checkbox">
                            <label>
                                <input type="checkbox"> Accept terms & condition.
                            </label>

                        </div>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-theme-dark btn-lg">Đăng kí ngay</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="divide80"></div>
@append
@stop
@section('post-page-scripts')
    <script type="text/javascript">
        $(function () {
            $('.input-group.date').datetimepicker();
        });
    </script>
@stop