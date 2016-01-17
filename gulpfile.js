'use strict';

var gulp         = require("gulp"),
    concat       = require("gulp-concat"),
    cssnano      = require("gulp-cssnano"), // minify
    notify       = require("gulp-notify"),
    uglify       = require("gulp-uglify"),
    rename       = require("gulp-rename"), // to rename any file
    sass         = require('gulp-ruby-sass'),
    postcss      = require('gulp-postcss'),
    autoprefixer = require('autoprefixer');

var config = {
  sassPath: "sass"
}

var processors = [
  autoprefixer
];

gulp.task("css", function() {
  return sass(config.sassPath + "/main.scss", { style: "expanded" })
    .pipe(postcss(processors))
    .pipe(gulp.dest("css"))
    .pipe(rename({suffix: '.min'}))
    .pipe(cssnano())
    .pipe(gulp.dest("css"));
});

gulp.task("sass:watch", function() {
  gulp.watch(config.sassPath + "/*.scss", ["css"]);
});

gulp.task("default", ["css"]);
