let mix = require('laravel-mix');

mix.options({
    processCssUrls: false,
    uglify: {
        parallel: true
    }
});

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

mix.js('resources/src/js/app.js', 'public/js')
    .sass('resources/src/sass/app.scss', 'public/css');
mix.copy('node_modules/font-awesome/fonts', 'public/fonts');

if (mix.inProduction()) {
    mix.version();
}