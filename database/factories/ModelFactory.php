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

$factory->define(Ravarin\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Ravarin\Entities\Place::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraphs(3),
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'street' => $faker->streetAddress,
        'subdistrict' => $faker->city,
        'district' => $faker->city,
        'province' => $faker->state,
        'postcode' => $faker->postcode
    ];
});

$factory->define(Ravarin\Entities\Photo::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'place_id' => factory(Ravarin\Entities\Photo::class)->create()->id,
        'thumbnail_path' => $faker->image('/tmp', 800, 600),
        'path' => $faker->image('/tmp', 800, 600)
    ];
});
