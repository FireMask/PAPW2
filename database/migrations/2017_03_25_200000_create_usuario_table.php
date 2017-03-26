<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioTable extends Migration{
    public function up(){
        Schema::create('usuario', function (Blueprint $table) {
            $table->increments('idUsuario');
            $table->string('nombres', 100);
            $table->string('apellido_paterno', 100);
            $table->string('apellido_materno', 100)->nullable();
            $table->string('correo_usuario', 100)->unique();
            $table->string('contra_usuario', 100);
            $table->integer('idRol', false, true);
            $table->foreign('idRol')->references('idRol')->on('rol');

            $table->string('imagen_perfil', 50);
            $table->string('fecha_nacimiento', 10);
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(){
        Schema::dropIfExists('usuario');
    }
}
