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
	  'resources/assets/css/materialism.css',
	  'resources/assets/css/angular-ui-select.css',
	  'resources/assets/css/helpers.css',
	  'resources/assets/css/ripples.css',
   ], 'public/css/vendor.css')
   .combine([
	  'resources/assets/css/main.css'
   ], 'public/css/app.css');

mix.js('resources/assets/js/app.js', 'public/js/')
	.js('resources/assets/js/modules/login.js', 'public/js/');
   
