<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Actions;

use Filament\Actions;

abstract class Action
{
    abstract public static function make(): Actions\Action | Actions\ActionGroup;
}
