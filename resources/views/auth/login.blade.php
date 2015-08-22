<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="icon" href="../../favicon.ico">-->

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ elixir('css/styles.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #eee;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }
        .form-signin .checkbox {
            font-weight: normal;
        }
        .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>
<body>
<div class="container">
    <form class="form-signin" method="POST" action="/auth/login">
        <h2 class="form-signin-heading">Please sign in</h2>
        {!! csrf_field() !!}

        <label for="username" class="sr-only">User name</label>
        <input class="form-control" type="text" name="username" placeholder="User name" value="{{ old('username') }}">

        <label for="password" class="sr-only">Password</label>
        <input class="form-control" type="password" name="password" id="password" placeholder="Password">

        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember">
                Remember Me
            </label>
        </div>

        <div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        </div>
    </form>
</div>
</body>
</html>