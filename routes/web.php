<?php

Route::get('/', function () {
    return Redirect::to('login');
});

Route::get('index', function () {
    return view('index');
});

Route::resource('login', 'LoginController');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('usuario', 'UsuarioController');
    Route::resource('rol', 'RolController');
    Route::resource('moneda', 'TipoDeMonedaController');
    Route::resource('proveedor', 'ProveedorController');
    Route::resource('fabricante', 'FabricanteController');
    Route::resource('empresa', 'EmpresaController');
    Route::resource('producto', 'ProductoController');
    Route::resource('cliente', 'ClienteController');
    Route::resource('cotizacion', 'CotizacionController');
    Route::get('logout', 'LoginController@logout');
});