<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioClienteTable extends Migration{
    public function up(){
        Schema::create('usuario_cliente', function (Blueprint $table) {
            $table->integer('idUsuario', false, true);
            $table->foreign('idUsuario')->references('idUsuario')->on('usuario');

            $table->integer('idCliente', false, true);
            $table->foreign('idCliente')->references('idCliente')->on('cliente');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(){
        Schema::dropIfExists('usuario_cliente');
    }
}
