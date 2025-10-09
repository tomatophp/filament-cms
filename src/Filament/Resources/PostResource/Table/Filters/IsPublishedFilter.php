<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Filters;

use Filament\Forms;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class IsPublishedFilter
{
    public static function make(): Filter
    {
        return Filter::make('is_published')
            ->form([
                Forms\Components\Toggle::make('is_published')
                    ->label('Published'),
            ])
            ->query(function (Builder $query, array $data) {
                return $query
                    ->when(
                        $data['is_published'],
                        fn (Builder $query, $isPublished): Builder => $query->where('is_published', (bool) $isPublished),
                    );
            });
    }
}
