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
	  'resources/assets/css/font-awesome.css',
    'resources/assets/css/lib/jquery-ui.css',
    'resources/assets/css/select2-materialize.css'
    ], 'public/css/vendor.css')
    .combine([
	  'resources/assets/css/app.css',
    'resources/assets/css/admin.css'
    ], 'public/css/app.css');


mix.js('resources/assets/js/lib/jquery-ui.js', 'public/js/jquery-ui.js')
   .js('resources/assets/js/rebuy.lib.js', 'public/js/rebuy.lib.js')
   .js('resources/assets/js/app.js', 'public/js/app.js')
   .js('resources/assets/js/main.js', 'public/js/main.js')
   .js('resources/assets/js/admin.js', 'public/js/admin.js')
   .js('resources/assets/js/jquery/customers/shops.js', 'public/js/shops.js')
   .js('resources/assets/js/jquery/customers/bookings.js', 'public/js/bookings.js')
   .js('resources/assets/js/jquery/profile.js', 'public/js/profile.js');
