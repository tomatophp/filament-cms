<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Form;

use Filament\Forms\Components\Field;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class CategoryForm
{
    protected static array $schema = [];

    public static function make(Schema $form): Schema
    {
        return $form->schema(self::getSchema())->columns(1);
    }

    public static function getDefaultComponents(): array
    {
        return [
            Grid::make([
                'default' => 1,
                'sm' => 1,
                'md' => 6,
                'lg' => 12,
            ])->schema([
                Components\MainContent::make(),
                Components\SidebarMeta::make(),
            ]),
        ];
    }

    private static function getSchema(): array
    {
        return array_merge(self::getDefaultComponents(), self::$schema);
    }

    public static function register(Field | array $component): void
    {
        if (is_array($component)) {
            foreach ($component as $item) {
                if ($item instanceof Field) {
                    self::$schema[] = $item;
                }
            }
        } else {
            self::$schema[] = $component;
        }
    }
}
