<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Actions;

use Filament\Actions;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Action;

class EditAction extends Action
{
    public static function make(): Actions\Action
    {
        return Actions\EditAction::make();
    }
}
