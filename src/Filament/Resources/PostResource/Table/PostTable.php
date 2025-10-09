<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table;

use Filament\Tables\Columns\Column as FilamentColumn;
use Filament\Tables\Table;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Pages\ViewPost;
use TomatoPHP\FilamentCms\Models\Post;

class PostTable
{
    protected static array $columns = [];

    public static function make(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->headerActions(config('filament-cms.resources.post.table.headerActions')::make())
            ->recordActions(config('filament-cms.resources.post.table.actions')::make())
            ->toolbarActions(config('filament-cms.resources.post.table.bulkActions')::make())
            ->filters(config('filament-cms.resources.post.table.filters')::make())
            ->defaultSort('created_at', 'desc')
            ->columns(self::getColumns())
            ->recordUrl(fn (Post $record): string => ViewPost::getUrl([$record->id]));
    }

    public static function getDefaultColumns(): array
    {
        return [
            Columns\FeatureImage::make(),
            Columns\Title::make(),
            Columns\Type::make(),
            Columns\IsPublished::make(),
            Columns\IsTrend::make(),
            Columns\PublishedAt::make(),
            Columns\Likes::make(),
            Columns\Views::make(),
            Columns\CreatedAt::make(),
            Columns\UpdatedAt::make(),
            Columns\DeletedAt::make(),
        ];
    }

    private static function getColumns(): array
    {
        return array_merge(self::getDefaultColumns(), self::$columns);
    }

    public static function register(FilamentColumn | array $column): void
    {
        if (is_array($column)) {
            foreach ($column as $item) {
                if ($item instanceof FilamentColumn) {
                    self::$columns[] = $item;
                }
            }
        } else {
            self::$columns[] = $column;
        }
    }
}
