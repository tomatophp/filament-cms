<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\Components;

use App\Models\User;
use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\Component;
use TomatoPHP\FilamentCms\Services\FilamentCMSAuthors;

class AuthorSection extends Component
{
    public static function make(): \Filament\Schemas\Components\Component
    {
        return Section::make(trans('filament-cms::messages.content.posts.sections.author.title'))
            ->description(trans('filament-cms::messages.content.posts.sections.author.description'))
            ->schema([
                Forms\Components\Select::make('author_type')
                    ->label(trans('filament-cms::messages.content.posts.sections.author.columns.author_type'))
                    ->options(count(FilamentCMSAuthors::getOptions()) ? FilamentCMSAuthors::getOptions()->pluck('name', 'model')->toArray() : [User::class => 'Users'])
                    ->afterStateUpdated(fn (Get $get, Set $set) => $set('author_id', null))
                    ->preload()
                    ->live()
                    ->searchable(),
                Forms\Components\Select::make('author_id')
                    ->label(trans('filament-cms::messages.content.posts.sections.author.columns.author'))
                    ->options(fn (Get $get) => $get('author_type') ? $get('author_type')::pluck('name', 'id')->toArray() : [])
                    ->searchable(),
            ]);
    }
}
