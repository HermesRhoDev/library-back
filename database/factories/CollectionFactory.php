<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollectionFactory extends Factory
{
   public function definition(): array
   {
      return [
         'user_id' => User::factory(),// 'a2a7c466-91d8-4e59-b638-6830b646dda9',
         'name' => fake()->title(),
      ];
   }
}