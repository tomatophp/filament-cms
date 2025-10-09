<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Columns;

use Filament\Tables;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Column;

class IsPublished extends Column
{
    public static function make(): Tables\Columns\Column
    {
        return Tables\Columns\ToggleColumn::make('is_published')
            ->toggleable()
            ->sortable()
            ->label(trans('filament-cms::messages.content.posts.sections.status.columns.is_published'))
            ->onColor('success');
    }
}
