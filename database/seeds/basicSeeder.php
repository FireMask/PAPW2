<?php

use Illuminate\Database\Seeder;

class basicSeeder extends Seeder{
    public function run(){
        DB::table('rol')->insert([
            ['nombre' => 'Administrador'],
            ['nombre' => 'Ventas'],
            ['nombre' => 'Producción']
        ]);

        DB::table('usuario')->insert([
            'nombres' => 'Andres',
            'apellido_paterno' => 'Lira',
            'apellido_materno' => 'Gastelum',
            'correo_usuario' => 'andres.lira20@gmail.com',
            'contra_usuario' => sha1('password'),
            'idRol' => 1,
            'imagen_perfil' => 'd66bad441f0080b0795b89e9b46dd3981398747a.png',
            'fecha_nacimiento' => '16-09-2005',
            'remember_token' => 'fS9Cg7orXx'
        ]);
    }
}
