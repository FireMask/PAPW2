<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObservacionClienteTable extends Migration{
    public function up(){
        Schema::create('observacion_cliente', function (Blueprint $table) {
            $table->integer('idCliente', false, true);
            $table->foreign('idCliente')->references('idCliente')->on('cliente');

            $table->integer('idUsuario', false, true);
            $table->foreign('idUsuario')->references('idUsuario')->on('usuario');

            $table->string('descripcion', 250);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(){
        Schema::dropIfExists('observacion_cliente');
    }
}
