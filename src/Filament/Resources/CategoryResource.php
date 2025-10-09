<?php

namespace TomatoPHP\FilamentCms\Filament\Resources;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use TomatoPHP\FilamentCms\Facades\FilamentCMS;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Pages;
use TomatoPHP\FilamentCms\Models\Category;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static BackedEnum | string | null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return trans('filament-cms::messages.content.group');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('filament-cms::messages.content.category.title');
    }

    public static function getLabel(): ?string
    {
        return trans('filament-cms::messages.content.category.single');
    }

    public static function getNavigationLabel(): string
    {
        return trans('filament-cms::messages.content.category.title');
    }

    public static function form(Schema $form): Schema
    {
        return config('filament-cms.resources.category.form.class')::make($form);
    }

    public static function table(Table $table): Table
    {
        return config('filament-cms.resources.category.table.class')::make($table);
    }

    public static function getRelations(): array
    {
        return FilamentCMS::getCategoryRelations();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
