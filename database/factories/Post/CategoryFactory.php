<?php

namespace Database\Factories\Post;

use App\Models\Post\Category;
use Illuminate\Database\Eloquent\Factories\Factory;


class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "category_parent_id" => null,
            "name" => $this->faker->words(3, true),
            "description" => $this->faker->sentence,
            "SEO_title" => $this->faker->sentence(5),
            "SEO_description" => $this->faker->paragraph,
            "SEO_keywords" => implode($this->faker->words(5))
        ];
    }
    
}
