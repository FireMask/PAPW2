<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = "Rol";

    protected $primaryKey = "idRol";

    protected $fillable = [
        "nombre"
    ];

    public function usuarios() {
        return $this->belongsTo('app\Models\Usuario', 'idRol');
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
