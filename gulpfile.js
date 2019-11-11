var gulp = require('gulp');
var sass = require("gulp-sass");
var watch = require("gulp-watch");
var autoprefixer = require("gulp-autoprefixer");
var rename = require("gulp-rename");
var cleanCSS = require("gulp-clean-css");

var themeCSS = 'css/';

function sass(){
  return gulp.src(themeCSS+"*.sass")
    .pipe(sass())
    .pipe(autoprefixer())
    .pipe(gulp.dest(themeCSS))
    .pipe(cleanCSS())
    .pipe(rename({
      suffix: ".min"
    }))
    .pipe(gulp.dest(themeCSS));
}
exports.sass = sass;

function scss(){
  return gulp.src(themeCSS+"*.scss")
    .pipe(sass())
    .pipe(autoprefixer())
    .pipe(gulp.dest(themeCSS))
    .pipe(cleanCSS())
    .pipe(rename({
      suffix: ".min"
    }))
    .pipe(gulp.dest(themeCSS));
}

exports.scss = scss;


function watcher(){
  gulp.watch(themeCSS+"*.sass", sass);
  gulp.watch(themeCSS+"*.scss", scss);
}

exports.default = watcher;