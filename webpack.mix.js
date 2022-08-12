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
    .js('resources/js/timesheet/project.js', 'public/js/timesheet')
    .js('resources/js/client/main.js', 'public/js/client')
    .sass('resources/sass/main.scss', 'public/css')
    .sass('resources/sass/timesheet/add-timesheet.scss', 'public/css/timesheet')
    .sass('resources/sass/project/project.scss', 'public/css/project')
    .sass('resources/sass/client/main.scss', 'public/css/client')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]);

if (mix.inProduction()) {
    mix.version();
}

