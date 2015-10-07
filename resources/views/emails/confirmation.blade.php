<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Xác nhận đăng kí tài khoản Ulibier trên trang Ulibi.vn</h2>
<div>
    <h4>Xin chào {{ $user->firstname }} {{$user->lastname}} </h4>
    <p>
        Rất hân hạnh được chào đón bạn đến với Ulibi - diễn đàn dành cho các bạn trẻ yêu phượt trên mọi miền đất nước <br>
        Chỉ còn một bước nữa thôi là bạn đã hoàn tất quá trình đăng kí của mình rồi đó. Hãy nhấn vào link "Xác nhận đăng kí" phía dưới đi nào :)
    </p>
    <a href="{{ URL::to('/ulibier/activated?ulibier='.$user->user_id) }}">Xác nhận đăng kí</a>
</div>
</body>
</html>