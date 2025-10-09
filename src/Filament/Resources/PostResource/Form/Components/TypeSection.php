<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\Components;

use Filament\Forms;
use Filament\Schemas\Components\Section;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\Component;
use TomatoPHP\FilamentCms\Services\FilamentCMSTypes;

class TypeSection extends Component
{
    public static function make(): \Filament\Schemas\Components\Component
    {
        return Section::make(trans('filament-cms::messages.content.posts.sections.type.title'))
            ->columns(1)
            ->schema([
                Forms\Components\ToggleButtons::make('type')
                    ->label(trans('filament-cms::messages.content.posts.sections.type.columns.type'))
                    ->live()
                    ->options(FilamentCMSTypes::getOptions()->pluck('label', 'key')->toArray())
                    ->icons(FilamentCMSTypes::getOptions()->pluck('icon', 'key')->toArray())
                    ->colors(FilamentCMSTypes::getOptions()->pluck('color', 'key')->toArray())
                    ->default('post')
                    ->inline()
                    ->columnSpanFull()
                    ->hiddenLabel()
                    ->required(),
            ])
            ->columnSpanFull();
    }
}
