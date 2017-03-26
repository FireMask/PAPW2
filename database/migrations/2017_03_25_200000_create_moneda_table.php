<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonedaTable extends Migration{
    public function up(){
        Schema::create('moneda', function (Blueprint $table) {
            $table->increments('idMoneda');
            $table->string('nombre', 50);
            $table->string('simbolo', 10);
            $table->tinyInteger('presicion');
            $table->string('separador_millares', 10);
            $table->string('separador_decimales', 10);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(){
        Schema::dropIfExists('moneda');
    }
}
