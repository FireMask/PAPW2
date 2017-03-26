<?php

use Illuminate\Database\Seeder;

class monedaSeeder extends Seeder{
    public function run(){
        factory(App\Models\TipoDeMoneda::class, 5)->create();
    }
}
