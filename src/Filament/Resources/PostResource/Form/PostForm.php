<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form;

use Filament\Forms\Components\Field;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class PostForm
{
    protected static array $schema = [];

    public static function make(Schema $form): Schema
    {
        return $form->schema([
            Grid::make([
                'sm' => 1,
                'md' => 6,
                'lg' => 12,
            ])
                ->schema(self::getSchema()),
        ])->columns(1);
    }

    public static function getDefaultComponents(): array
    {
        return [
            Components\TypeSection::make(),
            Components\MainContent::make(),
            Components\SidebarMeta::make(),
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
                if ($item instanceof Field || $item instanceof \Filament\Schemas\Components\Component) {
                    self::$schema[] = $item;
                }
            }
        } else {
            self::$schema[] = $component;
        }
    }
}
