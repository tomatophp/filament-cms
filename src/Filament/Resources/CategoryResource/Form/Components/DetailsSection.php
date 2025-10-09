<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Form\Components;

use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Form\Component;
use TomatoPHP\FilamentIcons\Components\IconPicker;
use TomatoPHP\FilamentTranslationComponent\Components\Translation;

class DetailsSection extends Component
{
    public static function make(): \Filament\Schemas\Components\Component
    {
        return Section::make(trans('filament-cms::messages.content.category.sections.details.title'))
            ->description(trans('filament-cms::messages.content.category.sections.details.description'))
            ->schema([
                Translation::make('name')
                    ->afterStateUpdated(fn (Get $get, Set $set) => $set('slug', Str::of($get('name')['en'] ?? '')->replace(' ', '-')->lower()->toString()))
                    ->label(trans('filament-cms::messages.content.category.sections.details.columns.name'))
                    ->lazy()
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->unique()
                    ->label(trans('filament-cms::messages.content.category.sections.details.columns.slug'))
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),
                Translation::make('description')
                    ->textarea()
                    ->columnSpanFull()
                    ->label(trans('filament-cms::messages.content.category.sections.details.columns.description')),
                IconPicker::make('icon')
                    ->label(trans('filament-cms::messages.content.category.sections.details.columns.icon')),
                Forms\Components\ColorPicker::make('color')
                    ->label(trans('filament-cms::messages.content.category.sections.details.columns.color')),
            ])
            ->columns(2);
    }
}
