<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Filters;

use Filament\Forms;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class IsTrendFilter
{
    public static function make(): Filter
    {
        return Filter::make('is_trend')
            ->schema([
                Forms\Components\Toggle::make('is_trend')
                    ->label('Trend'),
            ])
            ->query(function (Builder $query, array $data) {
                return $query
                    ->when(
                        $data['is_trend'],
                        fn (Builder $query, $isTrend): Builder => $query->where('is_trend', (bool) $isTrend),
                    );
            });
    }
}
