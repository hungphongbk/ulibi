var elixir = require('laravel-elixir');
var gulp = require('gulp');

var Task = elixir.Task;
var $ = elixir.Plugins;

elixir.config.sourcemaps = true;
elixir.config.production = true;

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

elixir.extend('html', function(conf) {
    conf=(conf===undefined)?{}:conf;
    conf.js=(conf.js===undefined)?{}:conf.js;

    var output = conf.output || 'public';
    var jssource = conf.js['inputPath'] || 'resources/assets/js';
    var outFile = conf.js['outputFile'] || 'app.js';
    var out = conf.js['outputPath'] || (output+'/js');

    var inline = require('gulp-inline-source');
    var nginclude = require('gulp-nginclude');
    var runseq = require('run-sequence');
    var ngtools={
        annotate: require('gulp-ng-annotate'),
        filesort: require('gulp-angular-filesort')
    };

    gulp.task('html:copy:index', function(){
        return gulp
            .src('resources/assets/index.html')
            .pipe(gulp.dest(output, {overwrite: true}))
    });
    gulp.task('html:copy:templates', function(){
        return gulp.src('resources/assets/ng-templates/**/*')
            .pipe(gulp.dest(output+'/ng-templates', {overwrite: true}));
    });
    gulp.task('html:copy', ['html:copy:index', 'html:copy:templates']);

    gulp.task('html:inline', function(){
        return gulp.src(output+'/index.html')
            .pipe(inline())
            .pipe(gulp.dest(output, {overwrite: true}));
    });
    gulp.task('html:js:angular', function () {
        return gulp.src([
            jssource + '/**/*.js'
        ])
            .pipe($.if(config.sourcemaps, $.sourcemaps.init()))
            .pipe(ngtools.annotate())
            .pipe(ngtools.filesort())
            .pipe($.concat(outFile))
            .pipe($.uglify())
            .pipe($.if(config.sourcemaps, $.sourcemaps.write('.')))
            .pipe(gulp.dest(out));
    });
    gulp.task('html:nginclude', function(){
        return gulp.src([output+'/index.html', 'ng-templates/**/*.html'])
            .pipe(nginclude())
            .pipe(gulp.dest(output, {overwrite: true}));
    });

    new Task('html', function(){
        return runseq('html:copy','html:js:angular','html:inline');
    });
});

elixir(function(mix) {
    mix
        .less([ 'app.less' ],'public/css/app.css')
        .styles([
            '../../../bower_components/bootstrap/dist/css/bootstrap.css',
            '../../../bower_components/bootstrap-material-design/dist/css/material.css',
            '../../../bower_components/bootstrap-material-design/dist/css/material-fullpalette.css',
            '../../../bower_components/bootstrap-material-design/dist/css/ripples.css',
            '../../../bower_components/bootstrap-material-design/dist/css/roboto.css',
        ],'public/css/external.css')
        .scripts([
            '../../../bower_components/jquery/dist/jquery.js',
            '../../../bower_components/angularjs/angular.js',
            '../../../bower_components/satellizer/satellizer.js',
            '../../../bower_components/angular-ui-router/release/angular-ui-router.js',
            '../../../bower_components/angular-animate/angular-animate.js',
            '../../../bower_components/angular-aria/angular-aria.js',
            '../../../bower_components/bootstrap-material-design/dist/js/material.js',
            '../../../bower_components/bootstrap-material-design/dist/js/ripples.js'

        ],'public/js/external.js')
        .copy('resources/assets/images','public/images')
        .copy('resources/assets/fonts','public/fonts')
        .html();
});
