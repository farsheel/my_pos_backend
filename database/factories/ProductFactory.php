<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product_name' => $faker->text(20),
        'product_upc' => $faker->text(15),
        'product_cat_id' => $faker->numberBetween(1,2),
        'product_price' => $faker->numberBetween(10,500),
        'product_description' => $faker->text(100),
    ];
});
