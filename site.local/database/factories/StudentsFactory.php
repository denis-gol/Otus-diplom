<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entity\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker, $item) {

    $user = factory(App\User::class)->create();

    return [
        'user_id' => $user->id,
        'first_name' => $user->name,
        'last_name' => $faker->lastName,
        'email' => $user->email,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
