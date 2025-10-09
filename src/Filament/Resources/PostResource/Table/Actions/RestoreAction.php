<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Actions;

use Filament\Actions;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Action;

class RestoreAction extends Action
{
    public static function make(): Actions\Action
    {
        return Actions\RestoreAction::make()
            ->iconButton()
            ->tooltip(__('filament-actions::restore.single.label'));
    }
}
