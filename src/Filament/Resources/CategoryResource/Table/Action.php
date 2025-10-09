<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table;

abstract class Action
{
    abstract public static function make(): \Filament\Actions\Action | \Filament\Actions\ActionGroup;
}
