const mix = require("laravel-mix");

const webpackOpts = require('./webpack.config.js');

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
mix.webpackConfig(webpackOpts);

mix
  .setResourceRoot("")
  .js("resources/js/app.js", "public/js")
  .vue()
  .sass(
    "resources/sass/app.scss",
    "public/css"
  );
