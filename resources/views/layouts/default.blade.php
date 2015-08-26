<!DOCTYPE html>
<html>
<head>
    @include('includes.head')
</head>
<body ng-app="Ulibi">
    @include('includes.header')
    <div class="container">
        @yield('content')
        <div class="row">
            @include('includes.footer')
        </div>
    </div>
</body>
</html>