<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table;

use Filament\Tables\Filters\Filter;

class CategoryFilters
{
    protected static array $filters = [];

    public static function make(): array
    {
        return self::getFilters();
    }

    private static function getDefaultFilters(): array
    {
        return [
            Filters\ForTypeFilter::make(),
            \Filament\Tables\Filters\TrashedFilter::make(),
        ];
    }

    private static function getFilters(): array
    {
        return array_merge(self::getDefaultFilters(), self::$filters);
    }

    public static function register(Filter | array $filter): void
    {
        if (is_array($filter)) {
            foreach ($filter as $item) {
                if ($item instanceof Filter) {
                    self::$filters[] = $item;
                }
            }
        } else {
            self::$filters[] = $filter;
        }
    }
}
