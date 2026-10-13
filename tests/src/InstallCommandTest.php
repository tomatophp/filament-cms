<?php

use TomatoPHP\FilamentCms\Console\FilamentCmsInstall;
use TomatoPHP\FilamentCms\FilamentCmsServiceProvider;

use function Pest\Laravel\artisan;

it('boots the service provider', function () {
    expect(app()->getProviders(FilamentCmsServiceProvider::class))->not->toBeEmpty()
        ->and(config('filament-cms.resources.post.form.class'))->not->toBeNull()
        ->and(app('filament-cms'))->not->toBeNull();
});

it('registers the install command', function () {
    expect(array_key_exists('filament-cms:install', Artisan::all()))->toBeTrue()
        ->and(Artisan::all()['filament-cms:install'])->toBeInstanceOf(FilamentCmsInstall::class);
});

it('runs the install command', function () {
    artisan('filament-cms:install')
        ->expectsOutputToContain('Filament CMS installed successfully.')
        ->assertSuccessful();
});
