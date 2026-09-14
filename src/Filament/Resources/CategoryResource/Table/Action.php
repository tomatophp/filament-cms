<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table;

use Filament\Actions\ActionGroup;

abstract class Action
{
    abstract public static function make(): \Filament\Actions\Action | ActionGroup;
}
