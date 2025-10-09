<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Columns;

use Filament\Tables;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Column;

class Views extends Column
{
    public static function make(): Tables\Columns\Column
    {
        return Tables\Columns\TextColumn::make('views')
            ->toggleable()
            ->label(trans('filament-cms::messages.content.posts.sections.status.columns.views'))
            ->color('info')
            ->icon('heroicon-s-arrow-trending-up')
            ->badge()
            ->numeric()
            ->sortable();
    }
}
