<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Filters;

use Filament\Forms;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use TomatoPHP\FilamentCms\Services\FilamentCMSTypes;

class TypeFilter
{
    public static function make(): Filter
    {
        return Filter::make('type')
            ->form([
                Forms\Components\Select::make('type')
                    ->options(FilamentCMSTypes::getOptions()->pluck('label', 'key')->toArray())
                    ->label('Type')
                    ->searchable(),
            ])
            ->query(function (Builder $query, array $data) {
                return $query
                    ->when(
                        $data['type'],
                        fn (Builder $query, $type): Builder => $query->where('type', '>=', $type),
                    );
            });
    }
}
