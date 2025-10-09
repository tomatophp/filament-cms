<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Columns;

use Filament\Tables;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Column;

class IsActive extends Column
{
    public static function make(): Tables\Columns\Column
    {
        return Tables\Columns\ToggleColumn::make('is_active')
            ->sortable()
            ->label(trans('filament-cms::messages.content.category.sections.status.columns.is_active'));
    }
}
