<?php

namespace TomatoPHP\FilamentCms;

use Filament\Contracts\Plugin;
use Filament\Panel;
use TomatoPHP\FilamentCms\Facades\FilamentCMS;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource;

class FilamentCMSPlugin implements Plugin
{
    public static bool $allowContentImport = false;

    public static bool $allowExport = false;

    public static bool $allowImport = false;

    public static bool $usePost = true;

    public static bool $useCategory = true;

    public static array $defaultLocales = ['ar', 'en'];

    public function getId(): string
    {
        return 'filament-cms';
    }

    public function register(Panel $panel): void
    {
        if (self::$usePost) {
            $panel->resources([
                PostResource::class,
            ]);
        }
        if (self::$useCategory) {
            $panel->resources([
                CategoryResource::class,
            ]);
        }

    }


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

    public function allowContentImport(bool $allowContentImport = true): static
    {
        self::$allowContentImport = $allowContentImport;

        return $this;
    }

    public function boot(Panel $panel): void
    {
        FilamentCMS::registerPostAction(PostResource\Actions\CreateAction::make());
        FilamentCMS::registerPostAction(PostResource\Actions\ViewAction::make(), PostResource\Pages\EditPost::class);
        FilamentCMS::registerPostAction(PostResource\Actions\DeleteAction::make(), PostResource\Pages\EditPost::class);
        FilamentCMS::registerPostAction(PostResource\Actions\EditAction::make(), PostResource\Pages\ViewPost::class);
        FilamentCMS::registerPostAction(PostResource\Actions\DeleteAction::make(), PostResource\Pages\ViewPost::class);

        FilamentCMS::registerCategoryAction(CategoryResource\Actions\CreateAction::make());
        FilamentCMS::registerCategoryAction(CategoryResource\Actions\DeleteAction::make(), CategoryResource\Pages\EditCategory::class);

        if(self::$allowContentImport){
            FilamentCMS::registerPostAction(PostResource\Actions\ImportActionGroup::make());
        }
    }

    public static function make(): static
    {
        return new static;
    }
}
