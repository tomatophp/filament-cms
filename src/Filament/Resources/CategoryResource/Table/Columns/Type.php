<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Columns;

use Filament\Tables;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Column;
use TomatoPHP\FilamentCms\Models\Category;
use TomatoPHP\FilamentCms\Services\FilamentCMSTypes;

class Type extends Column
{
    public static function make(): Tables\Columns\Column
    {
        return Tables\Columns\TextColumn::make('type')
            ->state(function (Category $category) {
                return FilamentCMSTypes::getOptions()->where('key', $category->for)->first()?->getSub()->where('key', $category->type)->first()?->label;
            })
            ->color(function (Category $category) {
                return FilamentCMSTypes::getOptions()->where('key', $category->for)->first()?->getSub()->where('key', $category->type)->first()?->color;
            })
            ->icon(function (Category $category) {
                return FilamentCMSTypes::getOptions()->where('key', $category->for)->first()?->getSub()->where('key', $category->type)->first()?->icon;
            })
            ->badge()
            ->sortable()
            ->label(trans('filament-cms::messages.content.category.sections.status.columns.type'))
            ->searchable();
    }
}
