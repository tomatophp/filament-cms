<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Columns;

use Filament\Tables;
use Illuminate\Support\Str;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Column;
use TomatoPHP\FilamentCms\Models\Category;

class FeatureImage extends Column
{
    public static function make(): Tables\Columns\Column
    {
        return Tables\Columns\SpatieMediaLibraryImageColumn::make('feature_image')
            ->label(trans('filament-cms::messages.content.posts.sections.images.columns.feature_image'))
            ->defaultImageUrl(fn (Category $category) => 'https://ui-avatars.com/api/?name=' . Str::of($category->slug)->replace('-', '+') . '&color=FFFFFF&background=020617')
            ->square()
            ->collection('feature_image');
    }
}
