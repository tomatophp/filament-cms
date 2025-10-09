<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Actions;

use Filament\Actions;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Action;

class ForceDeleteAction extends Action
{
    public static function make(): Actions\Action
    {
        return Actions\ForceDeleteAction::make()
            ->iconButton()
            ->tooltip(__('filament-actions::force-delete.single.label'));
    }
}
