<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Form;

abstract class Component
{
    abstract public static function make(): \Filament\Forms\Components\Field | \Filament\Schemas\Components\Component;
}
