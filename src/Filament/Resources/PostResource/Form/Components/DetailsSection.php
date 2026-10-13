<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\Components;

use Filament\Forms;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\Component;

class DetailsSection extends Component
{
    public static function make(): \Filament\Schemas\Components\Component
    {
        return Grid::make([
            'sm' => 1,
            'md' => 2,
            'lg' => 2,
        ])->schema([
            Forms\Components\TextInput::make('title')
                ->label(trans('filament-cms::messages.content.posts.sections.post.columns.title'))
                ->afterStateUpdated(function (Get $get, Set $set) {
                    if ($get('type') !== 'open-source') {
                        $set('slug', Str::of($get('title'))->replace(' ', '-')->lower()->toString());
                    }
                })
                ->lazy()
                ->required(),
            Forms\Components\TextInput::make('slug')
                ->unique()
                ->label(trans('filament-cms::messages.content.posts.sections.post.columns.slug'))
                ->required()
                ->maxLength(255),
        ])->columns(2);
    }
}
