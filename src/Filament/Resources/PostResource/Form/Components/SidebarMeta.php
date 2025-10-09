<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\Components;

use Filament\Schemas\Components\Grid;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\Component;

class SidebarMeta extends Component
{
    public static function make(): \Filament\Schemas\Components\Component
    {
        return Grid::make()
            ->columns(1)
            ->schema([
                StatusSection::make(),
                ImagesSection::make(),
                AuthorSection::make(),
                MetaDataSection::make(),
            ])
            ->columnSpan([
                'sm' => 1,
                'md' => 2,
                'lg' => 4,
            ]);
    }
}
