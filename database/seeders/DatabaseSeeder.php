<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Article::factory(20)->create();
        \App\Models\Comment::factory(40)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\React::factory(15)->create();

        \App\Models\User::factory()->create([
            "name" => "Alice",
            "email" => "alice@gmail.com",
        ]);
        \App\Models\User::factory()->create([
            "name" => "Bob",
            "email" => "bob@gmail.com",
        ]);
        \App\Models\User::factory()->create([
            "name" => "John",
            "email" => "john@gmail.com",
        ]);
    }
}
