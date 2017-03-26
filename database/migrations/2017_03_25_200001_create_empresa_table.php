<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaTable extends Migration{
    public function up(){
        Schema::create('empresa', function (Blueprint $table) {
            $table->increments('idEmpresa');
            $table->string('nombre', 100);
            $table->string('propietario', 100);
            $table->string('actividad_economica', 100);
            $table->string('numero_registro', 100);
            $table->string('direccion', 100);
            $table->float('iva', 8, 2);
            $table->string('telefono', 100);
            $table->integer('idMoneda', false, true);
            $table->foreign('idMoneda')->references('idMoneda')->on('moneda');

            $table->string('correo_principal', 100);
            $table->string('logo', 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(){
        Schema::dropIfExists('empresa');
    }
}
