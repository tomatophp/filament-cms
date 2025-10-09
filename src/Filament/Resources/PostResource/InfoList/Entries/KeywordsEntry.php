<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\Entries;

use Filament\Infolists\Components\TextEntry;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\Entry;

class KeywordsEntry extends Entry
{
    public static function make(): \Filament\Infolists\Components\Entry
    {
        return TextEntry::make('keywords')
            ->label(trans('filament-cms::messages.content.posts.sections.seo.columns.keywords'));
    }
}
