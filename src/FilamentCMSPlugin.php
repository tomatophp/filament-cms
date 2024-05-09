<?php

namespace TomatoPHP\FilamentCms;

use Filament\Contracts\Plugin;
use Filament\Panel;


class FilamentCMSPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-cms';
    }

    public function register(Panel $panel): void
    {
        //
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return new static();
    }
}
