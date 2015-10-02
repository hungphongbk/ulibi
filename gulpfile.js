var elixir = require('laravel-elixir');
elixir(function(mix) {
    var otherResources={
        'bootstrap/dist/fonts':'public/fonts',
        'font-awesome/fonts':'public/fonts'
    };
    for(var rc in otherResources){
        mix.copy('resources/assets/bower/'+rc,otherResources[rc]);
    }
    mix
        .styles([
            '../bower/bootstrap/dist/css/bootstrap.css',
            '../bower/font-awesome/css/font-awesome.css',
            '../bower/flexslider/flexslider.css'
            ])
        .scripts([
            '../bower/jquery/dist/jquery.js',
            '../bower/bootstrap/dist/js/bootstrap.js',
            '../bower/jquery.easing/js/jquery.easing.js',
            '../bower/jquery-sticky/jquery.sticky.js',
            '../bower/flexslider/jquery.flexslider.js',
            '../bower/jquery.stellar/jquery.stellar.js',
            '../bower/waypoints/lib/jquery.waypoints.js',
            '../bower/counter-up/jquery.counterup.js',
            '../bower/wow/dist/wow.js'
            ]);
});
