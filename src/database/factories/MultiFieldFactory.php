<?php

namespace Database\Factories;

use App\Models\MultiField;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MultiField>
 */
class MultiFieldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "path" => $this->faker->image('public/storage/MultiField/test_field',640,480, null, true),
            'post_id' => Post::factory(),
        ];
    }
}
