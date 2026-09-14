<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Filters;

use Filament\Forms;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use TomatoPHP\FilamentCms\Services\FilamentCMSAuthors;

class AuthorFilter
{
    public static function make(): Filter
    {
        return Filter::make('author_id')
            ->label('Author')
            ->schema([
                Forms\Components\Select::make('author_type')
                    ->label('Author Type')
                    ->options(count(FilamentCMSAuthors::getOptions()) ? FilamentCMSAuthors::getOptions()->pluck('name', 'model')->toArray() : [config('auth.providers.users.model', 'App\Models\User') => 'Users'])
                    ->afterStateUpdated(fn (Get $get, Set $set) => $set('author_id', null))
                    ->live()
                    ->searchable(),
                Forms\Components\Select::make('author_id')
                    ->label('Author')
                    ->hidden(fn (Get $get) => ! $get('author_type'))
                    ->disabled(fn (Get $get) => ! $get('author_type'))
                    ->options(fn (Get $get) => $get('author_type') ? $get('author_type')::pluck('name', 'id')->toArray() : [])
                    ->searchable(),
            ])
            ->query(function (Builder $query, array $data) {
                return $query
                    ->when(
                        $data['author_type'],
                        fn (Builder $query, $type): Builder => $query->where('author_type', $type),
                    )
                    ->when(
                        $data['author_id'],
                        fn (Builder $query, $id): Builder => $query->where('author_id', $id),
                    );
            });
    }
}
