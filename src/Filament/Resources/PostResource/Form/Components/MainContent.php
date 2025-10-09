<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\Components;

use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\Component;

class MainContent extends Component
{
    public static function make(): \Filament\Schemas\Components\Component
    {
        return Grid::make()
            ->columns(1)
            ->schema([
                Section::make(trans('filament-cms::messages.content.posts.sections.post.title'))
                    ->description(trans('filament-cms::messages.content.posts.sections.post.description'))
                    ->schema([
                        DetailsSection::make(),
                        BodySection::make(),
                    ])
                    ->columns(1),
                MetaSection::make(),
            ])
            ->columnSpan([
                'sm' => 1,
                'md' => 4,
                'lg' => 8,
            ]);
    }
}
