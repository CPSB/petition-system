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
$factory->define(ActivismeBE\Categories::class, function (Faker\Generator $faker) {
    return [
        'module' => $faker->word,
        'name' => $faker->name,
        'description' => $faker->text,
    ];
});

$factory->define(ActivismeBE\Comments::class, function (Faker\Generator $faker) {
    return [
        'author_id' => function () {
             return factory(ActivismeBE\User::class)->create()->id;
        },
        'comment' => $faker->text,
    ];
});

$factory->define(ActivismeBE\Contact::class, function (Faker\Generator $faker) {
    return [
        'read_by' => $faker->randomNumber(),
        'is_read' => $faker->word,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
        'subject' => $faker->word,
        'message' => $faker->text,
    ];
});

$factory->define(ActivismeBE\Countries::class, function (Faker\Generator $faker) {
    return [
        'short_name' => $faker->word,
        'long_name' => $faker->word,
    ];
});

$factory->define(ActivismeBE\Helpdesk::class, function (Faker\Generator $faker) {
    return [
        'category_id' => function () {
             return factory(ActivismeBE\Categories::class)->create()->id;
        },
        'author_id' => function () {
             return factory(ActivismeBE\User::class)->create()->id;
        },
        'open' => $faker->word,
        'publish' => $faker->word,
        'title' => $faker->word,
        'description' => $faker->text,
    ];
});

$factory->define(ActivismeBE\Permission::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'guard_name' => $faker->word,
    ];
});

$factory->define(ActivismeBE\Petitions::class, function (Faker\Generator $faker) {
    return [
        'author_id' => function () {
             return factory(ActivismeBE\User::class)->create()->id;
        },
        'image_path' => $faker->text,
        'title' => $faker->word,
        'total_signatures' => $faker->word,
        'text' => $faker->text,
    ];
});

$factory->define(ActivismeBE\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'guard_name' => $faker->word,
    ];
});

$factory->define(ActivismeBE\Signatures::class, function (Faker\Generator $faker) {
    return [
        'publish' => $faker->word,
        'country_id' => function () {
             return factory(ActivismeBE\Countries::class)->create()->id;
        },
        'postal_code' => $faker->randomNumber(),
        'city' => $faker->city,
        'name' => $faker->name,
        'email' => $faker->safeEmail,
    ];
});

$factory->define(ActivismeBE\User::class, function (Faker\Generator $faker) {
    return [
        'country_id' => $faker->randomNumber(),
        'twitter_id' => $faker->randomNumber(),
        'facebook_id' => $faker->randomNumber(),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'postal_code' => $faker->word,
        'city' => $faker->city,
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt($faker->password),
        'remember_token' => str_random(10),
        'banned_at' => $faker->dateTimeBetween(),
    ];
});

