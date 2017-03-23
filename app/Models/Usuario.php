<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

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
        "imagen_perfil",
        "fecha_nacimiento",
        "idRol"
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
