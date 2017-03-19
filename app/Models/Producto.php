<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;

    protected $table = "producto";

    protected $primaryKey = "idProducto";

    protected $fillable = [
        'codigo',
        'modelo',
        'descripcion',
        'idFabricante',
        'idProveedor',
        'precio'
    ];

    function fabricante(){
        return $this->hasOne('App\Models\Fabricante', 'idFabricante', 'idFabricante');
    }

    function proveedor(){
        return $this->hasOne('App\Models\Proveedor', 'idProveedor', 'idProveedor');
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
