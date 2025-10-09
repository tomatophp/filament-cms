<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\Entries;

use Filament\Infolists\Components\TextEntry;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\Entry;

class TitleEntry extends Entry
{
    public static function make(): \Filament\Infolists\Components\Entry
    {
        return TextEntry::make('title')
            ->hiddenLabel();
    }
}
