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

Route::get('/registro', function () {
    $roles = Rol::all();
    return view('templates/registro', compact('roles'));
});

Route::resource('/Empresa', 'EmpresaController');

Route::post('/registroUsuario', function (Request $input) {
    $usuario = new Usuario;
    $usuario->nombres = $input::get('nombres');
    $usuario->apellido_paterno = $input::get('apellido_paterno');
    $usuario->apellido_materno = $input::get('apellido_materno');
    $usuario->nombre_usuario = $input::get('correo');
    $usuario->contra_usuario = $input::get('contra_usuario');
    $usuario->idRol = $input::get('rol');
    $usuario->save();
    $roles = Rol::all();
    return view('templates/registro', compact('roles'));
});
