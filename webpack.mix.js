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



// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');
// mix.sass(angularPath+'css/sass/')

// mix.webpackConfig({
//     resolve: {
//         modules: [
//             path.resolve(__dirname, angularPath+'assets/js')
//         ]
//     }
// });


mix.combine([
    'resources/assets/css/vendor.css',
    'resources/assets/css/styles.css',
    'resources/assets/css/main.css'
], 'public/css/app.css');

mix.js('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/modules/login.js', 'public/js');
   