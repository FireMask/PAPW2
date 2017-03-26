<?php

use Illuminate\Database\Seeder;

class clienteSeeder extends Seeder{
    public function run(){
        factory(App\Models\Cliente::class, 500)->create();
    }
}
