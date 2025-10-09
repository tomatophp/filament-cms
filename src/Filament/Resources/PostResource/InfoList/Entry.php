<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList;

abstract class Entry
{
    abstract public static function make(): \Filament\Infolists\Components\Entry;
}
