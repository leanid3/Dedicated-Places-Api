<?php

namespace Database\Seeders;

use App\Models\Post\Category;
use App\Models\Post\Post;
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
//         User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

        Post::factory()->count(10)->create();

        // Создание 5 опубликованных постов
        Post::factory()->published()->count(5)->create();

        // Создание постов с конкретной категорией
        $category = Category::factory()->create(['name' => 'Технологии']);
        Post::factory()->count(3)->withCategory($category)->create();

        // Создание постов с конкретным автором
        $author = User::factory()->create(['name' => 'John Doe']);
        Post::factory()->count(2)->withAuthor($author)->create();
    }
}
