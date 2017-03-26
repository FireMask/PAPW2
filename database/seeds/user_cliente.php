<?php

use Illuminate\Database\Seeder;

class user_cliente extends Seeder{
    public function run(){
        factory(App\Models\UsuarioCliente::class, 5000)->create();
    }
}
