<?php

use Illuminate\Database\Seeder;

class cotizacionSeeder extends Seeder{
    public function run(){
        factory(App\Models\Cotizacion::class, 5000)->create();
    }
}
