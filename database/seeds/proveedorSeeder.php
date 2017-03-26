<?php

use Illuminate\Database\Seeder;

class proveedorSeeder extends Seeder{
    public function run(){
        factory(App\Models\Proveedor::class, 50)->create();
    }
}
