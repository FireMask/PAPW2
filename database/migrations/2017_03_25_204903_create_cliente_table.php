<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteTable extends Migration
{
    public function up(){
        Schema::create('cliente', function (Blueprint $table){
            $table->increments('idCliente');
            $table->string('nombre', 200);
            $table->string('nombre_comercial', 200);
            $table->string('giro', 200);
            $table->string('direccion', 200);
            $table->string('codigo_postal', 10);
            $table->string('pais', 200);
            $table->string('estado', 200);
            $table->string('municipio', 200);
            $table->string('correo', 200);
            $table->string('telefono_empresa', 200);
            $table->string('telefono_personal', 200);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(){
        Schema::dropIfExists('cliente');
    }
}
