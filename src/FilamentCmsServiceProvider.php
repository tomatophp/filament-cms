<?php

namespace TomatoPHP\FilamentCms;

use Illuminate\Support\ServiceProvider;


class FilamentCmsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register generate command
        $this->commands([
           \TomatoPHP\FilamentCms\Console\FilamentCmsInstall::class,
        ]);

        //Register Config file
        $this->mergeConfigFrom(__DIR__.'/../config/filament-cms.php', 'filament-cms');

        //Publish Config
        $this->publishes([
           __DIR__.'/../config/filament-cms.php' => config_path('filament-cms.php'),
        ], 'filament-cms-config');

        //Register Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        //Publish Migrations
        $this->publishes([
           __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'filament-cms-migrations');
        //Register views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-cms');

        //Publish Views
        $this->publishes([
           __DIR__.'/../resources/views' => resource_path('views/vendor/filament-cms'),
        ], 'filament-cms-views');

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'filament-cms');

        //Publish Lang
        $this->publishes([
           __DIR__.'/../resources/lang' => base_path('lang/vendor/filament-cms'),
        ], 'filament-cms-lang');

        //Register Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

    }

    public function boot(): void
    {
        //you boot methods here
    }
}
