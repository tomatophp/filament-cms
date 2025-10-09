<?php

namespace TomatoPHP\FilamentCms\Filament\Resources;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use TomatoPHP\FilamentCms\Facades\FilamentCMS;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Pages;
use TomatoPHP\FilamentCms\Models\Post;

class PostResource extends Resource
{
    use Translatable;

    protected static ?string $model = Post::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-pencil';

    public static function getTranslatableLocales(): array
    {
        $plugin = filament('filament-cms');
        return $plugin::$defaultLocales;
    }

    public static function getNavigationGroup(): ?string
    {
        return trans('filament-cms::messages.content.group');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('filament-cms::messages.content.posts.title');
    }

    public static function getLabel(): ?string
    {
        return trans('filament-cms::messages.content.posts.single');
    }

    public static function getNavigationLabel(): string
    {
        return trans('filament-cms::messages.content.posts.title');
    }

    public static function form(Schema $form): Schema
    {
        return config('filament-cms.resources.post.form.class')::make($form);
    }

    public static function infolist(Schema $infolist): Schema
    {
        return config('filament-cms.resources.post.infolist.class')::make($infolist);
    }

    public static function table(Table $table): Table
    {
        return config('filament-cms.resources.post.table.class')::make($table);
    }

    public static function getRelations(): array
    {
        return FilamentCMS::getPostRelations();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}/show'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
