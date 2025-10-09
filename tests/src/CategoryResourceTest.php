<?php

namespace TomatoPHP\FilamentCms\Tests;

use Filament\Facades\Filament;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Pages;
use TomatoPHP\FilamentCms\FilamentCMSPlugin;
use TomatoPHP\FilamentCms\Models\Category;
use TomatoPHP\FilamentCms\Tests\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

beforeEach(function () {
    actingAs(User::factory()->create());

    $this->panel = Filament::getCurrentOrDefaultPanel();
    $this->panel->plugin(
        FilamentCMSPlugin::make()
    );
});

it('can render category resource', function () {
    $this->get(CategoryResource::getUrl('index'))->assertSuccessful();
});

it('can list categories', function () {
    Category::query()->delete();
    $categories = Category::factory()->count(10)->create();

    livewire(Pages\ListCategories::class)
        ->loadTable()
        ->assertCanSeeTableRecords($categories)
        ->assertCountTableRecords(10);
});

it('can render category name/for column in table', function () {
    Category::factory()->count(10)->create();

    livewire(Pages\ListCategories::class)
        ->loadTable()
        ->assertCanRenderTableColumn('name')
        ->assertCanRenderTableColumn('for');
});

it('can render category list page', function () {
    livewire(Pages\ListCategories::class)->assertSuccessful();
});

it('can render category create page', function () {
    get(CategoryResource::getUrl('create'))->assertSuccessful();
});

it('can create new category', function () {
    $newData = Category::factory()->forPost()->asCategory()->make();

    livewire(Pages\CreateCategory::class)
        ->fillForm([
            'name' => ['en' => $newData->name],
            'slug' => $newData->slug,
            'for' => 'post',
            'type' => 'category',
            'is_active' => true,
            'show_in_menu' => true,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    assertDatabaseHas(Category::class, [
        'slug' => $newData->slug,
        'for' => 'post',
        'type' => 'category',
    ]);
});

it('can validate category input', function () {
    livewire(Pages\CreateCategory::class)
        ->fillForm([
            'name' => null,
            'slug' => null,
        ])
        ->call('create')
        ->assertHasFormErrors([
            'name' => 'required',
            'slug' => 'required',
        ]);
});

it('can render category edit page', function () {
    get(CategoryResource::getUrl('edit', [
        'record' => Category::factory()->create(),
    ]))->assertSuccessful();
});

it('can retrieve category data', function () {
    $category = Category::factory()->create();

    livewire(Pages\EditCategory::class, [
        'record' => $category->getRouteKey(),
    ])
        ->assertFormSet([
            'slug' => $category->slug,
            'for' => $category->for,
            'type' => $category->type,
        ]);
});

it('can validate edit category input', function () {
    $category = Category::factory()->create();

    livewire(Pages\EditCategory::class, [
        'record' => $category->getRouteKey(),
    ])
        ->fillForm([
            'name' => null,
            'slug' => null,
        ])
        ->call('save')
        ->assertHasFormErrors([
            'name' => 'required',
            'slug' => 'required',
        ]);
});

it('can save category data', function () {
    $category = Category::factory()->forPost()->asCategory()->create();
    $newData = Category::factory()->forPost()->asCategory()->make();

    livewire(Pages\EditCategory::class, [
        'record' => $category->getRouteKey(),
    ])
        ->fillForm([
            'name' => ['en' => $newData->name],
            'slug' => $newData->slug,
            'for' => 'post',
            'type' => 'category',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($category->refresh())
        ->slug->toBe($newData->slug)
        ->for->toBe('post')
        ->type->toBe('category');
});

it('can create category with parent', function () {
    $parent = Category::factory()->forPost()->asCategory()->create();
    $newData = Category::factory()->forPost()->asCategory()->make();

    livewire(Pages\CreateCategory::class)
        ->fillForm([
            'name' => ['en' => $newData->name],
            'slug' => $newData->slug,
            'for' => 'post',
            'type' => 'category',
            'parent_id' => $parent->id,
            'is_active' => true,
            'show_in_menu' => true,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $category = Category::where('slug', $newData->slug)->first();
    expect($category->parent_id)->toBe($parent->id);
    expect($category->parent)->not->toBeNull();
});

it('can delete category', function () {
    $category = Category::factory()->create();

    livewire(Pages\ListCategories::class)
        ->loadTable()
        ->callTableAction('delete', $category->id);

    expect(Category::withTrashed()->find($category->id)->trashed())->toBeTrue();
});

it('can soft delete category', function () {
    $category = Category::factory()->create();

    $category->delete();

    expect($category->trashed())->toBeTrue();
    expect(Category::withTrashed()->find($category->id))->not->toBeNull();
});

it('can create tag category for posts', function () {
    $newData = Category::factory()->forPost()->asTag()->make();

    livewire(Pages\CreateCategory::class)
        ->fillForm([
            'name' => ['en' => $newData->name],
            'slug' => $newData->slug,
            'is_active' => true,
            'show_in_menu' => false,
        ])
        ->fillForm([
            'for' => 'post',
        ])
        ->fillForm([
            'type' => 'tags',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    assertDatabaseHas(Category::class, [
        'slug' => $newData->slug,
        'for' => 'post',
        'type' => 'tags',
    ]);
});

it('can filter categories by type', function () {
    Category::factory()->asCategory()->count(5)->create();
    Category::factory()->asTag()->count(3)->create();

    livewire(Pages\ListCategories::class)
        ->loadTable()
        ->assertCountTableRecords(8);
});
