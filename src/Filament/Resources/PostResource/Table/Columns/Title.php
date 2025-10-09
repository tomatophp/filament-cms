<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Columns;

use Filament\Tables;
use Illuminate\Support\Str;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Column;
use TomatoPHP\FilamentCms\Models\Post;

class Title extends Column
{
    public static function make(): Tables\Columns\Column
    {
        return Tables\Columns\TextColumn::make('title')
            ->label(trans('filament-cms::messages.content.posts.sections.post.columns.title'))
            ->description(fn (Post $post) => Str::of($post->short_description)->limit(50))
            ->toggleable()
            ->searchable();
    }
}
