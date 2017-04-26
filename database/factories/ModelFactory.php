<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('es_ES');
    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = sha1('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Usuario::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('es_ES');
    static $password;
    return [
        'nombres' => $faker->name,
        'apellido_paterno' => $faker->lastName,
        'apellido_materno' => $faker->lastName,
        'correo_usuario' => $faker->unique()->safeEmail,
        'contra_usuario' => $password ?: $password = sha1('pass'),
        'idRol' => $faker->numberBetween(2, 3),
        'imagen_perfil' => 'd66bad441f0080b0795b89e9b46dd3981398747a.png',
        'fecha_nacimiento' => $faker->date('d-m-Y'),
        'remember_token' => str_random(10)
    ];
});

$factory->define(App\Models\Cliente::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('es_ES');
    return [
        'nombre' => $faker->name,
        'nombre_comercial' => $faker->company,
        'giro' => $faker->jobTitle,
        'direccion' => $faker->address,
        'codigo_postal' => $faker->postcode,
        'pais' => $faker->country,
        'estado' => $faker->state,
        'municipio' => $faker->city,
        'correo' => $faker->unique()->safeEmail,
        'telefono_empresa' => $faker->phoneNumber,
        'telefono_personal' => $faker->phoneNumber
    ];
});

$factory->define(App\Models\Cotizacion::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('es_ES');
    return [
        'idUsuario' => $faker->numberBetween(1, 150),
        'idCliente' => $faker->numberBetween(1, 500),
        'idMoneda' => $faker->numberBetween(1, 5),
        'validez' => $faker->randomElement(['5', '10', '15', '30', '60']),
        'pago' => $faker->randomElement(['Credito', 'Contado']),
        'total' => $faker->randomFloat(2, 500, 10000),
        'aprobada' => $faker->numberBetween(0, 1),
        'finalizada' => $faker->numberBetween(0, 1),
        'created_at' => '2017-'.$faker->numberBetween(1, 12).'-'.$faker->numberBetween(1, 25).' 01:01:01',
        'updated_at' => '2017-'.$faker->numberBetween(1, 12).'-'.$faker->numberBetween(1, 25).' 01:01:01'
    ];
});

$factory->define(App\Models\TipoDeMoneda::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('es_ES');
    return [
        'nombre' => $faker->name,
        'simbolo' => $faker->currencyCode,
        'presicion' => $faker->numberBetween(0, 3),
        'separador_millares' => $faker->randomElement([',', '.', ' ']),
        'separador_decimales' => $faker->randomElement([',', '.', ' '])
    ];
});

$factory->define(App\Models\Fabricante::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('es_ES');
    return [
        'nombre' => $faker->company
    ];
});

$factory->define(App\Models\Proveedor::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('es_ES');
    return [
        'nombre' => $faker->company
    ];
});

$factory->define(App\Models\Producto::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('es_ES');
    return [
        'codigo' => $faker->ean13,
        'modelo' => $faker->word . "-" . $faker->randomDigit,
        'descripcion' => $faker->text($maxNbChars = 200),
        'idFabricante' => $faker->numberBetween(1, 50),
        'idProveedor' => $faker->numberBetween(1, 50),
        'precio' => $faker->randomNumber($faker->biasedNumberBetween(2, 6))
    ];
});

$factory->define(App\Models\ProductoCotizacion::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('es_ES');
    return [
        'idCotizacion' => $faker->numberBetween(1, 5000),
        'idProducto' => $faker->numberBetween(1, 1000)
    ];
});

$factory->define(App\Models\UsuarioCliente::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('es_ES');
    return [
        'idUsuario' => $faker->numberBetween(1, 150),
        'idCliente' => $faker->numberBetween(1, 500)
    ];
});
