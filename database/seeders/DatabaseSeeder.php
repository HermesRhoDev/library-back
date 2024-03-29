<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Collection;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()
            ->has(
                Collection::factory()
                ->has(Book::factory()->count(5))
                ->count(3)
                )
            ->create();
    }
}
