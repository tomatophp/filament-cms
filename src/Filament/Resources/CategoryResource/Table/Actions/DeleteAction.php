<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Actions;

use Filament\Actions;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Action;

class DeleteAction extends Action
{
    public static function make(): Actions\Action
    {
        return Actions\DeleteAction::make()
            ->iconButton()
            ->tooltip(__('filament-actions::delete.single.label'));
    }
}
