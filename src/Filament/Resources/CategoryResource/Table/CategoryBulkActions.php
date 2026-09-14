<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table;

use Filament\Actions;
use Filament\Actions\Action;

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

    public static function register(Action | array $action): void
    {
        if (is_array($action)) {
            foreach ($action as $item) {
                if ($item instanceof Action) {
                    self::$actions[] = $item;
                }
            }
        } else {
            self::$actions[] = $action;
        }
    }
}
