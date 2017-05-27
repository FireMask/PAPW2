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

    function usuario(){
        return $this->hasOne('App\Models\Usuario', 'idUsuario', 'idUsuario');
    }

    function cliente(){
        return $this->hasOne('App\Models\Cliente', 'idCliente', 'idCliente');
    }

    function clientName(){
        return $this->hasOne('App\Models\Cliente', 'idCliente', 'idCliente')->select('idCliente', 'nombre');
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
