<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsuarioCliente extends Model
{
    use SoftDeletes;

    protected $table = "usuario_cliente";

    //protected $primaryKey = "idUsuario";

    protected $fillable = [
        //Agregar campos modificables
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
