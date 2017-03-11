<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;

    protected $table = "Empresa";

    protected $primaryKey = "idEmpresa";

    protected $fillable = [
      "nombre",
      "propietario",
      "acividad_economica",
      "numero_registro",
      "direccion",
      "iva",
      "telefono",
      "moneda_defecto",
      "correo_principal",
      "logo"
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
