<!--scripts and plugins -->
<!--must need plugin jquery-->
<script src="js/all.js"></script>
<!--digit countdown plugin-->
<!--<script src="js/jquery.counterup.min.js" type="text/javascript"></script>-->
<!--on scroll animation-->
<!--<script src="js/wow.min.js" type="text/javascript"></script> -->
<!--owl carousel slider-->
<!--<script src="js/owl.carousel.min.js" type="text/javascript"></script>-->
<!--popup js-->
<!--<script src="js/jquery.magnific-popup.min.js" type="text/javascript"></script>-->
<!--you tube player-->
<!--<script src="js/jquery.mb.YTPlayer.min.js" type="text/javascript"></script>-->
<!--customizable plugin edit according to your needs
<script src="js/custom.js" type="text/javascript"></script>

<!--revolution slider plugins-->
<script src="js/jquery.themepunch.tools.min.js" type="text/javascript"></script>
<script src="js/jquery.themepunch.revolution.min.js" type="text/javascript"></script>
<!--cube portfolio plugin-->
<script src="cubeportfolio/js/jquery.cubeportfolio.min.js" type="text/javascript"></script>
<script src="js/cube-portfolio.js" type="text/javascript"></script>
<script src="js/pace.min.js" type="text/javascript"></script>
<!--<script src="js/require.js" type="text/javascript"></script>-->
<script src="js/jquery.app.js" type="text/javascript"></script>
<!-- GOOGLE ANALYTICS -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-69189455-1', 'none');
    ga('send', 'pageview');

</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });
</script>