<?php

namespace TomatoPHP\FilamentCms\Tests;

use Filament\Facades\Filament;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Pages;
use TomatoPHP\FilamentCms\FilamentCMSPlugin;
use TomatoPHP\FilamentCms\Models\Category;
use TomatoPHP\FilamentCms\Models\Post;
use TomatoPHP\FilamentCms\Tests\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

beforeEach(function () {
    $app = $this->app;

    actingAs(User::factory()->create());

    $this->panel = Filament::getCurrentOrDefaultPanel();
    $this->panel->plugin(
        FilamentCMSPlugin::make()
    );
});

it('can render post resource', function () {
    $this->get(PostResource::getUrl('index'))->assertSuccessful();
});

it('can list posts', function () {
    Post::query()->delete();
    $posts = Post::factory()->count(10)->create();

    livewire(Pages\ListPosts::class)
        ->loadTable()
        ->assertCanSeeTableRecords($posts)
        ->assertCountTableRecords(10);
});

it('can render post title/type column in table', function () {
    Post::factory()->count(10)->create();

    livewire(Pages\ListPosts::class)
        ->loadTable()
        ->assertCanRenderTableColumn('title')
        ->assertCanRenderTableColumn('type');
});

it('can render post list page', function () {
    livewire(Pages\ListPosts::class)->assertSuccessful();
});

it('can render view post page', function () {
    get(PostResource::getUrl('view', [
        'record' => Post::factory()->create(),
    ]))->assertSuccessful();
});

it('can render post create page', function () {
    get(PostResource::getUrl('create'))->assertSuccessful();
});

it('can create new post', function () {
    $user = User::factory()->create();
    $newData = Post::factory()->asPost()->make();

    livewire(Pages\CreatePost::class)
        ->fillForm([
            'type' => 'post',
            'title' => $newData->title,
            'slug' => $newData->slug,
            'body' => $newData->body,
            'short_description' => $newData->short_description,
            'keywords' => $newData->keywords,
            'is_published' => true,
            'is_trend' => false,
            'published_at' => now()->format('Y-m-d H:i:s'),
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    assertDatabaseHas(Post::class, [
        'title' => json_encode([
            'en' => $newData->title,
            'ar' => $newData->title,
        ]),
        'slug' => $newData->slug,
        'type' => 'post',
    ]);
});

it('can validate post input', function () {
    livewire(Pages\CreatePost::class)
        ->fillForm([
            'title' => null,
            'slug' => null,
            'type' => null,
        ])
        ->call('create')
        ->assertHasFormErrors([
            'title' => 'required',
            'slug' => 'required',
            'type' => 'required',
        ]);
});

it('can render post edit page', function () {
    get(PostResource::getUrl('edit', [
        'record' => Post::factory()->create(),
    ]))->assertSuccessful();
});

it('can retrieve post data', function () {
    $post = Post::factory()->create();

    livewire(Pages\EditPost::class, [
        'record' => $post->getRouteKey(),
    ])
        ->assertFormSet([
            'title' => $post->title,
            'slug' => $post->slug,
            'type' => $post->type,
        ]);
});

it('can validate edit post input', function () {
    $post = Post::factory()->create();

    livewire(Pages\EditPost::class, [
        'record' => $post->getRouteKey(),
    ])
        ->fillForm([
            'title' => null,
            'slug' => null,
        ])
        ->call('save')
        ->assertHasFormErrors([
            'title' => 'required',
            'slug' => 'required',
        ]);
});

it('can verify post and category relationship', function () {
    $categories = Category::factory()->forPost()->asCategory()->count(3)->create();
    $user = User::factory()->create();
    $post = Post::factory()->asPost()->create([
        'author_id' => $user->id,
        'author_type' => User::class,
    ]);

    $post->categories()->attach($categories->pluck('id'));

    expect($post->refresh()->categories)->toHaveCount(3);
});

it('can verify post published status', function () {
    $published = Post::factory()->published()->create();
    $unpublished = Post::factory()->unpublished()->create();

    expect($published->is_published)->toBeTrue();
    expect($unpublished->is_published)->toBeFalse();
});

it('can verify post trend status', function () {
    $trending = Post::factory()->trending()->create();
    $normal = Post::factory()->create(['is_trend' => false]);

    expect($trending->is_trend)->toBeTrue();
    expect($normal->is_trend)->toBeFalse();
});

it('can filter posts by type', function () {
    Post::factory()->asPost()->count(5)->create();
    Post::factory()->asPage()->count(3)->create();

    livewire(Pages\ListPosts::class)
        ->loadTable()
        ->assertCountTableRecords(8);
});

it('can delete post', function () {
    $post = Post::factory()->create();

    livewire(Pages\ListPosts::class)
        ->loadTable()
        ->callTableAction('delete', $post->id);

    expect(Post::withTrashed()->find($post->id)->trashed())->toBeTrue();
});

it('can soft delete post', function () {
    $post = Post::factory()->create();

    $post->delete();

    expect($post->trashed())->toBeTrue();
    expect(Post::withTrashed()->find($post->id))->not->toBeNull();
});
