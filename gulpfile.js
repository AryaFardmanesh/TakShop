const gulp = require( 'gulp' );
const clean = require( 'gulp-clean' );
const sass = require( 'gulp-sass' )( require( 'sass' ) );
const sassSourceMaps = require( 'gulp-sourcemaps' );
const uglifycss = require( 'gulp-uglifycss' );
const typescript = require( 'gulp-typescript' );
const through2 = require( 'through2' );
const webpack = require( 'webpack-stream' );
const babel = require( 'gulp-babel' );
const terser = require( 'gulp-terser' );
const config = require( './config' );
const path = require( 'node:path' );

gulp.task( 'clean', () => gulp.src( [ '!./public/assets/**/*', './public/**/*.css', './public/**/*.css.map', './public/**/*.js' ], { allowEmpty: true, read: false } )
	.pipe( clean() )
);

gulp.task( 'clean:temp', () => gulp.src( [ '!./public/assets/**/*', '!./public/**/main.js', './public/**/*.js' ], { allowEmpty: true, read: false } )
	.pipe( clean() )
);

gulp.task( 'clean:scripts:temp', () => gulp.src( './public/scripts/', { allowEmpty: true, read: false } )
	.pipe( clean() )
);

gulp.task( 'build:style', () => gulp.src( './styles/pages/*.scss' )
	.pipe( sassSourceMaps.init() )
	.pipe( sass( config.sassConfig ).on( 'error', sass.logError ) )
	.pipe( sassSourceMaps.write( './' ) )
	.pipe( uglifycss() )
	.pipe( gulp.dest( file => {
		// Find dir name
		const targetDirName = file.basename.slice( 0, file.basename.indexOf( '.' ) );

		// Chnage file name to 'main'
		const basename = file.basename;
		let dotIndex = basename.indexOf( '.' );
		dotIndex = ( dotIndex === -1 ) ? basename.length : dotIndex;
		const filename = basename.slice( 0, dotIndex );

		file.basename = basename.replace( filename, 'main' );

		// Set destination address
		return `./public/${ targetDirName }/`;
	} ) )
);

gulp.task( 'build:typescript', () => gulp.src( [ '!./scripts/modules/**/*', './scripts/**/*.ts' ] )
	.pipe( typescript( config.typescriptConfig ) )
	.pipe( gulp.dest( './public/' ) )
);

gulp.task( 'build:javascript', () => {
	return gulp.src( [ '!./public/assets/*', './public/**/main.js' ] )
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
			const sep = path.sep;
			const dirname = file.dirname.replace( `${ sep }scripts${ sep }`, sep );
			return path.parse( dirname ).dir;
		} ) )
} );

module.exports[ 'build:scripts' ] = gulp.series(
	gulp.task( 'build:typescript' ),
	gulp.task( 'build:javascript' ),
	gulp.task( 'clean:temp' ),
	gulp.task( 'clean:scripts:temp' ),
);

module.exports.default = gulp.series(
	gulp.task( 'clean' ),
	gulp.parallel(
		gulp.task( 'build:style' ),
		module.exports[ 'build:scripts' ],
	)
);

module.exports[ 'watch:build' ] = function () {
	gulp.watch( './styles/', gulp.task( 'build:style' ) );
	gulp.watch( './scripts/', module.exports[ 'build:scripts' ] );
};
