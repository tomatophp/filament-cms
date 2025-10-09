<?php

namespace TomatoPHP\FilamentCms\Tests;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Filament\Actions\ActionsServiceProvider;
use Filament\FilamentServiceProvider;
use Filament\Forms\FormsServiceProvider;
use Filament\Infolists\InfolistsServiceProvider;
use Filament\Notifications\NotificationsServiceProvider;
use Filament\Schemas\SchemasServiceProvider;
use Filament\Support\SupportServiceProvider;
use Filament\Tables\TablesServiceProvider;
use Filament\Widgets\WidgetsServiceProvider;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\Attributes\WithEnv;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as BaseTestCase;
use RyanChandler\BladeCaptureDirective\BladeCaptureDirectiveServiceProvider;
use TomatoPHP\FilamentCms\FilamentCmsServiceProvider;
use TomatoPHP\FilamentCms\Services\Contracts\CmsType;
use TomatoPHP\FilamentCms\Services\FilamentCMSTypes;
use TomatoPHP\FilamentCms\Tests\Models\User;

#[WithEnv('DB_CONNECTION', 'testing')]
abstract class TestCase extends BaseTestCase
{
    use LazilyRefreshDatabase;
    use WithWorkbench;

    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

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

    protected function getPackageProviders($app): array
    {
        $providers = [
            ActionsServiceProvider::class,
            BladeCaptureDirectiveServiceProvider::class,
            BladeHeroiconsServiceProvider::class,
            BladeIconsServiceProvider::class,
            FilamentServiceProvider::class,
            FormsServiceProvider::class,
            InfolistsServiceProvider::class,
            LivewireServiceProvider::class,
            NotificationsServiceProvider::class,
            SupportServiceProvider::class,
            TablesServiceProvider::class,
            WidgetsServiceProvider::class,
            SchemasServiceProvider::class,
            \TomatoPHP\FilamentIcons\FilamentIconsServiceProvider::class,
            \TomatoPHP\FilamentTranslationComponent\FilamentTranslationComponentServiceProvider::class,
            \Spatie\MediaLibrary\MediaLibraryServiceProvider::class,
            FilamentCmsServiceProvider::class,
            AdminPanelProvider::class,
        ];

        sort($providers);

        return $providers;
    }

    protected function defineEnvironment($app)
    {

        tap($app['config'], function (Repository $config) {
            $config->set('database.default', 'testing');
            $config->set('database.connections.testing', [
                'driver' => 'sqlite',
                'database' => ':memory:',
                'prefix' => '',
            ]);

            $config->set('auth.guards.testing.driver', 'session');
            $config->set('auth.guards.testing.provider', 'testing');
            $config->set('auth.providers.testing.driver', 'eloquent');
            $config->set('auth.providers.testing.model', User::class);

            $config->set('view.paths', [
                ...$config->get('view.paths'),
                __DIR__ . '/../resources/views',
            ]);

            // Configure media-library
            $config->set('media-library.media_model', \Spatie\MediaLibrary\MediaCollections\Models\Media::class);
            $config->set('media-library.disk_name', 'public');
        });
    }
}
