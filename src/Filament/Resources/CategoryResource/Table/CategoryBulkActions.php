<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table;

use Filament\Actions;

class CategoryBulkActions
{
    protected static array $actions = [];

    public static function make(): array
    {
        return [
            Actions\BulkActionGroup::make(self::getActions()),
        ];
    }

    private static function getDefaultActions(): array
    {
        return [
            Actions\DeleteBulkAction::make(),
            Actions\ForceDeleteBulkAction::make(),
            Actions\RestoreBulkAction::make(),
        ];
    }

    private static function getActions(): array
    {
        return array_merge(self::getDefaultActions(), self::$actions);
    }

    public static function register(\Filament\Actions\Action | array $action): void
    {
        if (is_array($action)) {
            foreach ($action as $item) {
                if ($item instanceof \Filament\Actions\Action) {
                    self::$actions[] = $item;
                }
            }
        } else {
            self::$actions[] = $action;
        }
    }
}
