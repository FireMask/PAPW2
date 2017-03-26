<?php

use Illuminate\Database\Seeder;

class prod_cotizacion extends Seeder{
    public function run(){
        factory(App\Models\ProductoCotizacion::class, 5000)->create();
    }
}
