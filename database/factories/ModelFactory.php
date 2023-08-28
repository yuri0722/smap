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


$factory->define(App\Models\Comum\Estado::class, function ($faker) {
    return [
        'nome' => $faker->name,
        'sigla' => $faker->name,
    ];
});

$factory->define(App\Models\Comum\Cidade::class, function ($faker) {
    return [
        'estado_id' => $faker->name,
        'nome' => $faker->name,
        'sistema' => $faker->name,
    ];
});




$factory->define(\App\Models\Animal\PorteAnimal::class, function ($faker) {
    return [
        'nome' =>$faker->name,
    ];
});


$factory->define(\App\Models\Animal\EspecieAnimal::class, function ($faker) {
    return [
        'nome' => $faker->name,
    ];
});

$factory->define(\App\Models\Veiculo\VeiculoTipo::class, function ($faker) {
    return [
        'nome' => $faker->name,
    ];
});
