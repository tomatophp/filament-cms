<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Columns;

use Filament\Tables;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Column;

class Color extends Column
{
    public static function make(): Tables\Columns\Column
    {
        return Tables\Columns\ColorColumn::make('color')
            ->label(trans('filament-cms::messages.content.category.sections.details.columns.color'))
            ->sortable()
            ->searchable();
    }
}
