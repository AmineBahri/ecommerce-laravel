<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => "amine bahri",
        'email' => "bahrimohamedamin7@gmail.com",
        'email_verified_at' => now(),
        'password' => Hash::make("admin"), // password
        'remember_token' => Str::random(10),
    ];
});
