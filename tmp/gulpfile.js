/**
 * The build process is simplified with gulp
 * Define configuration first, then do the logic and business
 */
var gulp = require('gulp');
var concat = require('gulp-concat');
var templateCache = require('gulp-angular-templatecache'); // load templates using angularjs module 'templates'
var watch = require('gulp-watch');
var sass = require('gulp-sass');
var inject = require('gulp-inject'); // inject dependencies in index.html files
var bowerPath = 'bower_components';
var cfg = {
	'dist': './www/dist', // The distribution folder is public available on web server
	'index': './www/index.html',
	'dps': // Dependencies required by application, not only angularJS but also third parties like momentjs
	[
		bowerPath + '/jquery/jquery.js',
		bowerPath + '/angular/angular.js',
		bowerPath + '/angular-moment/angular-moment.js',
		bowerPath + '/angular-ui/build/angular-ui.js',
		bowerPath + '/ui-bootstrap/',
		bowerPath + '/angular-ui-router/release/angular-ui-router.js'
	],
	'app': // Application code
	[
	 	'./src/*.mdl.js',
	 	'./src/**/*.mdl.js',
	 	'./src/**/**/*.mdl.js',
        './src/common/*.mdl.js',
        './src/common/**/*.mdl.js',
        './src/common/**/**/*.mdl.js',
        './src/common/*.js',
        './src/common/**/*.js',
        './src/common/**/**/*.js',
        './src/core/*.mdl.js',
        './src/core/**/**/*.mdl.js',
        './src/core/**/*.mdl.js',
        './src/core/*.js',
        './src/core/**/*.js',
        './src/core/**/**/*.js'
    ],
    'sass': // Stylesheets with SASS
    [
    	'./src/sass/*.scss',
    	'./src/sass/**/*.scss',
    ],
    'templates': // Templates .html are compressed with javascript
    [
        './src/*.html',
        './src/**/*.html',
        './src/**/**/*.html',
        './src/**/**/**/*.html'
    ]
};

/**
 * Build Javascript files
 */
gulp.task('build-js', function () {
	
	gulp.src(cfg.dps)
		.pipe(concat('all.js'))
		.pipe(gulp.dest(cfg.dist));

	gulp.src(cfg.app)
		.pipe(concat('app.js'))
		.pipe(gulp.dest(cfg.dist));

	gulp.src(cfg.templates)
        .pipe(templateCache())
        .pipe(gulp.dest(cfg.dist));
});

/** 
 * Build SASS files
 */
gulp.task('build-sass', function() {

	gulp.src(cfg.sass)
		.pipe(sass().on('error', sass.logError))
		.pipe(gulp.dest(cfg.dist));
});

gulp.task('index', function() {
	var paths = [cfg.dist + '/app.js', cfg.dist + '/app.css'];
	paths = paths.concat(cfg.dps);
	var sources = gulp.src(paths, {read: false});
	return gulp.src(cfg.index)
				.pipe(inject(sources))
				.pipe(gulp.dest(cfg.dist));
});

/**
 * Developer task to watch and build files upon changes
 */
gulp.task('dev', function() {
	gulp.watch(cfg.app, ['build-js']);
	gulp.watch(cfg.templates, ['build-js']);
	gulp.watch(cfg.sass, ['build-sass']);
});

gulp.task('default', ['build-js', 'build-sass', 'index']);