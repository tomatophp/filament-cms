<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Form\Components;

use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Form\Component;

class SidebarMeta extends Component
{
    public static function make(): \Filament\Schemas\Components\Component
    {
        return StatusSection::make()
            ->columnSpan([
                'sm' => 1,
                'md' => 2,
                'lg' => 4,
            ]);
    }
}
