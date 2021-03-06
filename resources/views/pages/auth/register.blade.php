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
                    @if(count($errors)==0)
                        <h4>Tạo một tài khoản Ulibier mới, hoàn toàn miễn phí ^^</h4>
                    @else
                        @foreach ($errors->all() as $error)
                            <h5 class="text-danger">{{ $error }}</h5>
                        @endforeach
                    @endif
                    <br />
                </div>
                <form role="form" method="POST" action="/ulibier/register" data-toggle="validator">
                    <div class="col-sm-12">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="fullName" style="clear: both;">Họ và tên </label>
                            <div id="fullName">
                                <input type="text" class="form-control" id="firstName" placeholder="Họ" name="firstname" style="width: 60%; float: left;" value="">
                                <input type="text" class="form-control" id="lastName" placeholder="Tên" name="lastname" style="width: 40%" value="">
                            </div>
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