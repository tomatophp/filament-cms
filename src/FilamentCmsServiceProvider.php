<?php

namespace TomatoPHP\FilamentCms;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use ProtoneMedia\Splade\Http\SpladeMiddleware;
use TomatoPHP\FilamentCms\Facades\FilamentCMS;
use TomatoPHP\FilamentCms\Livewire\BuilderToolbar;
use TomatoPHP\FilamentCms\Livewire\BuilderToolbarForm;
use TomatoPHP\FilamentCms\Livewire\BuilderToolbarHeader;
use TomatoPHP\FilamentCms\Sections\TomatoAboutFeaturesSection;
use TomatoPHP\FilamentCms\Services\Contracts\CmsFormFieldType;
use TomatoPHP\FilamentCms\Services\Contracts\CmsType;
use TomatoPHP\FilamentCms\Services\Contracts\Section;
use TomatoPHP\FilamentCms\Services\FilamentCMSFormFields;
use TomatoPHP\FilamentCms\Services\FilamentCMSServices;
use TomatoPHP\FilamentCms\Services\FilamentCMSTypes;
use TomatoPHP\FilamentIcons\Components\IconPicker;

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

        FilamentCMSFormFields::register([
            CmsFormFieldType::make('text')
                ->label('Text'),
            CmsFormFieldType::make('textarea')
                ->className(Textarea::class)
                ->color('warning')
                ->icon('heroicon-s-document-text')
                ->label('Textarea'),
            CmsFormFieldType::make('select')
                ->className(Select::class)
                ->color('info')
                ->icon('heroicon-s-squares-plus')
                ->label('Select'),
            CmsFormFieldType::make('checkbox')
                ->className(Checkbox::class)
                ->color('danger')
                ->icon('heroicon-s-check')
                ->label('Checkbox'),
            CmsFormFieldType::make('radio')
                ->className(Radio::class)
                ->color('success')
                ->icon('heroicon-s-check-circle')
                ->label('Radio'),
            CmsFormFieldType::make('file')
                ->className(FileUpload::class)
                ->color('info')
                ->icon('heroicon-s-document-arrow-up')
                ->label('File'),
            CmsFormFieldType::make('date')
                ->className(DatePicker::class)
                ->color('success')
                ->icon('heroicon-s-calendar')
                ->label('Date'),
            CmsFormFieldType::make('time')
                ->className(TimePicker::class)
                ->color('info')
                ->icon('heroicon-s-clock')
                ->label('Time'),
            CmsFormFieldType::make('datetime')
                ->className(DateTimePicker::class)
                ->color('warning')
                ->icon('heroicon-s-calendar-days')
                ->label('DateTime'),
            CmsFormFieldType::make('color')
                ->className(ColorPicker::class)
                ->color('success')
                ->icon('heroicon-s-swatch')
                ->label('Color'),
            CmsFormFieldType::make('icon')
                ->className(IconPicker::class)
                ->color('info')
                ->icon('heroicon-s-heart')
                ->label('Icon'),
            CmsFormFieldType::make('toggle')
                ->className(Toggle::class)
                ->color('success')
                ->icon('heroicon-s-adjustments-horizontal')
                ->label('Toggle'),
            CmsFormFieldType::make('password')
                ->color('danger')
                ->icon('heroicon-s-lock-closed')
                ->label('Password'),
            CmsFormFieldType::make('email')
                ->color('info')
                ->icon('heroicon-s-envelope')
                ->label('Email'),
            CmsFormFieldType::make('number')
                ->color('success')
                ->icon('heroicon-s-minus-circle')
                ->label('Number'),
            CmsFormFieldType::make('url')
                ->color('primary')
                ->icon('heroicon-s-globe-alt')
                ->label('URL'),
            CmsFormFieldType::make('tel')
                ->color('warning')
                ->icon('heroicon-s-phone')
                ->label('Tel'),
            CmsFormFieldType::make('markdown')
                ->className(MarkdownEditor::class)
                ->color('warning')
                ->icon('heroicon-s-hashtag')
                ->label('Markdown'),
            CmsFormFieldType::make('rich')
                ->className(RichEditor::class)
                ->color('info')
                ->icon('heroicon-s-document-text')
                ->label('RichText'),
            CmsFormFieldType::make('keyValue')
                ->className(KeyValue::class)
                ->color('danger')
                ->icon('heroicon-s-key')
                ->label('Key/Value'),
            CmsFormFieldType::make('repeater')
                ->className(Repeater::class)
                ->icon('heroicon-s-rectangle-group')
                ->label('Repeater'),
        ]);
    }
}
