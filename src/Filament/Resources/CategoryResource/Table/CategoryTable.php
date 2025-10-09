<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table;

use Filament\Tables\Columns\Column as FilamentColumn;
use Filament\Tables\Table;

class CategoryTable
{
    protected static array $columns = [];

    public static function make(Table $table): Table
    {
        return $table
            ->recordActions(config('filament-cms.resources.category.table.actions')::make())
            ->toolbarActions(config('filament-cms.resources.category.table.bulkActions')::make())
            ->filters(config('filament-cms.resources.category.table.filters')::make())
            ->columns(self::getColumns());
    }

    public static function getDefaultColumns(): array
    {
        return [
            Columns\FeatureImage::make(),
            Columns\Name::make(),
            Columns\ForColumn::make(),
            Columns\Type::make(),
            Columns\Icon::make(),
            Columns\Color::make(),
            Columns\IsActive::make(),
            Columns\ShowInMenu::make(),
            Columns\ParentCategory::make(),
            Columns\CreatedAt::make(),
            Columns\UpdatedAt::make(),
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
