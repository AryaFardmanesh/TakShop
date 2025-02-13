const gulp = require( 'gulp' );
const clean = require( 'gulp-clean' );
const sass = require( 'gulp-sass' )( require( 'sass' ) );
const sassSourceMaps = require( 'gulp-sourcemaps' );
const typescript = require( 'gulp-typescript' );
const through2 = require( 'through2' );
const webpack = require( 'webpack-stream' );
const babel = require( 'gulp-babel' );
const terser = require( 'gulp-terser' );
const config = require( './config' );
const path = require( 'node:path' );

gulp.task( 'clean', () => gulp.src( [ './lib/css/', '!./lib/repo/**/*.js', './lib/**/*.js' ], { allowEmpty: true, read: false } )
	.pipe( clean() )
);

gulp.task( 'clean:temp', () => gulp.src( [ '!./lib/repo/', '!./lib/repo/**/*.js', '!./lib/**/main.js', './lib/**/*.js' ], { allowEmpty: true, read: false } )
	.pipe( clean() )
);

gulp.task( 'build:style', () => gulp.src( './styles/main.scss' )
	.pipe( sassSourceMaps.init() )
	.pipe( sass( config.sassConfig ).on( 'error', sass.logError ) )
	.pipe( sassSourceMaps.write( './' ) )
	.pipe( gulp.dest( './lib/css' ) )
);

gulp.task( 'build:typescript', () => gulp.src( './scripts/**/*.ts' )
	.pipe( typescript( config.typescriptConfig ) )
	.pipe( gulp.dest( './lib/' ) )
);

gulp.task( 'build:compiledjs', () => {
	return gulp.src( [ './lib/**/main.js' ] )
		.pipe( through2.obj( ( file, enc, cb ) => {
			const filePath = file.path;
			config.webpackConfig.entry = filePath;
			config.webpackConfig.output.path = filePath;

			file.contents = webpack( config.webpackConfig ).pipe( through2.obj( ( webpackFile, enc, webpackCb ) => {
				cb( null, webpackFile ); // Pass the processed file to the next step
				webpackCb();
			} ) );
		} ) )
		.pipe( babel( config.babelConfig ) )
		.pipe( terser( config.terserConfig ) )
		.pipe( gulp.dest( function ( file ) {
			return path.parse( file.dirname ).dir;
		} ) )
} );

module.exports[ 'build:scripts' ] = gulp.series(
	gulp.task( 'build:typescript' ),
	gulp.task( 'build:compiledjs' ),
	gulp.task( 'clean:temp' ),
);

module.exports.default = gulp.series(
	gulp.task( 'clean' ),
	gulp.task( 'build:style' ),
	module.exports[ 'build:scripts' ],
);

module.exports[ 'watch:build' ] = function () {
	gulp.watch( './styles/', gulp.task( 'build:style' ) );
	gulp.watch( './scripts/', module.exports[ 'build:scripts' ] );
};
