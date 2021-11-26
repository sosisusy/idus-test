<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    $products = ["선풍기", "세탁기", "에어컨", "TV"];

    return [
        "user_id" => 1,
        "order_number" => strtoupper(Str::random(12)),
        "product_name" => $products[rand(0, 3)],
        "payment_dt" => $faker->dateTime(),
    ];
});
