const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .copy("resources/css/profile.css", "public/css")
    .copy(
        ["resources/js/sb-admin-2.min.js", "resources/js/profile.js"],
        "public/js"
    )
    .copy(
        "node_modules/@fortawesome/fontawesome-free/webfonts",
        "public/webfonts"
    )
    .copyDirectory("resources/vendor/**", "public/vendor");
