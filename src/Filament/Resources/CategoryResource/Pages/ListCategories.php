<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Pages;

use Filament\Resources\Pages\ListRecords;
use TomatoPHP\FilamentCms\Facades\FilamentCMS;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return FilamentCMS::getCategoryActions(self::class);
    }
}
