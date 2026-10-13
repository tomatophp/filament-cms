<?php

use TomatoPHP\FilamentCms\Database\Factories\CategoryFactory;
use TomatoPHP\FilamentCms\Database\Factories\PostFactory;
use TomatoPHP\FilamentCms\Models\Category;
use TomatoPHP\FilamentCms\Models\Post;
use TomatoPHP\FilamentCms\Tests\Models\User;

// Real apps do not autoload the package tests, so the model factories must ship in the package.
it('resolves the model factories shipped with the package', function () {
    expect(Post::factory())->toBeInstanceOf(PostFactory::class)
        ->and(Category::factory())->toBeInstanceOf(CategoryFactory::class);
});

it('creates a post without an author and with a given author', function () {
    $author = User::factory()->create();

    expect(Post::factory()->create()->author)->toBeNull()
        ->and(Post::factory()->author($author)->create()->author->is($author))->toBeTrue();
});

arch('models do not depend on the package tests')
    ->expect('TomatoPHP\FilamentCms\Models')
    ->not->toUse('TomatoPHP\FilamentCms\Tests');
