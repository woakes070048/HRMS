const { mix } = require('laravel-mix');


mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');


mix.js('resources/assets/js/hrms/salaryInfo.js', 'public/js')
<<<<<<< HEAD
	.js('resources/assets/js/hrms/hrms.js', 'public/js')
	.js('resources/assets/js/hrms/unit.js', 'public/js')
    .js('resources/assets/js/hrms/employee.js', 'public/js');
=======
    // .js('resources/assets/js/hrms/employee.js', 'public/js')
	.js('resources/assets/js/hrms/hrms.js', 'public/js');
>>>>>>> d9b4edfc01e57d591747a3e976d4d14be7a1e888


mix.combine([
    'resources/assets/css/auth/css.css',
    'resources/assets/css/auth/icons.css',
    'resources/assets/css/auth/main.css',
    'resources/assets/css/auth/voyager.css',
], 'public/css/auth.css');

mix.combine([
    // 'resources/assets/css/bootstrap.min.css',
    'resources/assets/css/hrms/theme.css',
], 'public/css/hrms.css');


