<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList;

use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;

class PostInfoList
{
    protected static array $schema = [];

    public static function make(Schema $infolist): Schema
    {
        return $infolist->columns(1)->schema(self::getSchema());
    }

    public static function getDefaultSchema(): array
    {
        return [
            Sections\PostSection::make(),
            Sections\MainGrid::make(),
        ];
    }

    private static function getSchema(): array
    {
        return array_merge(self::getDefaultSchema(), self::$schema);
    }

    public static function register(Component | array $component): void
    {
        if (is_array($component)) {
            foreach ($component as $item) {
                if ($item instanceof Component) {
                    self::$schema[] = $item;
                }
            }
        } else {
            self::$schema[] = $component;
        }
    }
}
