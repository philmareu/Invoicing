<?php

use Faker\Generator as Faker;
use Invoicing\Models\InvoiceSetting;
use Invoicing\User;

$factory->define(InvoiceSetting::class, function (Faker $faker) {
    return [
        'logo' => 'logo.jpg',
        'company' => $faker->company,
        'email' => $faker->safeEmail,
        'address_1' => $faker->streetAddress,
        'address_2' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'zip' => (string) $faker->numberBetween(10000, 90000),
        'phone' => $faker->phoneNumber,
        'note' => $faker->paragraph,
        'user_id' => factory(User::class)->create()->id
    ];
});
