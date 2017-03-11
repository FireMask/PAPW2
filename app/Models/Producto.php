<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;

    protected $table = "Producto";

    protected $primaryKey = "idProducto";

    protected $fillable = [
        'codigo',
        'modelo',
        'descripcion',
        'idFabricante',//
        'idProveedor',//
        'precio'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
