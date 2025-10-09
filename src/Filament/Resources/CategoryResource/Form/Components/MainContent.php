<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Form\Components;

use Filament\Schemas\Components\Grid;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Form\Component;

class MainContent extends Component
{
    public static function make(): \Filament\Schemas\Components\Component
    {
        return Grid::make()
            ->columns(1)
            ->schema([
                DetailsSection::make(),
                ImagesSection::make(),
            ])
            ->columnSpan([
                'sm' => 1,
                'md' => 4,
                'lg' => 8,
            ]);
    }
}
