<?php

use Filament\Facades\Filament;
use TomatoPHP\FilamentCms\FilamentCMSPlugin;

it('registers plugin', function () {
    $panel = Filament::getCurrentOrDefaultPanel();

    $panel->plugins([
        FilamentCMSPlugin::make(),
    ]);

    expect($panel->getPlugin('filament-cms'))
        ->not()
        ->toThrow(Exception::class);
});
