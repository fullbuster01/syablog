<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->sentence;
    $slug = Str::slug($title);
    return [
        'user_id' => rand(1,3),
        'category_id' => rand(1,6),
        'title' => $title,
        'slug' => $slug,
        'content' => $faker->paragraph(100, false),
    ];
});
