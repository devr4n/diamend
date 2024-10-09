const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .js('resources/js/admin-scripts.js', 'public/js')
    .styles([
        'node_modules/select2/dist/css/select2.min.css'
    ], 'public/css/vendor.css');
