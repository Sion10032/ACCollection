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

mix.js('resources/js/homepage/app.js', 'public/js')
  .js('resources/js/cmreader/cmreader.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css');

mix.webpackConfig({
  module: {
    rules: [
      {
        test: /\.css$/,
        loaders: [
          'style-loader',
          'css-loader',
          {
            loader: 'px2rem-loader',
            options: {
              remUnit: 16
            }
          }
        ]
      }
    ]
  }
});
