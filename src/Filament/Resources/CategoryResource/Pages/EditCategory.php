<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use TomatoPHP\FilamentCms\Facades\FilamentCMS;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource;

class EditCategory extends EditRecord
{

    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return FilamentCMS::getCategoryActions(self::class);
    }
}
