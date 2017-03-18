<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model
{
  use SoftDeletes;
  protected $table = "usuario";

  protected $primaryKey = "idUsuario";

  protected $fillable = [
      "nombres",
      "apellido_paterno",
      "apellido_materno",
      "correo_usuario",
      "contra_usuario",
      "idRol",
      "activo"
  ];

  function rol() {
      return $this->hasOne('App\Models\Rol', 'idRol', 'idRol');
  }

  protected $dates = [
      'created_at',
      'updated_at',
      'deleted_at'
  ];
}
