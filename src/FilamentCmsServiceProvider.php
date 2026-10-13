<?php

namespace TomatoPHP\FilamentCms;

use Illuminate\Support\ServiceProvider;
use TomatoPHP\FilamentCms\Console\FilamentCmsInstall;
use TomatoPHP\FilamentCms\Services\Contracts\CmsType;
use TomatoPHP\FilamentCms\Services\FilamentCMSServices;
use TomatoPHP\FilamentCms\Services\FilamentCMSTypes;

class FilamentCmsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register generate command
        $this->commands([
            FilamentCmsInstall::class,
        ]);

        // Register Config file
        $this->mergeConfigFrom(__DIR__ . '/../config/filament-cms.php', 'filament-cms');

        // Publish Config
        $this->publishes([
            __DIR__ . '/../config/filament-cms.php' => config_path('filament-cms.php'),
        ], 'filament-cms-config');

        // Register Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Publish Migrations
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'filament-cms-migrations');
        // Register views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'filament-cms');

        // Publish Views
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/filament-cms'),
        ], 'filament-cms-views');

        // Register Langs
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'filament-cms');

        // Publish Lang
        $this->publishes([
            __DIR__ . '/../resources/lang' => base_path('lang/vendor/filament-cms'),
        ], 'filament-cms-lang');

        $this->app->bind('filament-cms', function () {
            return new FilamentCMSServices;
        });
    }

    public function boot(): void
    {
        FilamentCMSTypes::register([
            CmsType::make('post')
                ->label(trans('filament-cms::messages.types.post'))
                ->color('success')
                ->icon('heroicon-o-document')
                ->sub([
                    CmsType::make('category')
                        ->color('info')
                        ->icon('heroicon-o-folder')
                        ->label(trans('filament-cms::messages.types.category')),
                    CmsType::make('tags')
                        ->color('warning')
                        ->icon('heroicon-o-tag')
                        ->label(trans('filament-cms::messages.types.tags')),
                ]),
            CmsType::make('service')
                ->color('warning')
                ->label(trans('filament-cms::messages.types.service'))
                ->icon('heroicon-o-wrench-screwdriver'),
            CmsType::make('portfolio')
                ->label(trans('filament-cms::messages.types.portfolio'))
                ->color('warning')
                ->icon('heroicon-o-presentation-chart-bar'),
            CmsType::make('video')
                ->label(trans('filament-cms::messages.types.video'))
                ->color('warning')
                ->icon('heroicon-o-film'),
            CmsType::make('audio')
                ->label(trans('filament-cms::messages.types.audio'))
                ->color('warning')
                ->icon('heroicon-o-musical-note'),
            CmsType::make('gallary')
                ->label(trans('filament-cms::messages.types.gallary'))
                ->color('warning')
                ->icon('heroicon-o-photo'),
            CmsType::make('link')
                ->label(trans('filament-cms::messages.types.link'))
                ->color('success')
                ->icon('heroicon-o-link'),
            CmsType::make('open-source')
                ->label(trans('filament-cms::messages.types.open-source'))
                ->color('info')
                ->icon('heroicon-o-code-bracket'),
            CmsType::make('event')
                ->label(trans('filament-cms::messages.types.event'))
                ->color('info')
                ->icon('heroicon-o-calendar-days'),
            CmsType::make('quote')
                ->label(trans('filament-cms::messages.types.quote'))
                ->color('danger')
                ->icon('heroicon-o-bolt'),
        ]);
    }
}
