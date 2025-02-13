const path = require( 'node:path' );

module.exports.sassConfig = {
	// The SASS documentation for configuration https://sass-lang.com/documentation/js-api/
	// And for Gulp is https://www.npmjs.com/package/gulp-sass
	outputStyle: 'compressed',
	linefeed: 'lf',
	sourceMap: true,
	silenceDeprecations: [ 'legacy-js-api' ],
};

module.exports.typescriptConfig = {
	// The TypeScript configuration https://www.typescriptlang.org/tsconfig/
	target: 'es2016',
	module: 'es6',
	sourceMap: true,
	removeComments: true,
	newLine: 'lf',
	noEmitOnError: true,
	allowJs: true,
	esModuleInterop: true,
	forceConsistentCasingInFileNames: true,
	strict: true,
	noImplicitAny: true,
	noImplicitThis: true,
	useUnknownInCatchVariables: true,
	noUnusedLocals: true,
	noUnusedParameters: true,
	noImplicitReturns: true,
	noImplicitOverride: true,
	skipLibCheck: true
};

module.exports.webpackConfig = {
	// The Webpack configuration https://webpack.js.org/configuration/
	mode: 'production',
	output: {
		filename: '[name].js'
	},
	externals: {
		'jquery': '$'
	}
};

module.exports.babelConfig = {
	// The Babel configuration https://babeljs.io/docs/configuration
	presets: [ '@babel/env' ]
};

module.exports.terserConfig = {
	// The Terser configuration https://github.com/terser/terser#minify-options
};
