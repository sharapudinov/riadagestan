'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');

var paths = {
  input: {
    sass: './source/sass',
    sassModule: './source/sass/css',
    sassComponent: './source/sass/components'
  },
  output: {
    install: './install',
    cssModule: './install/css',
    cssComponent: './install/components',
    cssModuleClone: '../../../bitrix/css',
    cssComponentClone: '../../../local/components',
  }
};

var config = {
  stylesOptions: {
    sassOptions: {
      includePaths: [
        './source/sass/lib'
      ]
    },
    path: paths
  },
};

gulp.task('default', ['sass' , 'copycss', 'sass:watch']);

gulp.task('sass', function() {
  gulp
    .src(paths.input.sassComponent + '/**/*.scss', {dot: true})
    .pipe(sass(config.stylesOptions.sassOptions).on('error', sass.logError))
    .pipe(gulp.dest(paths.output.cssComponent));
  gulp
    .src(paths.input.sassModule + '/**/*.scss', {dot: true})
    .pipe(sass(config.stylesOptions.sassOptions).on('error', sass.logError))
    .pipe(gulp.dest(paths.output.cssModule));
});

gulp.task('copycss', function() {
  gulp
    .src(paths.output.cssModule + '/**/*.css', {dot: true})
    .pipe(gulp.dest(paths.output.cssModuleClone));
  gulp
    .src(paths.output.cssComponent + '/**/*.css', {dot: true})
    .pipe(gulp.dest(paths.output.cssComponentClone));
});

gulp.task('sass:watch', function() {
  gulp.watch(paths.input.sass + '/**/*.scss', {dot: true}, ['sass']);
  gulp.watch(paths.output.install + '/**/*.css', {dot: true}, ['copycss']);
});
