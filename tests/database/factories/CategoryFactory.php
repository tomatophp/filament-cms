<?php

namespace TomatoPHP\FilamentCms\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use TomatoPHP\FilamentCms\Models\Category;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'parent_id' => null,
            'for' => $this->faker->randomElement(['post', 'page', 'portfolio']),
            'type' => $this->faker->randomElement(['category', 'tag']),
            'name' => $this->faker->words(2, true),
            'slug' => $this->faker->unique()->slug(),
            'description' => $this->faker->optional()->sentence(),
            'icon' => $this->faker->optional()->randomElement(['heroicon-o-folder', 'heroicon-o-tag']),
            'color' => $this->faker->optional()->hexColor(),
            'is_active' => true,
            'show_in_menu' => $this->faker->boolean(70),
        ];
    }

    public function asCategory(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'category',
        ]);
    }

    public function asTag(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'tag',
        ]);
    }

    public function forPost(): static
    {
        return $this->state(fn (array $attributes) => [
            'for' => 'post',
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    public function withParent(Category $parent): static
    {
        return $this->state(fn (array $attributes) => [
            'parent_id' => $parent->id,
        ]);
    }
}
