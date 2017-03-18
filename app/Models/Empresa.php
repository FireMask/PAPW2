<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;

    protected $table = "empresa";

    protected $primaryKey = "idEmpresa";

    protected $fillable = [
      "nombre",
      "propietario",
      "acividad_economica",
      "numero_registro",
      "direccion",
      "iva",
      "telefono",
      "idMoneda",
      "correoPrincipal",
      "logo"
    ];

    function moneda() {
        return $this->hasOne('App\Models\TipoDeMoneda', 'idMoneda', 'idMoneda');
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
