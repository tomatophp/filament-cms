<?php

namespace TomatoPHP\FilamentCms\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use TomatoPHP\FilamentCms\Models\Post;
use TomatoPHP\FilamentCms\Tests\Models\User;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'author_id' => User::factory(),
            'author_type' => User::class,
            'type' => $this->faker->randomElement(['post', 'page', 'portfolio']),
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->unique()->slug(),
            'short_description' => $this->faker->sentence(),
            'keywords' => implode(', ', $this->faker->words(5)),
            'body' => $this->faker->paragraphs(3, true),
            'is_published' => $this->faker->boolean(80),
            'is_trend' => $this->faker->boolean(20),
            'published_at' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),
            'likes' => $this->faker->numberBetween(0, 1000),
            'views' => $this->faker->numberBetween(0, 10000),
            'meta' => [],
            'meta_url' => null,
            'meta_redirect' => null,
        ];
    }

    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => true,
            'published_at' => now(),
        ]);
    }

    public function unpublished(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => false,
            'published_at' => null,
        ]);
    }

    public function trending(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_trend' => true,
        ]);
    }

    public function asPost(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'post',
        ]);
    }

    public function asPage(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'page',
        ]);
    }
}
