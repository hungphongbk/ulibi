<!DOCTYPE html>
<html>
<head>
    @include('includes.head')
    @yield('head-page-scripts','')
</head>
<body>
    @include('includes.header')
    @yield('content')
    <footer id="footer">
        @include('includes.footer')
    </footer>
    @include('includes.post-scripts')
    @yield('post-page-scripts','')
</body>
</html>