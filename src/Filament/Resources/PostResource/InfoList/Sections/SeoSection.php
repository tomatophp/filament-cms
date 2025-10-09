<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\Sections;

use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Section;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\Entries;

class SeoSection
{
    public static function make(): Component
    {
        return Section::make(trans('filament-cms::messages.content.posts.sections.seo.title'))
            ->columns(1)
            ->description(trans('filament-cms::messages.content.posts.sections.seo.description'))
            ->schema([
                Entries\ShortDescriptionEntry::make(),
                Entries\KeywordsEntry::make(),
            ])
            ->columnSpan(2);
    }
}
