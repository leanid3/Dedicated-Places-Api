<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "parent_id" => null,
            "title" => $this->faker->name(),
            "comment" => $this->faker->text(),
            "status" => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            "post_id" => Post::factory(),
            "user_id" => User::factory()
        ];
    }

    public function postExist(Post $post): Factory
    {
        return $this->state(fn() => [
            'post_id' => $post->post_id
        ]
        );
    }

    public function userExist(User $user): Factory
    {
       return $this->state(fn()=> [
           'author_id' => $user->id
       ]);

    }
}
