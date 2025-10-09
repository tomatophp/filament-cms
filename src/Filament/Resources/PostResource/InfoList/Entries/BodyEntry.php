<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\Entries;

use TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\Entry;
use TomatoPHP\FilamentCms\Infolists\Components\MarkdownEntry;

class BodyEntry extends Entry
{
    public static function make(): \Filament\Infolists\Components\Entry
    {
        return MarkdownEntry::make('body')
            ->markdown()
            ->hiddenLabel();
    }
}
