<?php

use Illuminate\Database\Seeder;

class usuarioSeeder extends Seeder{
    public function run(){
        factory(App\Models\Usuario::class, 151)->create();
    }
}
