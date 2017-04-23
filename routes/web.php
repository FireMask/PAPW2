<?php

Route::get('/', function () {
    return Redirect::to('login');
});

Route::get('index', function () {
    return view('index');
});

Route::resource('login', 'LoginController');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/inicio', 'CotizacionController@estadisticasEmpresa');

    Route::resource('usuario', 'UsuarioController');
    Route::get('/usuarios/total', 'UsuarioController@getPaginationData');
    Route::get('/usuario/{id}/clientes', 'UsuarioController@getUserClients');
    Route::get('/usuario/{id}/estadisticas', 'UsuarioController@getUserStadistics');
    Route::get('/usuario/{id}/ventas', 'UsuarioController@getUserSells');
    Route::get('/usuario/{id}/cotizaciones', 'CotizacionController@getCotizacionesFromUser');

    Route::resource('rol', 'RolController');
    Route::resource('moneda', 'TipoDeMonedaController');

    Route::resource('proveedor', 'ProveedorController');
    Route::get('/proveedor/{id}/productos', 'ProductoController@getProductosDeProveedor');

    Route::resource('fabricante', 'FabricanteController');
    Route::get('/fabricante/{id}/productos', 'FabricanteController@getProductosDeFabricante');
    Route::get('/fabricantes_productos', 'FabricanteController@getFabProd');

    Route::resource('empresa', 'EmpresaController');
    Route::resource('producto', 'ProductoController');
    Route::resource('cliente', 'ClienteController');

    Route::resource('cotizacion', 'CotizacionController');
    Route::get('/cotizacion/{id}', 'CotizacionController@getDetalleCotizacion');

    Route::get('logout', 'LoginController@logout');
});