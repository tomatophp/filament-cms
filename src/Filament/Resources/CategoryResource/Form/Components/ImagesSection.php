<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Form\Components;

use Filament\Forms;
use Filament\Schemas\Components\Section;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Form\Component;

class ImagesSection extends Component
{
    public static function make(): \Filament\Schemas\Components\Component
    {
        return Section::make(trans('filament-cms::messages.content.posts.sections.images.title'))
            ->description(trans('filament-cms::messages.content.posts.sections.images.description'))
            ->schema([
                Forms\Components\SpatieMediaLibraryFileUpload::make('feature_image')
                    ->label(trans('filament-cms::messages.content.posts.sections.images.columns.feature_image'))
                    ->collection('feature_image')
                    ->image()
                    ->maxFiles(1)
                    ->maxSize(2048)
                    ->maxWidth(1920),
                Forms\Components\SpatieMediaLibraryFileUpload::make('cover_image')
                    ->label(trans('filament-cms::messages.content.posts.sections.images.columns.cover_image'))
                    ->collection('cover_image')
                    ->image()
                    ->maxFiles(1)
                    ->maxSize(2048)
                    ->maxWidth(1920),
            ]);
    }
}
