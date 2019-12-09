// variables for required packages
const gulp = require('gulp');
const sass = require('gulp-sass');
const gcmq = require('gulp-group-css-media-queries');
const mjs = require('gulp-minify');
const mcss = require('gulp-clean-css');
const rename = require('gulp-rename');
const lec = require('gulp-line-ending-corrector');
const autoprefixer = require('gulp-autoprefixer');

// variables for file sources
const sourceSass = 'assets/css/style.scss';
const sourceJs = 'assets/js/functions.js';
const sourceWatch = 'assets/css/sass/*/**';
const sourceSEBS = 'css/sass/se-custom-bs4.scss';

// task that compiles sass, combines breakpoints, fixes line endings on windows, and minifies css
gulp.task('sass', function(done) {
    gulp
        .src(sourceSass)
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(gcmq())
        .pipe(lec())
        .pipe(mcss())
        .pipe(
            rename({
            suffix: '.min'
            })
        )
        .pipe(gulp.dest('./assets/css'));
        done();
});

//tak to compile se sass files if they exist
gulp.task('se-sass', function(done) {
    gulp
        .src(sourceSEBS)
        .pipe(sass())
        .pipe(gcmq())
        .pipe(lec())
        .pipe(gulp.dest('css'));
        done();
})

// task that minifies js
gulp.task('minify', function(done) {
    gulp
        .src(sourceJs)
        .pipe(
        mjs({
            ext: {
            min: '.min.js'
            },
            noSource: true
        })
        )
        .pipe(gulp.dest('js'));
        done();
});

// default gulp task that runs all of the tasks above
gulp.task('default', gulp.parallel('sass', 'minify'));

// watch task that watches changes in all sass files then compiles with sass task
gulp.task('watch', function(done) {
    gulp.watch(sourceWatch, gulp.parallel('sass'));
    done();
});
