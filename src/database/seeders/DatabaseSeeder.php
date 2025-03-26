<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
        $posts = Post::factory()->count(2)->withAuthor($author)->create();
        $posts->each(function (Post $post) {
            $post->comments()->saveMany(Comment::factory()->count(3)->make());
//        Comment::factory()->count(30)->postExist($post)->userExist($author)->create();
        });

        $tags = Tag::factory()->count(15)->create();
        Post::all()->each(function($post) use ($tags){
            $post->tags()->attach($tags->random(rand(1,3))->pluck('tag_id')->toArray());
        });
    }
}
