var elixir = require('laravel-elixir');
var gulp = require('gulp');

var Task = elixir.Task;
var $ = elixir.Plugins;

elixir.config.sourcemaps = false;

elixir.extend('uglifyAll', function(src, output, options){
    var gulpFilter = require('gulp-filter');

    var filter  = gulpFilter(['**/*', '!**/*.min.js']);

    options = options === undefined ? {} : options;
    output = output || 'public/js';
    src = output + '/**/*.js';

    new Task('uglifyAll', function() {

        var onError = function(err) {
            new Notification().error(err, 'Error on line : <%= error.lineNumber %>\n');
            this.emit('end');
        };

        return gulp.src(src)
            .pipe(filter)
            .pipe($.uglify(options)).on('error', onError)
            .pipe($.rename({extname: '.min.js'}))
            .pipe(gulp.dest(output))
            .pipe(new elixir.Notification('Javascript uglified!'));

    });
});
elixir.extend('angular', function (src, output, outputFilename)  {
    var fs = require('fs');
    var streamqueue = require('streamqueue');
    var ngtools={
        annotate: require('gulp-ng-annotate'),
        filesort: require('gulp-angular-filesort')
    };

    var config = elixir.config;
    var baseDir = src || config.assetsPath + '/angular';
    var out = output || config.get('public.js.outputFolder') + '/app/';
    var outFile = outputFilename || 'application.js';

    new Task('angular', function () {
        var ng = gulp.src([
            baseDir + '/*.module.js',
            baseDir + '/**/*.module.js',
            baseDir + '/**/*.js'
        ])
            .pipe($.if(config.sourcemaps, $.sourcemaps.init()))
            .pipe(ngtools.annotate())
            .pipe(ngtools.filesort());

        return ng
            .pipe($.concat(outFile))
            .pipe($.if(config.sourcemaps, $.sourcemaps.write('.')))
            .pipe(gulp.dest(out))
            .pipe(new elixir.Notification('Angular compiled!'));
    });
});
elixir.extend('html', function(out) {
    var output = out || 'public';
    var inline = require('gulp-inline-source');
    var nginclude = require('gulp-nginclude');
    var runseq = require('run-sequence');

    gulp.task('html:inline', function(){
        return gulp.src(output+'/index.html')
            .pipe(inline())
            .pipe(gulp.dest(output, {overwrite: true}));
    });
    gulp.task('html:nginclude', function(){
        return gulp.src([output+'/index.html', 'ng-templates/**/*.html'])
            .pipe(nginclude())
            .pipe(gulp.dest(output, {overwrite: true}));
    });

    new Task('html', function(){
        return runseq('html:inline');
    });
});

elixir(function(mix) {
    mix
        .less([ 'app.less' ],'public/css/app.css')
        .styles([
            '../../../bower_components/bootstrap/dist/css/bootstrap.css'
        ],'public/css/external.css')
        .scripts([
            '../../../bower_components/jquery/dist/jquery.js',
            '../../../bower_components/bootstrap/dist/js/bootstrap.js',
            '../../../bower_components/angularjs/angular.js',
            '../../../bower_components/satellizer/satellizer.js',
            '../../../bower_components/angular-ui-router/release/angular-ui-router.js'
        ],'public/js/external.js')
        .angular('resources/assets/js/','public/js/','app.js')
        .uglifyAll()
        .copy('resources/assets/index.html','public/index.html')
        .copy('resources/assets/ng-templates','public/ng-templates')
        .copy('resources/assets/images','public/images')
        .html();
});
