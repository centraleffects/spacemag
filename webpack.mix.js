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
	  'resources/assets/password_strength/password_strength.css',
	  'resources/assets/materialize/css/materialize.css',
	  'resources/assets/css/font-awesome.css'
   ], 'public/css/vendor.css')
   .combine([
	  'resources/assets/css/app.css'
   ], 'public/css/app.css');


mix.js('resources/assets/js/rebuy.lib.js', 'public/js/rebuy.lib.js')
   .js('resources/assets/js/app.js', 'public/js/app.js')
   .js('resources/assets/js/main.js', 'public/js/main.js')
   .js('resources/assets/js/admin_shop_controller.js', 'public/js/admin_shop_controller.js');

   
