<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form;

use Filament\Forms\Components\Field;

abstract class Component
{
    abstract public static function make(): Field | \Filament\Schemas\Components\Component;
}
