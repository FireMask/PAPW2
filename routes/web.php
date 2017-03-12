<?php
use App\Models\Rol;
use App\Models\Usuario;


Route::get('/', function () {
    return view('landing');
});
Route::resource('login', 'LoginController');

Route::get('/registro', 'UsuarioController@create');
Route::get('/usuarios', 'UsuarioController@index');
Route::post('/registroUsuario', 'UsuarioController@store');
Route::post('/editarUsuario', 'UsuarioController@update');
Route::post('/usuario/{id}', 'UsuarioController@destroy');
Route::post('/usuario/{id}/edit', 'UsuarioController@edit');

Route::resource('/empresa', 'EmpresaController');
