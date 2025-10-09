<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\Components;

use Filament\Forms;
use Filament\Schemas\Components\Section;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\Component;

class MetaDataSection extends Component
{
    public static function make(): \Filament\Schemas\Components\Component
    {
        return Section::make(trans('filament-cms::messages.content.posts.sections.meta.title'))
            ->visible(fn ($record) => $record && ! empty($record->meta_url))
            ->description(trans('filament-cms::messages.content.posts.sections.meta.description'))
            ->schema([
                Forms\Components\TextInput::make('github_starts')
                    ->disabled()
                    ->numeric()
                    ->label(trans('filament-cms::messages.content.posts.sections.meta.columns.github_starts')),
                Forms\Components\TextInput::make('github_watchers')
                    ->disabled()
                    ->numeric()
                    ->label(trans('filament-cms::messages.content.posts.sections.meta.columns.github_watchers')),
                Forms\Components\TextInput::make('github_forks')
                    ->disabled()
                    ->numeric()
                    ->label(trans('filament-cms::messages.content.posts.sections.meta.columns.github_forks')),
                Forms\Components\TextInput::make('downloads_total')
                    ->disabled()
                    ->numeric()
                    ->label(trans('filament-cms::messages.content.posts.sections.meta.columns.downloads_total')),
                Forms\Components\TextInput::make('downloads_monthly')
                    ->disabled()
                    ->numeric()
                    ->label(trans('filament-cms::messages.content.posts.sections.meta.columns.downloads_monthly')),
                Forms\Components\TextInput::make('downloads_daily')
                    ->disabled()
                    ->numeric()
                    ->label(trans('filament-cms::messages.content.posts.sections.meta.columns.downloads_daily')),
            ]);
    }
}
