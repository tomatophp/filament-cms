<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Columns;

use Filament\Tables;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Column;

class IsTrend extends Column
{
    public static function make(): Tables\Columns\Column
    {
        return Tables\Columns\ToggleColumn::make('is_trend')
            ->toggleable()
            ->sortable()
            ->label(trans('filament-cms::messages.content.posts.sections.status.columns.is_trend'))
            ->onColor('success');
    }
}
