<?php

namespace TomatoPHP\FilamentCms;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\SpatieLaravelTranslatablePlugin;
use Nwidart\Modules\Module;
use TomatoPHP\FilamentCms\Filament\Pages\Themes;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource;
use TomatoPHP\FilamentCms\Filament\Resources\FormResource;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource;
use TomatoPHP\FilamentCms\Filament\Resources\TicketResource;
use TomatoPHP\FilamentCms\Livewire\BuilderToolbar;
use TomatoPHP\FilamentCms\Livewire\BuilderToolbarForm;
use TomatoPHP\FilamentCms\Livewire\BuilderToolbarHeader;


class FilamentCMSPlugin implements Plugin
{
    public static bool $allowUrlImport = true;
    public static bool $allowBehanceImport = false;
    public static bool $allowGitHubImport = true;
    public static bool $allowYoutubeImport = false;
    public static bool $allowExport = false;
    public static bool $allowImport = false;
    public static bool $usePost = true;
    public static bool $useCategory = true;
    public static bool $useThemeManager = false;
    public static bool $usePageBuilder = false;
    public static bool $useFormBuilder = false;
    public static bool $allowShield = false;
//    public static bool $useTicketingSystem = false;
    public static array $defaultLocales = ['ar', 'en'];

    private bool $isActive = false;

    public function getId(): string
    {
        return 'filament-cms';
    }

    public function register(Panel $panel): void
    {
        if (class_exists(Module::class) && \Nwidart\Modules\Facades\Module::find('FilamentCms')?->isEnabled()) {
            $this->isActive = true;
        } else {
            $this->isActive = true;
        }

        if ($this->isActive) {

            if (self::$usePost) {
                $panel->resources([
                    PostResource::class
                ]);
            }
            if (self::$useCategory) {
                $panel->resources([
                    CategoryResource::class
                ]);
            }

            if (self::$useFormBuilder) {
                $panel->resources([
                    FormResource::class
                ]);
            }

//            if(self::$useTicketingSystem){
//                $panel->resources([
//                    TicketResource::class
//                ]);
//            }

            if (self::$useThemeManager) {
                $panel->pages([
                    Themes::class
                ]);
            }

            if (self::$usePageBuilder) {
                $panel->livewireComponents([
                    BuilderToolbar::class,
                ]);
            }

            $panel->plugin(SpatieLaravelTranslatablePlugin::make()->defaultLocales(self::$defaultLocales));
        }
    }

    public function allowShield(bool $allowShield = true): static
    {
        self::$allowShield = $allowShield;
        return $this;
    }

    public function isShieldAllowed(): bool
    {
        return self::$allowShield;
    }

    public function useFormBuilder(bool $useFormBuilder = true): static
    {
        self::$useFormBuilder = $useFormBuilder;
        return $this;
    }

    //    public function useTicketingSystem(bool $useTicketingSystem=true): static
    //    {
    //        self::$useTicketingSystem = $useTicketingSystem;
    //        return $this;
    //    }

    public function defaultLocales(array $defaultLocales): static
    {
        self::$defaultLocales = $defaultLocales;
        return $this;
    }

    public function usePost(bool $usePost = true): static
    {
        self::$usePost = $usePost;
        return $this;
    }

    public function useCategory(bool $useCategory = true): static
    {
        self::$useCategory = $useCategory;
        return $this;
    }

    public function useThemeManager(bool $useThemeManager = true): static
    {
        self::$useThemeManager = $useThemeManager;
        return $this;
    }

    public function usePageBuilder(bool $usePageBuilder = true): static
    {
        self::$usePageBuilder = $usePageBuilder;
        return $this;
    }


    public function allowExport(bool $allowExport = true): static
    {
        self::$allowExport = $allowExport;
        return $this;
    }

    public function allowImport(bool $allowImport = true): static
    {
        self::$allowImport = $allowImport;
        return $this;
    }


    public function allowUrlImport(bool $allowUrlImport = true): static
    {
        self::$allowUrlImport = $allowUrlImport;
        return $this;
    }

    public function allowBehanceImport(bool $allowBehanceImport = true): static
    {
        self::$allowBehanceImport = $allowBehanceImport;
        return $this;
    }

    public function allowGitHubImport(bool $allowGitHubImport = true): static
    {
        self::$allowGitHubImport = $allowGitHubImport;
        return $this;
    }

    public function allowYoutubeImport(bool $allowYoutubeImport = true): static
    {
        self::$allowYoutubeImport = $allowYoutubeImport;
        return $this;
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
