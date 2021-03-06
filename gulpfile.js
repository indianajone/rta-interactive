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

elixir(function(mix) {
    
    mix.sass('app.scss')
        .sass('cms.scss')
        .styles([
            'flickity.css',
            'sweetalert.css',
            'lity.css',
            'summernote.css'
        ], 'public/css/vendor.css')
        .copy('node_modules/font-awesome/fonts', 'public/fonts')
        .copy('node_modules/slick-carousel/slick/fonts', 'public/fonts')
        .copy('node_modules/slick-carousel/slick/ajax-loader.gif', 'public/images')
        .copy([
            'node_modules/photoswipe/dist/default-skin/default-skin.svg',
            'node_modules/photoswipe/dist/default-skin/default-skin.png',
            'node_modules/photoswipe/dist/default-skin/preloader.gif'
        ], 'public/css')
        .browserify('app.js')
        .copy([
            'node_modules/jquery/dist/jquery.min.js',
            'node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js',
        ], 'resources/assets/js/vendor')
        .scripts([
            'vendor/jquery.min.js',
            'vendor/bootstrap.min.js',
            'vendor/jasny-fileupload.js',
            'vendor/dropzone.js',
            'vendor/sweetalert-dev.js',
            'vendor/select2.js',
            'vendor/jquery.panorama-viewer.js',
            'vendor/lity.js',
            'vendor/summernote.js',
        ], 'public/js/vendor.js');
});
