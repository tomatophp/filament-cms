<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table;

use Filament\Actions;
use Filament\Actions\Action;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Export;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Import;

class PostHeaderActions
{
    protected static array $actions = [];

    public static function make(): array
    {
        return self::getActions();
    }

    private static function getDefaultActions(): array
    {
        $actions = [];

        if (filament('filament-cms')::$allowImport) {
            $actions[] = Actions\ImportAction::make()
                ->importer(Import\ImportPosts::class);
        }

        if (filament('filament-cms')::$allowExport) {
            $actions[] = Actions\ExportAction::make()
                ->exporter(Export\ExportPosts::class);
        }

        return $actions;
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
