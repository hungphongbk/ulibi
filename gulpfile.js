var elixir = require('laravel-elixir');
var gulp = require('gulp');

var Task = elixir.Task;
var $ = elixir.Plugins;

elixir.config.sourcemaps = false;

elixir.extend('angular', function (src, output, outputFilename)  {
    var fs = require('fs');
    var streamqueue = require('streamqueue');
    var concat = require('gulp-concat');
    var ngtools={
        annotate: require('gulp-ng-annotate'),
        filesort: require('gulp-angular-filesort')
    };

    var config = elixir.config;
    var baseDir = src || config.assetsPath + '/angular';
    var out = output || config.get('public.js.outputFolder') + '/app/';
    var outFile = outputFilename || 'application.js';
    var append = false;

    new Task('angular', function () {
        if (fs.existsSync(out+outFile))
            append=true;

        var ng = gulp.src([
            baseDir + '/*.module.js',
            baseDir + '/**/*.module.js',
            baseDir + '/**/*.js'
        ])
            .pipe($.if(config.sourcemaps, $.sourcemaps.init()))
            .pipe(ngtools.annotate())
            .pipe(ngtools.filesort());
        if (append) ng = streamqueue({objectMode: true},
            gulp.src(out+outFile),
            ng
        );
        return ng
            .pipe($.concat(outFile))
            .pipe($.if(config.production, $.uglify()))
            .pipe($.if(config.sourcemaps, $.sourcemaps.write('.')))
            .pipe(gulp.dest(out))
            .pipe(new elixir.Notification('Angular compiled!'));
    });
});


elixir(function(mix) {
    mix
        .less([
            '../../../bower_components/bootstrap/less/bootstrap.less',
            'app.less'
        ],'public/css/app.css')
        .scripts([
            '../../../bower_components/jquery/dist/jquery.js',
            '../../../bower_components/angularjs/angular.js',
            '../../../bower_components/satellizer/satellizer.js',
            '../../../bower_components/angular-ui-router/release/angular-ui-router.js'
        ])
        .angular('resources/assets/js/','public/js/','all.js')
        .copy('resources/assets/ng-templates','public/views');
});
