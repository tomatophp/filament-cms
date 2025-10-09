<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Actions;

use Filament\Actions;

abstract class Action
{
    abstract public static function make(): Actions\Action;
}
