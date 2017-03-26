<?php

use Illuminate\Database\Seeder;

class obs_cotizacion extends Seeder{
    public function run(){
        factory(App\Models\Usuario::class, 150)->create();
    }
}
