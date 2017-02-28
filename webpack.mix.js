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
	  'public/assets/css/materialism.css',
	  'public/assets/css/angular-ui-select.css',
	  'public/assets/css/helpers.css',
	  'public/assets/css/ripples.css',
   ], 'public/css/vendor.css')
   .combine([
	  'public/assets/css/main.css'
   ], 'public/css/app.css');

mix.js('public/assets/js/app.js', 'public/js/')
	.js('public/assets/js/modules/login.js', 'public/js/');
   
