<!DOCTYPE html>
<html>
<head>
    @include('includes.admin.head')
    <style>
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
@include('includes.admin.header')
<div class="container-fluid">
    @yield('content')
</div>
<footer id="footer">
    @include('includes.admin.footer')
</footer>
@include('includes.post-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>
@yield('post-page-scripts','')
</body>
</html>