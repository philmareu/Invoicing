<?php

use Faker\Generator as Faker;

$factory->define(Invoicing\Models\Client::class, function (Faker $faker) {
    return [
        'title' => $faker->company,
        'address_1' => $faker->streetAddress,
        'address_2' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'zip' => (string) $faker->numberBetween(10000, 90000),
        'phone' => $faker->phoneNumber,
        'email' => $faker->email
    ];
});
