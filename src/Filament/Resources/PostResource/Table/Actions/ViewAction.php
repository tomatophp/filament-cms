<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Actions;

use Filament\Actions;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Action;

class ViewAction extends Action
{
    public static function make(): Actions\Action
    {
        return Actions\ViewAction::make()
            ->iconButton()
            ->tooltip(__('filament-actions::view.single.label'));
    }
}
