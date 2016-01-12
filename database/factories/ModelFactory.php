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

    $name = $faker->name;

    return [
        'name' => str_slug($name),
        'title' => $name,
        'description' => $faker->paragraph,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'street' => $faker->streetAddress,
        'subdistrict' => $faker->city,
        'district' => $faker->city,
        'province' => $faker->state,
        'postcode' => $faker->postcode
    ];
});

$factory->define(Ravarin\Entities\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence
    ];
});

$factory->define(Ravarin\Entities\Photo::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'place_id' => factory(Ravarin\Entities\Photo::class)->create()->id,
        'thumbnail_path' => $faker->image('/tmp', 800, 600),
        'path' => $faker->image('/tmp', 1024, 768)
    ];
});

$factory->define(Ravarin\Entities\Post::class, function (Faker\Generator $faker) {
    return [
        'author_id' => factory(Ravarin\Entities\User::class)->create()->getKey(),
        'name' => $faker->word,
        'type' => 'post',
        'title' => $faker->sentence,
        'body' => $faker->paragraph
    ];
});

$factory->define(Ravarin\Entities\Page::class, function (Faker\Generator $faker) {
    return [
        'author_id' => factory(Ravarin\Entities\User::class)->create()->getKey(),
        'name' => $faker->word,
        'type' => 'page',
        'title' => $faker->sentence,
        'body' => $faker->paragraph
    ];
});

$factory->define(Ravarin\Entities\Attachment::class, function (Faker\Generator $faker) {
    
    $post = factory(Ravarin\Entities\Post::class)->create();
    
    return [
        'attachable_id' => $post->getKey(),
        'attachable_type' => get_class($post),
        'name' => $faker->word,
        'title' => $faker->sentence,
        'extension' => 'jpg',
        'path' => $faker->image('/tmp', 150, 150),
        'width' => 150,
        'height' => 150,
        'type' => 'image'
    ];
});
