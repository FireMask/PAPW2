<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFabricanteTable extends Migration{
    public function up(){
        Schema::create('fabricante', function (Blueprint $table) {
            $table->increments('idFabricante');
            $table->string('nombre', 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(){
        Schema::dropIfExists('fabricante');
    }
}
