const { mix } = require('laravel-mix');


mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.combine([
    'resources/assets/css/auth/css.css',
    'resources/assets/css/auth/icons.css',
    'resources/assets/css/auth/main.css',
    'resources/assets/css/auth/voyager.css',
], 'public/css/auth.css');

mix.combine([
    'resources/assets/css/hrms/theme.css',
], 'public/css/hrms.css');

// mix.js([
//     'resources/assets/js/hrms/jquery-1.11.1.min.js',
//     'resources/assets/js/hrms/jquery-ui.min.js',
// ],'public/js/hrms.js');
