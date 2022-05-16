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

mix.js(['resources/js/main.js', 'resources/js/app.js'], 'public/js/app.js').version();

mix.js('resources/js/liff.js', 'public/js/liff.js').version();

mix.js('resources/js/line.js', 'public/js/line.js').version();

mix.js('resources/js/customer.js', 'public/js/customer.js').version();

mix.js('resources/js/profile.js', 'public/js/profile.js').version();

mix.js('resources/js/resize.js', 'public/js/resize.js').version();

mix.js('resources/js/pay.js', 'public/js/pay.js').version();
