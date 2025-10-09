<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\Entries;

use Filament\Infolists\Components\TextEntry;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\Entry;
use TomatoPHP\FilamentCms\Models\Post;

class AuthorEntry extends Entry
{
    public static function make(): \Filament\Infolists\Components\Entry
    {
        return TextEntry::make('author.name')
            ->label(trans('filament-cms::messages.content.posts.sections.author.columns.author'))
            ->default(fn (Post $post) => $post->author?->name);
    }
}
