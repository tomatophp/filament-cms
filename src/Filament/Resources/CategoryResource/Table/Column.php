<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table;

abstract class Column
{
    abstract public static function make(): \Filament\Tables\Columns\Column;
}
