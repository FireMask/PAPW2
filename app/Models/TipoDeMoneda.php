<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoDeMoneda extends Model
{
    use SoftDeletes;

    protected $table = "TipoDeMoneda";

    protected $primaryKey = "idMoneda";

    protected $fillable = [
        //Agregar campos modificables
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
