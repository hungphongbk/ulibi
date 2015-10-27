@extends('layouts.mail-default')
@section('title','Register Confirmation')
@section('main-content')
    <h3 style="color:#5F5F5F;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:13px;text-align:left;">Xin chào Trương Hùng Phong!</h3>
    <div style="text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%;">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.</div>
@stop
@section('ex-content1')
    <table border="0" cellpadding="0" cellspacing="0" width="66%" class="emailButton" style="background-color: #3498DB;">
        <tbody><tr>
            <td align="center" valign="middle" class="buttonContent" style="padding-top:15px;padding-bottom:15px;padding-right:15px;padding-left:15px;">
                <a style="color:#FFFFFF;text-decoration:none;font-family:Helvetica,Arial,sans-serif;font-size:20px;line-height:135%;" href="{{ $confirmationLink }}" target="_blank">XÁC NHẬN ĐĂNG KÝ</a>
            </td>
        </tr>
        </tbody></table>
@stop
<!--
OLD TEMPLATE
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Xác nhận đăng kí tài khoản Ulibier trên trang Ulibi.vn</h2>
<div>
    <h4>Xin chào $user->firstname $user->lastname </h4>
    <p>
        Rất hân hạnh được chào đón bạn đến với Ulibi - diễn đàn dành cho các bạn trẻ yêu phượt trên mọi miền đất nước <br>
        Chỉ còn một bước nữa thôi là bạn đã hoàn tất quá trình đăng kí của mình rồi đó. Hãy nhấn vào link "Xác nhận đăng kí" phía dưới đi nào :)
    </p>
    <a href=" URL::to('/ulibier/activated?ulibier='.$user->username) ">Xác nhận đăng kí</a>
</div>
</body>
</html>
-->