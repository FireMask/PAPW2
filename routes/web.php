<?php
use App\Models\Rol;
use App\Models\Usuario;


Route::get('/', function () {
    return view('landing');
});
Route::resource('login', 'LoginController');

Route::get('/registro', 'UsuarioController@registrar');
Route::get('/usuarios', [
    'as'=> 'users' ,
    'uses' => 'UsuarioController@index'
]);
Route::post('/registroUsuario', 'UsuarioController@store');
Route::post('/usuario/{id}', 'UsuarioController@destroy');

Route::resource('/empresa', 'EmpresaController');
