<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\Components;

use Filament\Forms;
use Filament\Schemas\Components\Section;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\Component;

class MetaSection extends Component
{
    public static function make(): \Filament\Schemas\Components\Component
    {
        return Section::make(trans('filament-cms::messages.content.posts.sections.seo.title'))
            ->description(trans('filament-cms::messages.content.posts.sections.seo.description'))
            ->schema([
                Forms\Components\TextInput::make('short_description')
                    ->label(trans('filament-cms::messages.content.posts.sections.seo.columns.short_description')),
                Forms\Components\Textarea::make('keywords')
                    ->autosize()
                    ->label(trans('filament-cms::messages.content.posts.sections.seo.columns.keywords')),
            ]);
    }
}
