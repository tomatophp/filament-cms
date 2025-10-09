<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\Sections;

use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Grid;

class MainGrid
{
    public static function make(): Component
    {
        return Grid::make([
            'sm' => 1,
            'md' => 2,
            'lg' => 4,
        ])->schema([
            StatusSection::make(),
            SeoSection::make(),
        ]);
    }
}
