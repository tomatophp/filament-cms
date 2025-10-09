<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\Sections;

use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Section;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\Entries;

class PostSection
{
    public static function make(): Component
    {
        return Section::make(trans('filament-cms::messages.content.posts.sections.post.title'))
            ->description(trans('filament-cms::messages.content.posts.sections.post.description'))
            ->schema([
                Entries\TitleEntry::make(),
                Entries\FeatureImageEntry::make(),
                Entries\BodyEntry::make(),
            ]);
    }
}
