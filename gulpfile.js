const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

 elixir(function(mix){
   mix.styles([
     'resources/assets/css/test1.css',
     'resources/assets/css/landing.css'
   ], 'public/css/style.css').
   copy('node_modules/admin-lte/dist', 'public/js/dist/AdminLTE').
   copy('node_modules/bootstrap/dist', 'public/js/dist/Bootstrap').
   copy('node_modules/font-awesome/css', 'public/js/dist/Font-Awesome/css').
   copy('node_modules/font-awesome/fonts', 'public/js/dist/Font-Awesome/fonts').
   copy('node_modules/ionicons/dist/css', 'public/js/dist/Ionicons/css').
   copy('node_modules/jquery/dist', 'public/js/dist/jQuery/dist').
   copy('node_modules/datatables.net-bs', 'public/js/dist/DataTables').
   copy('node_modules/bootstrap-checkbox/dist', 'public/js/dist/Bootstrap-Checkbox').
   webpack([
       'resources/assets/js/main.js'
   ], 'public/js/dist/main.js');
 });
