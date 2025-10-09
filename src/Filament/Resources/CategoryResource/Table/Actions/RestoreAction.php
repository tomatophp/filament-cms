<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Actions;

use Filament\Actions;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Action;

class RestoreAction extends Action
{
    public static function make(): Actions\Action
    {
        return Actions\RestoreAction::make()
            ->iconButton()
            ->tooltip(__('filament-actions::restore.single.label'));
    }
}
