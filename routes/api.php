<?php

use App\Models\Usuario;
use Illuminate\Http\Request;

Route::get('/user', function (request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/usuarios', 'apiController@getUsers');
Route::get('/usuarios/total', 'apiController@getPaginationData');
Route::get('/usuarios/{id}/clientes', 'apiController@getUserClients');
Route::get('/usuarios/{id}/estadisticas', 'apiController@getUserStadistics');
Route::get('/usuarios/{id}/ventas', 'apiController@getUserSells');
Route::get('/usuarios/{id}/cotizaciones', 'apiController@getUserCotizations');

Route::get('/roles', 'apiController@getRoles');

Route::get('/clientes', 'apiController@getClients');

Route::get('/cotizaciones', 'apiController@getCotizaciones');

Route::get('/fabricantes', 'apiController@getFabricantes');

Route::get('/fabricantes_productos', 'apiController@getFabProd');

Route::get('/monedas', 'apiController@getMonedas');

Route::get('/productos', 'apiController@getProductos');

Route::get('/proveedores', 'apiController@getProveedores');

Route::get('/empresa', 'apiController@getEmpresa');

Route::get('/inicio', 'apiController@estadisticasEmpresa');
