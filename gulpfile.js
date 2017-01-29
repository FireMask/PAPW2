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

 elixir((mix) => {
   mix.styles([
     'resources/assets/css/test1.css',
     'resources/assets/css/test2.css'
   ], 'public/css/style.css'
    ).
   webpack([
     'resources/assets/js/main.js'
   ], 'public/js/main.js'
  );
 });
