<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Columns;

use Filament\Tables;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Column;

class Likes extends Column
{
    public static function make(): Tables\Columns\Column
    {
        return Tables\Columns\TextColumn::make('likes')
            ->toggleable()
            ->label(trans('filament-cms::messages.content.posts.sections.status.columns.likes'))
            ->badge()
            ->color('danger')
            ->icon('heroicon-s-heart')
            ->numeric()
            ->sortable();
    }
}
