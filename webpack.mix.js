const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/home.js', 'public/js')
    .js('resources/js/timesheet/add-timesheet.js', 'public/js/timesheet')
    .js('resources/js/timesheet/add-timesheet-edit.js', 'public/js/timesheet')
    .sass('resources/sass/main.scss', 'public/css')
    .sass('resources/sass/timesheet/add-timesheet.scss', 'public/css/timesheet')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]);

if (mix.inProduction()) {
    mix.version();
}

