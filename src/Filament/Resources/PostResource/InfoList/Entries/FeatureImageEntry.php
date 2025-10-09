<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\Entries;

use Filament\Infolists\Components\ImageEntry;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\Entry;

class FeatureImageEntry extends Entry
{
    public static function make(): \Filament\Infolists\Components\Entry
    {
        return ImageEntry::make('feature_image')
            ->hiddenLabel()
            ->default(fn ($record) => $record->getFirstMediaUrl('feature_image'));
    }
}
