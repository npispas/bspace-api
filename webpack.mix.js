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

mix.js('resources/js/dashboard.js', 'public/js')
    .copy('resources/css', 'public/css')
    .copy('resources/fonts', 'public/fonts')
    .copy('resources/images', 'public/images')
    .copy('resources/lib', 'public/lib')
    .sourceMaps();
