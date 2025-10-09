<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table;

use Filament\Tables\Filters\Filter;

class PostFilters
{
    protected static array $filters = [];

    public static function make(): array
    {
        return self::getFilters();
    }

    private static function getDefaultFilters(): array
    {
        return [
            Filters\TypeFilter::make(),
            Filters\AuthorFilter::make(),
            Filters\PublishedAtFilter::make(),
            Filters\IsPublishedFilter::make(),
            Filters\IsTrendFilter::make(),
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
