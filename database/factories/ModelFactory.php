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

/** @var \LaravelDoctrine\ORM\Testing\Factory $factory */
$factory->define(App\Entity\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'info' => $faker->realText(20),
        'password' => $faker->password()
    ];
});
