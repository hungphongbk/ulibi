<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Xác nhận đăng kí tài khoản Ulibier trên trang Ulibi.vn</h2>
<div>
    <h4>Xin chao {{ $user->firstname }} {{$user->lastname}} </h4>
    <p>
        Rat han hanh chao don ban da den voi Ulibi - .... <br>
        Chi con mot buoc nua thoi...
        Hay nhan vao nut "Xac nhan dang ki" phia duoi de hoan tat qua trinh dang ky :)
    </p>
    <a href="{{ URL::to('/ulibier/confirm?ulibier='.$user->username) }}">Xac nhan dang ki</a>
</div>
</body>
</html>