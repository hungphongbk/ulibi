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
<body ng-app="UlibiAdmin">
@include('includes.admin.header')
<div class="container-fluid" style="margin-top: 51px;">
    @yield('content')
</div>
<!--<footer id="footer">
    --@include('includes.admin.footer')
</footer>-->
@include('includes.post-scripts')
<script src="https://code.angularjs.org/1.2.16/angular-resource.js"></script>
<script src="js/admin.js"></script>
@yield('post-page-scripts','')
</body>
</html>