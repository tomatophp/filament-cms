<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Form\Components;

use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Form\Component;
use TomatoPHP\FilamentCms\Models\Category;
use TomatoPHP\FilamentCms\Services\FilamentCMSTypes;

class StatusSection extends Component
{
    public static function make(): \Filament\Schemas\Components\Component
    {
        return Section::make(trans('filament-cms::messages.content.category.sections.status.title'))
            ->description(trans('filament-cms::messages.content.category.sections.status.description'))
            ->schema([
                Forms\Components\Select::make('for')
                    ->label(trans('filament-cms::messages.content.category.sections.status.columns.for'))
                    ->searchable()
                    ->live()
                    ->options(fn () => FilamentCMSTypes::getOptions()->pluck('label', 'key')->toArray())
                    ->default('post'),
                Forms\Components\Select::make('type')
                    ->hidden(function (Get $get) {
                        $for = FilamentCMSTypes::getOptions()->where('key', $get('for'))->first();
                        if ($for && count($for->sub)) {
                            return false;
                        }

                        return true;
                    })
                    ->label(trans('filament-cms::messages.content.category.sections.status.columns.type'))
                    ->searchable()
                    ->options(fn (Get $get) => FilamentCMSTypes::getOptions()->where('key', $get('for'))->first()?->getSub()->pluck('label', 'key')->toArray())
                    ->default('category'),
                Forms\Components\Select::make('parent_id')
                    ->label(trans('filament-cms::messages.content.category.sections.status.columns.parent_id'))
                    ->searchable()
                    ->options(fn () => Category::query()->pluck('name', 'id')->toArray()),
                Forms\Components\Toggle::make('is_active')
                    ->label(trans('filament-cms::messages.content.category.sections.status.columns.is_active')),
                Forms\Components\Toggle::make('show_in_menu')
                    ->label(trans('filament-cms::messages.content.category.sections.status.columns.show_in_menu')),
            ]);
    }
}
