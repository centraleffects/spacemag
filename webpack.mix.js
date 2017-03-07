const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.combine([
	  'resources/assets/materialize/css/materialize.css',
   ], 'public/css/vendor.css')
	.combine([
	  'resources/css/vendor/theme.css',
   ], 'public/css/theme.css')
   .combine([
	  'resources/assets/css/app.css'
   ], 'public/css/app.css');

mix.js('resources/assets/js/app.js', 'public/js/app.js');
   
