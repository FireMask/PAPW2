<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = "Usuario";

    protected $primaryKey = "idUsuario";

    protected $fillable = [
        "nombres",
        "apellido_paterno",
        "apellido_materno",
        "nombre_usuario",
        "contra_usuario",
        "idRol",
        "activo"
    ];

    public function rol() {
        return $this->belongsTo('app\Models\Rol', 'idRol');
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
