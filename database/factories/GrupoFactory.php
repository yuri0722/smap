<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User\Grupo;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Grupo::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
    ];
});
