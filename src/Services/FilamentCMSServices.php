<?php

namespace TomatoPHP\FilamentCms\Services;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Pages\ListCategories;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Pages\ListPosts;

class FilamentCMSServices
{
    private array $postActions = [];
    private array $importActions = [];
    private array $categoryActions = [];
    private array $postRelations = [];
    private array $categoryRelations = [];

    public function registerImportAction(array | Action | ActionGroup $action): void
    {
        if (is_array($action)) {
            foreach ($action as $item) {
                if ($item instanceof Action || $item instanceof ActionGroup) {
                    $this->importActions[] = $item;
                }
            }
        } else {
            $this->importActions[] = $action;
        }

    }

    public function getImportActions(): array
    {
        return $this->importActions;
    }

    public function registerPostAction(array | Action | ActionGroup $action, string $page = ListPosts::class): void
    {
        if (is_array($action)) {
            foreach ($action as $item) {
                if ($item instanceof Action || $item instanceof ActionGroup) {
                    $this->postActions[$page][] = $item;
                }
            }
        } else {
            $this->postActions[$page][] = $action;
        }

    }

    public function getPostActions(string $page = ListPosts::class): array
    {
        return $this->postActions[$page] ?? [];
    }

    public function registerCategoryAction(array | Action $action, string $page = ListCategories::class): void
    {
        if (is_array($action)) {
            foreach ($action as $item) {
                if ($item instanceof Action) {
                    $this->categoryActions[$page][] = $item;
                }
            }
        } else {
            $this->categoryActions[$page][] = $action;
        }

    }

    public function registerPostRelation(array | string $relation): void
    {
        if (is_array($relation)) {
            foreach ($relation as $item) {
                $this->postRelations[] = $item;
            }
        } else {
            $this->postRelations[] = $relation;
        }
    }

    public function getPostRelations(): array
    {
        return $this->postRelations;
    }


    public function registerCategoryRelation(array | string $relation): void
    {
        if (is_array($relation)) {
            foreach ($relation as $item) {
                $this->categoryRelations[] = $item;
            }
        } else {
            $this->categoryRelations[] = $relation;
        }
    }

    public function getCategoryRelations(): array
    {
        return $this->categoryRelations;
    }

    public function getCategoryActions(string $page = ListCategories::class): array
    {
        return $this->categoryActions[$page] ?? [];
    }

    public function types(): FilamentCmsTypes
    {
        return new FilamentCmsTypes;
    }

    public function authors(): FilamentCMSAuthors
    {
        return new FilamentCMSAuthors;
    }
}
