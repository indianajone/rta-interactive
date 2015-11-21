var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

require('./laravel-elixir-karma');

elixir(function(mix) {
    mix.sass('app.scss')
       .sass('cms.scss')
       .browserify('app.js')
       .copy('node_modules/font-awesome/fonts', 'public/fonts');
});
