<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Columns;

use Filament\Tables;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Column;

class DeletedAt extends Column
{
    public static function make(): Tables\Columns\Column
    {
        return Tables\Columns\TextColumn::make('deleted_at')
            ->dateTime()
            ->sortable()
            ->toggleable(isToggledHiddenByDefault: true);
    }
}
