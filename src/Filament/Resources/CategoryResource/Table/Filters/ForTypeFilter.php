<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Filters;

use Filament\Forms;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use TomatoPHP\FilamentCms\Services\FilamentCMSTypes;

class ForTypeFilter
{
    public static function make(): Filter
    {
        return Filter::make('for')
            ->form([
                Forms\Components\Select::make('for')
                    ->label(trans('filament-cms::messages.content.category.sections.status.columns.for'))
                    ->searchable()
                    ->live()
                    ->options(fn () => FilamentCMSTypes::getOptions()->pluck('label', 'key')->toArray()),
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
                    ->options(fn (Get $get) => FilamentCMSTypes::getOptions()->where('key', $get('for'))->first()?->getSub()->pluck('label', 'key')->toArray()),

            ])
            ->query(function (Builder $query, array $data) {
                $query->when(
                    $data['for'],
                    fn (Builder $query, $for) => $query->where('for', $for)
                )->when(
                    $data['type'],
                    fn (Builder $query, $type) => $query->where('type', $type)
                );
            });
    }
}
