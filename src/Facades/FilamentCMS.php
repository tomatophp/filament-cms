<?php

namespace TomatoPHP\FilamentCms\Facades;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Illuminate\Support\Facades\Facade;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Pages\ListCategories;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Pages\ListPosts;
use TomatoPHP\FilamentCms\Services\FilamentCMSAuthors;
use TomatoPHP\FilamentCms\Services\FilamentCMSThemes;
use TomatoPHP\FilamentCms\Services\FilamentCMSTypes;

/**
 * @method FilamentCMSAuthors authors()
 * @method FilamentCMSTypes types()
 * @method void registerPostAction(array | Action | ActionGroup $action, string $page = ListPosts::class)
 * @method void registerCategoryAction(array | Action $action, string $page = ListCategories::class)
 * @method array getPostActions(string $page = ListPosts::class)
 * @method array getCategoryActions(string $page = ListCategories::class)
 * @method void registerPostRelation(string $relation)
 * @method void registerCategoryRelation(string $relation)
 * @method array getPostRelations()
 * @method array getCategoryRelations()
 * @method void registerImportAction(array | Action | ActionGroup $action)
 * @method array getImportActions()
 */
class FilamentCMS extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'filament-cms';
    }
}
