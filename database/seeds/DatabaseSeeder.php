<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
    public function run(){
        $this->call(basicSeeder::class);

        $this->call(usuarioSeeder::class);
        $this->call(clienteSeeder::class);
        $this->call(monedaSeeder::class);
        $this->call(cotizacionSeeder::class);
        $this->call(fabricanteSeeder::class);
        $this->call(proveedorSeeder::class);
        $this->call(productoSeeder::class);

        $this->call( prod_cotizacion::class);
        $this->call( user_cliente::class);
    }
}
