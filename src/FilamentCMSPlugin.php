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
    public bool $allowUrlImport = true;
    public bool $allowBehanceImport = false;
    public bool $allowGitHubImport = true;
    public bool $allowYoutubeImport = false;
    public bool $allowExport = true;
    public bool $allowImport = true;
    public bool $usePost = false;
    public bool $useCategory = false;
    public bool $useThemeManager = false;
    public bool $usePageBuilder = false;
    public bool $useFormBuilder = false;
    //    public bool $useTicketingSystem = false;
    public array $defaultLocales = ['ar', 'en'];

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

            if ($this->usePost) {
                $panel->resources([
                    PostResource::class
                ]);
            }
            if ($this->useCategory) {
                $panel->resources([
                    CategoryResource::class
                ]);
            }

            if ($this->useFormBuilder) {
                $panel->resources([
                    FormResource::class
                ]);
            }

            //        if($this->useTicketingSystem){
            //            $panel->resources([
            //                TicketResource::class
            //            ]);
            //        }

            if ($this->useThemeManager) {
                $panel->pages([
                    Themes::class
                ]);
            }

            if ($this->usePageBuilder) {
                $panel->livewireComponents([
                    BuilderToolbar::class,
                ]);
            }

            $panel->plugin(SpatieLaravelTranslatablePlugin::make()->defaultLocales($this->defaultLocales));
        }
    }

    public function useFormBuilder(bool $useFormBuilder = true): static
    {
        $this->useFormBuilder = $useFormBuilder;
        return $this;
    }

    //    public function useTicketingSystem(bool $useTicketingSystem=true): static
    //    {
    //        $this->useTicketingSystem = $useTicketingSystem;
    //        return $this;
    //    }

    public function defaultLocales(array $defaultLocales): static
    {
        $this->defaultLocales = $defaultLocales;
        return $this;
    }

    public function usePost(bool $usePost = true): static
    {
        $this->usePost = $usePost;
        return $this;
    }

    public function useCategory(bool $useCategory = true): static
    {
        $this->useCategory = $useCategory;
        return $this;
    }

    public function useThemeManager(bool $useThemeManager = true): static
    {
        $this->useThemeManager = $useThemeManager;
        return $this;
    }

    public function usePageBuilder(bool $usePageBuilder = true): static
    {
        $this->usePageBuilder = $usePageBuilder;
        return $this;
    }


    public function allowExport(bool $allowExport = true): static
    {
        $this->allowExport = $allowExport;
        return $this;
    }

    public function allowImport(bool $allowImport = true): static
    {
        $this->allowImport = $allowImport;
        return $this;
    }


    public function allowUrlImport(bool $allowUrlImport = true): static
    {
        $this->allowUrlImport = $allowUrlImport;
        return $this;
    }

    public function allowBehanceImport(bool $allowBehanceImport = true): static
    {
        $this->allowBehanceImport = $allowBehanceImport;
        return $this;
    }

    public function allowGitHubImport(bool $allowGitHubImport = true): static
    {
        $this->allowGitHubImport = $allowGitHubImport;
        return $this;
    }

    public function allowYoutubeImport(bool $allowYoutubeImport = true): static
    {
        $this->allowYoutubeImport = $allowYoutubeImport;
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
