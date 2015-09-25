<!DOCTYPE html>
<html>
<head>
    @include('includes.head')
</head>
<body>
    @include('includes.header')
    @yield('content')
    <footer id="footer">
        @include('includes.footer')
    </footer>
    @include('includes.post-scripts')
</body>
</html>