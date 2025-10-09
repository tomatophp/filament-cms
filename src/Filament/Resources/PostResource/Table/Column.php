<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table;

abstract class Column
{
    abstract public static function make(): \Filament\Tables\Columns\Column;
}
