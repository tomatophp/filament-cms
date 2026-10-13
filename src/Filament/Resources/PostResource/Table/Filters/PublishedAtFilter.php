<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Filters;

use Filament\Forms;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class PublishedAtFilter
{
    public static function make(): Filter
    {
        return Filter::make('published_at')
            ->schema([
                Forms\Components\DatePicker::make('published_at')
                    ->label('Published At'),
            ])
            ->query(function (Builder $query, array $data) {
                return $query
                    ->when(
                        $data['published_at'],
                        fn (Builder $query, $publishedAt): Builder => $query->whereDate('published_at', $publishedAt),
                    );
            });
    }
}
