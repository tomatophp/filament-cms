<?php

namespace TomatoPHP\FilamentCms;

use Filament\Forms\Components\TextInput;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use ProtoneMedia\Splade\Http\SpladeMiddleware;
use TomatoPHP\FilamentCms\Facades\FilamentCMS;
use TomatoPHP\FilamentCms\Livewire\BuilderToolbar;
use TomatoPHP\FilamentCms\Livewire\BuilderToolbarForm;
use TomatoPHP\FilamentCms\Livewire\BuilderToolbarHeader;
use TomatoPHP\FilamentCms\Sections\TomatoAboutFeaturesSection;
use TomatoPHP\FilamentCms\Services\Contracts\CmsType;
use TomatoPHP\FilamentCms\Services\Contracts\Section;
use TomatoPHP\FilamentCms\Services\FilamentCMSServices;
use TomatoPHP\FilamentCms\Services\FilamentCMSTypes;

require_once  __DIR__ .'/helpers.php';

class FilamentCmsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register generate command
        $this->commands([
           \TomatoPHP\FilamentCms\Console\FilamentCmsInstall::class,
           \TomatoPHP\FilamentCms\Console\FilamentThemeGenerator::class,
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
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->app->bind('filament-cms', function() {
            return new FilamentCMSServices();
        });

        $this->loadViewComponentsAs('tomato', [
            \TomatoPHP\FilamentCms\Views\BuilderToolbar::class,
        ]);

    }

    public function boot(): void
    {
        Livewire::isDiscoverable(BuilderToolbar::class);

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
           CmsType::make('page')
               ->label(trans('filament-cms::messages.types.page'))
               ->color('success')
               ->icon('heroicon-o-bars-3-center-left')
               ->sub([
                   CmsType::make('skill')
                       ->color('info')
                       ->icon('heroicon-o-folder')
                       ->label(trans('filament-cms::messages.types.skill')),
                   CmsType::make('faq')
                       ->color('info')
                       ->icon('heroicon-o-question-mark-circle')
                       ->label(trans('filament-cms::messages.types.faq')),
                   CmsType::make('testimonials')
                       ->color('warning')
                       ->icon('heroicon-o-tag')
                       ->label(trans('filament-cms::messages.types.testimonials')),
                   CmsType::make('feature')
                       ->label(trans('filament-cms::messages.types.feature'))
                        ->color('warning')
                        ->icon('heroicon-o-tag'),
               ]),
           CmsType::make('builder')
               ->color('warning')
               ->label(trans('filament-cms::messages.types.builder'))
               ->icon('heroicon-o-clipboard-document-list'),
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
