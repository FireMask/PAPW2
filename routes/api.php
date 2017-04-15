<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
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

Route::get('/monedas', 'apiController@getMonedas');

Route::get('/productos', 'apiController@getProductos');

Route::get('/proveedores', 'apiController@getProveedores');

Route::get('/empresa', 'apiController@getEmpresa');
