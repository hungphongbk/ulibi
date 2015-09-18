var elixir = require('laravel-elixir');
var gulp = require('gulp');

var Task = elixir.Task;
var $ = elixir.Plugins;

elixir.config.sourcemaps = true;
elixir.config.production = false;



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
        var minifyInline=require('gulp-uglify-inline');
        return gulp.src('resources/assets/ng-templates/**/*')
            .pipe(minifyInline())
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
            //.pipe($.uglify())
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
        .sass([ 'app.scss' ],'public/css/app.css')
        .copy('resources/assets/images','public/images')
        .copy('resources/assets/fonts','public/fonts')
        .html();
});
