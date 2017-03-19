<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $table = "cliente";

    protected $primaryKey = "idCliente";

    protected $fillable = [
        'nombre',
        'nombre_comercial',
        'giro',
        'direccion',
        'codigo_postal',
        'pais',
        'estado',
        'municipio',
        'correo',
        'telefono_empresa',
        'telefono_personal'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
