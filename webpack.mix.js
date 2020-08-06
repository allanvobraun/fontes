const mix = require("laravel-mix");
const path = require('path');

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

mix.options({
    hmrOptions: {
        host: 'localhost',  // site's host name
        port: 8181,
    }
});

mix.webpackConfig({
    resolve: {
        alias: {
            'images': path.resolve(__dirname, "resources/assets/images/"),
            'charts': path.resolve(__dirname, "resources/js/charts")
        }
    },
    devServer: { 
        proxy: {
            '*' : '127.0.0.1:8000'
        },
        watchOptions:{
            aggregateTimeout:200,
            poll:5000
        },

    }
});

mix.js("resources/js/app.js", "public/js").sass(
    "resources/sass/app.scss",
    "public/css"
);
