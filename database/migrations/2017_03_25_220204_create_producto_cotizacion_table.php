<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoCotizacionTable extends Migration{
    public function up(){
        Schema::create('producto_cotizacion', function (Blueprint $table) {
            $table->integer('idCotizacion', false, true);
            $table->foreign('idCotizacion')->references('idCotizacion')->on('cotizacion');

            $table->integer('idProducto', false, true);
            $table->foreign('idProducto')->references('idProducto')->on('producto');

            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(){
        Schema::dropIfExists('producto_cotizacion');
    }
}
