<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
   public function definition(): array
   {
      return [
         'id' => Str::random(),
         'title' => fake()->title(),
         'pages_count' => fake()->randomDigitNotZero(),
         'cover_link' => fake()->unique()->safeEmail(),
         'summary' => fake()->text(),
         'authors' => fake()->name(),
         'categories' => 'default',
      ];
   }
}
