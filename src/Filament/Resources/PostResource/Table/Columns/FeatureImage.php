<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Columns;

use Filament\Tables;
use Illuminate\Support\Str;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Column;
use TomatoPHP\FilamentCms\Models\Post;

class FeatureImage extends Column
{
    public static function make(): Tables\Columns\Column
    {
        return Tables\Columns\SpatieMediaLibraryImageColumn::make('feature_image')
            ->label(trans('filament-cms::messages.content.posts.sections.images.columns.feature_image'))
            ->defaultImageUrl(fn (Post $post) => 'https://ui-avatars.com/api/?name=' . Str::of($post->slug)->replace('-', '+') . '&color=FFFFFF&background=020617')
            ->square()
            ->toggleable()
            ->collection('feature_image');
    }
}
