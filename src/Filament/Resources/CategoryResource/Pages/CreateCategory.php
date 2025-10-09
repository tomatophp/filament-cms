<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use TomatoPHP\FilamentCms\Facades\FilamentCMS;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return FilamentCMS::getCategoryActions(self::class);
    }
}
