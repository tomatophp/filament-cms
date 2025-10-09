<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\Sections;

use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Section;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\Entries;

class StatusSection
{
    public static function make(): Component
    {
        return Section::make(trans('filament-cms::messages.content.posts.sections.status.title'))
            ->columns(1)
            ->description(trans('filament-cms::messages.content.posts.sections.status.description'))
            ->schema([
                Entries\AuthorEntry::make(),
                Entries\TypeEntry::make(),
            ])
            ->columnSpan(2);
    }
}
