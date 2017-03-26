<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolTable extends Migration{
    public function up(){
        Schema::create('rol', function (Blueprint $table) {
            $table->increments('idRol');
            $table->string('nombre', 50);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(){
        Schema::dropIfExists('rol');
    }
}
