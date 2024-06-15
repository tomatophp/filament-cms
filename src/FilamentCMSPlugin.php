<?php

namespace TomatoPHP\FilamentCms;

use Filament\Contracts\Plugin;
use Filament\Panel;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource;


class FilamentCMSPlugin implements Plugin
{
    public bool $allowUrlImport = true;
    public bool $allowBehanceImport = false;
    public bool $allowGitHubImport = true;
    public bool $allowYoutubeImport = false;
    public bool $allowExport = true;
    public bool $allowImport = true;


    public function getId(): string
    {
        return 'filament-cms';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            CategoryResource::class,
            PostResource::class,
        ]);
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

    public function allowGitHubImport(bool $allowBehanceImport = true): static
    {
        $this->allowGitHubImport = $allowBehanceImport;
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
