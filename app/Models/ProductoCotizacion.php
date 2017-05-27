<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductoCotizacion extends Model
{
    use SoftDeletes;

    protected $table = "producto_cotizacion";

    protected $primaryKey = "idUsuario";

    protected $fillable = [
        'idCotizacion',
        'idProducto'
    ];

    function producto(){
        return $this->hasOne('App\Models\Producto', 'idProducto', 'idProducto');
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
