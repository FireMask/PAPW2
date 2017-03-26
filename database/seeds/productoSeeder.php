<?php

use Illuminate\Database\Seeder;

class productoSeeder extends Seeder{
    public function run(){
        factory(App\Models\Producto::class, 1000)->create();
    }
}
