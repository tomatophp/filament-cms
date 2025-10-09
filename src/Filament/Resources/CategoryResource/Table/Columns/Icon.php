<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Columns;

use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Column;
use TomatoPHP\FilamentIcons\Components\IconColumn;

class Icon extends Column
{
    public static function make(): \Filament\Tables\Columns\Column
    {
        return IconColumn::make('icon')
            ->label(trans('filament-cms::messages.content.category.sections.details.columns.icon'))
            ->sortable()
            ->searchable();
    }
}
