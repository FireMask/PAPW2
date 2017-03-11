<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cotizacion extends Model
{
    use SoftDeletes;

    protected $table = "Cotizacion";

    protected $primaryKey = "idCotizacion";

    protected $fillable = [
        'idUsuario',
        'idCliente',
        'idMoneda',
        'validez',
        'pago',
        'total',
        'nota',
        'aprovada'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
