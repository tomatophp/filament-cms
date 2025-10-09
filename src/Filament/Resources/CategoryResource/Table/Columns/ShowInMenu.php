<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Columns;

use Filament\Tables;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Column;

class ShowInMenu extends Column
{
    public static function make(): Tables\Columns\Column
    {
        return Tables\Columns\ToggleColumn::make('show_in_menu')
            ->sortable()
            ->label(trans('filament-cms::messages.content.category.sections.status.columns.show_in_menu'));
    }
}
