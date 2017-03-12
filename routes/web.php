<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Rol;
use App\Models\Usuario;


Route::get('/', function () {
    return view('templates/landing');
});

Route::get('/registro', 'UsuarioController@registrar');
Route::get('/usuarios', [
  'as'=> 'users' ,
  'uses' => 'UsuarioController@index'
]);
Route::post('/usuario/{id}', 'UsuarioController@destroy');
Route::post('/registroUsuario', 'UsuarioController@store');

Route::resource('/empresa', 'EmpresaController');
