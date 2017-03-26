<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObservacionCotizacionTable extends Migration{
    public function up(){
        Schema::create('observacion_cotizacion', function (Blueprint $table) {
            $table->integer('idCotizacion', false, true);
            $table->foreign('idCotizacion')->references('idCotizacion')->on('cotizacion');

            $table->integer('idUsuario', false, true);
            $table->foreign('idUsuario')->references('idUsuario')->on('usuario');

            $table->string('descripcion', 250);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(){
        Schema::dropIfExists('observacion_cotizacion');
    }
}
