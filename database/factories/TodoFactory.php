<?php

use Faker\Generator as Faker;

$factory->define(
    App\Todo::class, 
    function (Faker $faker) {
        return [
            'user_id' => rand(1, 2),
            'title' => $faker->sentence(4, true),
            'description' => $faker->paragraph(4, true),
            'due_at' => $faker->dateTimeBetween('now', '+3 months'),
            // 'priority' => $faker->randomElement(['low', 'medium', 'high']),
            'priority_id' => rand(1, 3),
            'category_id' => rand(1, 3),
            'completed_at' => rand(0, 1) 
                ? $faker->dateTimeBetween('-3 weeks', 'now') 
                : null
        ];
    }
);
