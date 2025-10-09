<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Columns;

use Filament\Tables;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Column;
use TomatoPHP\FilamentCms\Models\Post;
use TomatoPHP\FilamentCms\Services\FilamentCMSTypes;

class Type extends Column
{
    public static function make(): Tables\Columns\Column
    {
        return Tables\Columns\TextColumn::make('type')
            ->sortable()
            ->label(trans('filament-cms::messages.content.posts.sections.status.columns.type'))
            ->toggleable()
            ->state(function (Post $post) {
                return FilamentCMSTypes::getOptions()->where('key', $post->type)->first()?->label;
            })
            ->color(function (Post $post) {
                return FilamentCMSTypes::getOptions()->where('key', $post->type)->first()?->color;
            })
            ->icon(function (Post $post) {
                return FilamentCMSTypes::getOptions()->where('key', $post->type)->first()?->icon;
            })
            ->badge()
            ->searchable();
    }
}
