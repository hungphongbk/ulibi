var elixir = require('laravel-elixir');
elixir(function(mix) {
    var otherResources={
        'bower/bootstrap/dist/fonts':'public/fonts',
        'bower/font-awesome/fonts':'public/fonts',
        'bower/owl.carousel/dist/assets/owl.video.play.png':'public/css/owl.video.play.png',
        'ngtmpl':'public/ngtmpl',
        'sbadmin2/dist/css':'public/css',
        'sbadmin2/dist/js':'public/js'
    };
    for(var rc in otherResources){
        mix.copy('resources/assets/'+rc,otherResources[rc]);
    }

    mix
        .sass('app.scss')
        .styles([
            '../bower/bootstrap/dist/css/bootstrap.css',
            '../bower/font-awesome/css/font-awesome.css',
            '../bower/flexslider/flexslider.css',
            '../bower/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'
            ])
        .coffee([
            'admin.coffee'
            ],'public/js/admin.js')
        .scripts([
            '../bower/angular/angular.js',
            '../bower/angular-ui-router/release/angular-ui-router.js',
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
