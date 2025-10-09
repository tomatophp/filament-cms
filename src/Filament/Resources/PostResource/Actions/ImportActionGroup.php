<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Actions;

use Filament\Actions;
use TomatoPHP\FilamentCms\Facades\FilamentCMS;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Action;

class ImportActionGroup extends Action
{
    public static function make(): Actions\ActionGroup
    {
        return Actions\ActionGroup::make(FilamentCMS::getImportActions())
            ->button()
            ->label('Content Import')
            ->icon('heroicon-o-arrow-down-tray')
            ->color('success');
    }
}
