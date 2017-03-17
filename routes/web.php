<?php
use App\Models\Rol;
use App\Models\Usuario;


Route::get('/', function () {
    return Redirect::to('login');
});

Route::resource('login', 'LoginController');
Route::resource('usuario', 'UsuarioController');
Route::resource('rol', 'RolController');
Route::resource('moneda', 'TipoDeMonedaController');

Route::resource('/empresa', 'EmpresaController');
