<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\Entries;

use Filament\Infolists\Components\TextEntry;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\Entry;
use TomatoPHP\FilamentCms\Models\Post;
use TomatoPHP\FilamentCms\Services\FilamentCMSTypes;

class TypeEntry extends Entry
{
    public static function make(): \Filament\Infolists\Components\Entry
    {
        return TextEntry::make('type')
            ->label(trans('filament-cms::messages.content.posts.sections.status.columns.type'))
            ->state(function (Post $post) {
                return FilamentCMSTypes::getOptions()->where('key', $post->type)->first()?->label;
            })
            ->color(function (Post $post) {
                return FilamentCMSTypes::getOptions()->where('key', $post->type)->first()?->color;
            })
            ->icon(function (Post $post) {
                return FilamentCMSTypes::getOptions()->where('key', $post->type)->first()?->icon;
            })
            ->badge();
    }
}
