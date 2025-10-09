<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Actions;

use Filament\Actions;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Action;

class CreateAction extends Action
{
    public static function make(): Actions\Action
    {
        return Actions\CreateAction::make();
    }
}
