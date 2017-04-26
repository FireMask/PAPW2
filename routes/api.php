<?php

use App\Models\Usuario;
use Illuminate\Http\Request;

Route::get('/user', function (request $request) {
    return $request->user();
})->middleware('auth:api');