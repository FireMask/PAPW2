<?php

use Illuminate\Database\Seeder;

class user_cliente extends Seeder{
    public function run(){
        factory(App\Models\UsuarioCliente::class, 500)->create();
    }
}
