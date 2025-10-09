<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Columns;

use Filament\Tables;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Column;
use TomatoPHP\FilamentCms\Models\Post;

class PublishedAt extends Column
{
    public static function make(): Tables\Columns\Column
    {
        return Tables\Columns\TextColumn::make('published_at')
            ->toggleable()
            ->label(trans('filament-cms::messages.content.posts.sections.status.columns.published_at'))
            ->description(fn (Post $post) => $post->published_at?->diffForHumans())
            ->dateTime()
            ->sortable();
    }
}
