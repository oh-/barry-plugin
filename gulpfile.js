var gulp = require('gulp');

gulp.task('default', function() {
	// place code for your default theme here
});
gulp.tast('compass'. function() {
	gulp.src('sass')
		.pipe(compass())
		.pipe(gulp.dest('styles.css'));
});
