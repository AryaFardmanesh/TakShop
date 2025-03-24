const path = require( 'node:path' );

module.exports.sassConfig = {
	// The SASS documentation for configuration https://sass-lang.com/documentation/js-api/
	// And for Gulp is https://www.npmjs.com/package/gulp-sass
	silenceDeprecations: [
		'legacy-js-api',
		'color-functions',
		'global-builtin'
	],
};

module.exports.typescriptConfig = require( './tsconfig.json' ).compilerOptions;

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
