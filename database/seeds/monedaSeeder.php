<?php

use Illuminate\Database\Seeder;

class monedaSeeder extends Seeder{
    public function run(){
        factory(App\Models\TipoDeMoneda::class, 5)->create();
        DB::table('empresa')->insert([
            'nombre' => 'LiraReyes',
            'propietario' => 'Andres y David',
            'actividad_economica' => 'Software Developer',
            'numero_registro' => '123123',
            'direccion' => 'cerca de la uni',
            'iva' => 17,
            'telefono' => '01-800-HOTLINE',
            'idMoneda' => 1,
            'correo_principal' => 'andres.lira20@gmail.com',
            'logo' => 'd66bad441f0080b0795b89e9b46dd3981398747a.png',
            'created_at' => "2017-04-10 02:56:05"
        ]);
    }
}
