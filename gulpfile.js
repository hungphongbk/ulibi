var elixir = require('laravel-elixir');
elixir(function(mix) {
    var otherResources={
        'bootstrap/dist/fonts':'public/fonts',
        'font-awesome/fonts':'public/fonts',
        'owl.carousel/dist/assets/owl.video.play.png':'public/css/owl.video.play.png'
    };
    for(var rc in otherResources){
        mix.copy('resources/assets/bower/'+rc,otherResources[rc]);
    }

    mix
        .sass('app.scss')
        .styles([
            '../bower/bootstrap/dist/css/bootstrap.css',
            '../bower/font-awesome/css/font-awesome.css',
            '../bower/flexslider/flexslider.css',
            '../bower/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'
            ])
        .scripts([
            'admin.js'
            ],'public/js/admin.js')
        .copy('resources/assets/ngtmpl','public/ngtmpl')
        .scripts([
            '../bower/jquery/dist/jquery.js',
            '../bower/bootstrap/dist/js/bootstrap.js',
            '../bower/jquery.easing/js/jquery.easing.js',
            '../bower/jquery-sticky/jquery.sticky.js',
            '../bower/flexslider/jquery.flexslider.js',
            '../bower/jquery.stellar/jquery.stellar.js',
            '../bower/waypoints/lib/jquery.waypoints.js',
            '../bower/counter-up/jquery.counterup.js',
            '../bower/wow/dist/wow.js',
            '../bower/moment/moment.js',
            '../bower/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
            '../bower/bootstrap-validator/dist/validator.js'
            ]);
});
