<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrecioProducto extends Model
{
    use SoftDeletes;

    protected $table = "Precio_Producto";

    protected $primaryKey = "idProducto";

    protected $fillable = [
        'precio'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
