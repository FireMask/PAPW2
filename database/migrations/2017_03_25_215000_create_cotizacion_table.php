<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizacionTable extends Migration{
    public function up(){
        Schema::create('cotizacion', function (Blueprint $table) {
            $table->increments('idCotizacion');
            $table->integer('idUsuario', false, true);
            $table->foreign('idUsuario')->references('idUsuario')->on('usuario');

            $table->integer('idCliente', false, true);
            $table->foreign('idCliente')->references('idCliente')->on('cliente');

            $table->integer('idMoneda', false, true);
            $table->foreign('idMoneda')->references('idMoneda')->on('moneda');

            $table->enum('validez', ['5', '10', '15', '30', '60']);
            $table->enum('pago', ['Contado', 'Credito']);
            $table->float('total');
            $table->boolean('aprobada');
            $table->boolean('finalizada');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(){
        Schema::dropIfExists('cotizacion');
    }
}
