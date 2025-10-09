<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Columns;

use Filament\Tables;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Column;
use TomatoPHP\FilamentCms\Models\Category;
use TomatoPHP\FilamentCms\Services\FilamentCMSTypes;

class ForColumn extends Column
{
    public static function make(): Tables\Columns\Column
    {
        return Tables\Columns\TextColumn::make('for')
            ->state(function (Category $category) {
                return FilamentCMSTypes::getOptions()->where('key', $category->for)->first()?->label;
            })
            ->color(function (Category $category) {
                return FilamentCMSTypes::getOptions()->where('key', $category->for)->first()?->color;
            })
            ->icon(function (Category $category) {
                return FilamentCMSTypes::getOptions()->where('key', $category->for)->first()?->icon;
            })
            ->badge()
            ->sortable()
            ->label(trans('filament-cms::messages.content.category.sections.status.columns.for'))
            ->searchable();
    }
}
