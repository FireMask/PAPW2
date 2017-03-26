<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoTable extends Migration{
    public function up(){
        Schema::create('producto', function (Blueprint $table) {
            $table->increments('idProducto');
            $table->string('codigo', 20)->unique();
            $table->string('modelo', 100);
            $table->string('descripcion', 350);
            $table->integer('idFabricante', false, true);
            $table->foreign('idFabricante')->references('idFabricante')->on('fabricante');

            $table->integer('idProveedor', false, true);
            $table->foreign('idProveedor')->references('idProveedor')->on('proveedor');

            $table->decimal('precio', 12, 3);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(){
        Schema::dropIfExists('producto');
    }
}
