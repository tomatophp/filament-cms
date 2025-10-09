<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Columns;

use Filament\Tables;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Column;

class ParentCategory extends Column
{
    public static function make(): Tables\Columns\Column
    {
        return Tables\Columns\TextColumn::make('parent.name')
            ->sortable()
            ->label(trans('filament-cms::messages.content.category.sections.status.columns.parent_id'));
    }
}
