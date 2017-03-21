<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $table = "usuario";

    protected $primaryKey = "idUsuario";

    protected $hidden = ['contra_usuario'];

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
