<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(), // Создание категории через фабрику
            'title' => $this->faker->sentence(6),
            'content' => $this->faker->paragraphs(3, true),
            'excerpt' => $this->faker->text(100),
            'slug' => $this->faker->slug,
            'user_id' => User::factory(), // Создание пользователя через фабрику
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
            'type' => $this->faker->randomElement(['article', 'news', 'review']),
            'stock' => $this->faker->numberBetween(0, 100),
            'price' => $this->faker->numberBetween(100, 1000),
            'params' => $this->faker->randomElements(['color' => 'red', 'size' => 'M'], 1),
            'SEO_title' => $this->faker->sentence(6),
            'SEO_description' => $this->faker->paragraph,
            'SEO_keywords' => implode(', ', $this->faker->words(5)),
            'locale' => $this->faker->locale,
            'comment_count' => $this->faker->numberBetween(0, 50),
            'comment_status' => $this->faker->randomElement(['open', 'closed']),
        ];
    }
    /**
     * Установите статус "опубликовано".
     *
     * @return static
     */
    public function published(): static
    {
        return $this->state(fn () => [
            'status' => 'published',
        ]);
    }
    /**
     * Установите статус "черновик".
     *
     * @return static
     */
    public function draft(): static
    {
        return $this->state(fn () => [
            'status' => 'draft',
        ]);
    }

    /**
     * Создайте статью с привязанной категорией.
     *
     * @param Category $category
     * @return static
     */
    public function withCategory(Category $category): static
    {
        return $this->state(fn () => [
            'category_id' => $category->category_id,
        ]);
    }

    /**
     * Создайте статью с указанным автором.
     *
     * @param User $author
     * @return static
     */
    public function withAuthor(User $author): static
    {
        return $this->state(fn () => [
            'user_id' => $author->id,
        ]);
    }
}
