<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table;

abstract class Action
{
    abstract public static function make(): \Filament\Actions\Action;
}
