<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Columns;

use Filament\Tables;
use Illuminate\Support\Str;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Column;
use TomatoPHP\FilamentCms\Models\Category;

class Name extends Column
{
    public static function make(): Tables\Columns\Column
    {
        return Tables\Columns\TextColumn::make('name')
            ->description(fn (Category $category) => Str::of($category->description)->limit(50))
            ->label(trans('filament-cms::messages.content.category.sections.details.columns.name'))
            ->searchable();
    }
}
