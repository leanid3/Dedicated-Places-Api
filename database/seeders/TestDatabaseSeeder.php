<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
