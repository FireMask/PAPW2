<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsuarioCliente extends Model
{
    use SoftDeletes;

    protected $table = "usuario_cliente";

    protected $fillable = [
        'idUsuario',
        'idCliente'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
