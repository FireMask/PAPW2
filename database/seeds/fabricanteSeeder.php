<?php

use Illuminate\Database\Seeder;

class fabricanteSeeder extends Seeder{
    public function run(){
        factory(App\Models\Fabricante::class, 50)->create();
    }
}
