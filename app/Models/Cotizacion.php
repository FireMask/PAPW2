<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cotizacion extends Model
{
    use SoftDeletes;

    protected $table = "cotizacion";

    protected $primaryKey = "idCotizacion";

    protected $fillable = [
        'idUsuario',
        'idCliente',
        'idMoneda',
        'validez',
        'pago',
        'total',
        'aprovada',
        'finalizada'
    ];

    function moneda() {
        return $this->hasOne('App\Models\TipoDeMoneda', 'idMoneda', 'idMoneda');
    }

    function usuario() {
        return $this->hasOne('App\Models\Usuario', 'idUsuario', 'idUsuario');
    }

    function cliente() {
        return $this->hasOne('App\Models\Cliente', 'idCliente', 'idCliente');
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
