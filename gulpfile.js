var elixir = require('laravel-elixir');
var group = require('laravel-elixir-group');

group.register('external',function(){
    elixir(function(mix){
        var otherResources={
            'bower/bootstrap/dist/fonts':'public/fonts',
            'bower/font-awesome/fonts':'public/fonts',
            'bower/owl.carousel/dist/assets/owl.video.play.png':'public/css/owl.video.play.png',
            'sbadmin2/dist/css':'public/css',
            'sbadmin2/dist/js':'public/js',
            'bower/requirejs-plugins/lib':'public/js/require/lib',
            'bower/requirejs-plugins/src':'public/js/require/src'
        };
        for(var rc in otherResources){
            mix.copy('resources/assets/'+rc,otherResources[rc]);
        }
        mix
            .styles([
                '../bower/bootstrap/dist/css/bootstrap.css',
                '../bower/font-awesome/css/font-awesome.css',
                '../bower/flexslider/flexslider.css',
                '../bower/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'
            ])
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
                '../bower/bootstrap-validator/dist/validator.js',
                ''
            ]);
    });
});
group.register('view',function(){
    elixir(function(mix){
        mix
            .sass('app.scss')
            .coffee([
                'jquery.coffee'
            ],'public/js/jquery.app.js');
    })
});
group.register('admin',function(){
    elixir(function(mix){
        var otherResources={
            'ngtmpl':'public/ngtmpl'
        };
        for(var rc in otherResources){
            mix.copy('resources/assets/'+rc,otherResources[rc]);
        }
        mix
            .coffee([
                'admin.coffee'
            ],'public/js/admin.js');
    })
});
group.start();