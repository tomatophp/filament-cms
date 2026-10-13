<?php

namespace TomatoPHP\FilamentCms\Facades;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Illuminate\Support\Facades\Facade;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Pages\ListCategories;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Pages\ListPosts;
use TomatoPHP\FilamentCms\Services\FilamentCMSAuthors;
use TomatoPHP\FilamentCms\Services\FilamentCMSTypes;

/**
 * @method static FilamentCMSAuthors authors()
 * @method static FilamentCMSTypes types()
 * @method static void registerPostAction(array | Action | ActionGroup $action, string $page = ListPosts::class)
 * @method static void registerCategoryAction(array | Action $action, string $page = ListCategories::class)
 * @method static array getPostActions(string $page = ListPosts::class)
 * @method static array getCategoryActions(string $page = ListCategories::class)
 * @method static void registerPostRelation(string $relation)
 * @method static void registerCategoryRelation(string $relation)
 * @method static array getPostRelations()
 * @method static array getCategoryRelations()
 * @method static void registerImportAction(array | Action | ActionGroup $action)
 * @method static array getImportActions()
 */
class FilamentCMS extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'filament-cms';
    }
}
