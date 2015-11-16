<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<base href="{{ url() }}/" />
<title>Ulibi - @yield('title')</title>

<!-- Bootstrap -->
<link href="css/all.css" rel="stylesheet" media="screen">
<!--google fonts-->
<script type="text/javascript">
    WebFontConfig = {
        google: { families: [
            'Open+Sans:400,700,600,500,400italic,300italic,300:latin,vietnamese,latin-ext'
        ] }
    };
    (function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
    })();
    @if(Auth::user())
        window.authToken = '{{ base64_encode(Auth::user()->username) }}';
    @endif
</script>
<!-- custom css-->
<link href="css/app.css" rel="stylesheet">
<!-- animated css  -->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="screen"> 
<!--Revolution slider css
<link href="rs-plugin/css/settings.css" rel="stylesheet" type="text/css" media="screen">

<!--mega menu -->
<link href="css/yamm.css" rel="stylesheet" type="text/css">
<!--cube css-->
<link href="cubeportfolio/css/cubeportfolio.min.css" rel="stylesheet" type="text/css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->