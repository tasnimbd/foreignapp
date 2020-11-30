const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');


mix.styles([
    'public/frontend/css/bootstrap.css',
    'public/frontend/css/bootstrap.min.css',
    'public/frontend/css/bootstrap.min.css',
    'public/frontend/css/main.css',
    'public/frontend/css/main.min.css',
    'public/frontend/fonts/elegant-font/style.css',
    'public/frontend/fonts/font-awesome/css/font-awesome.min.css',
], 'public/frontend/css/all.css');
