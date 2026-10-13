<?php

use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Form\CategoryForm;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\CategoryActions;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\CategoryBulkActions;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\CategoryFilters;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\CategoryTable;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\PostForm;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\PostInfoList;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\PostActions;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\PostBulkActions;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\PostFilters;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\PostHeaderActions;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\PostTable;

return [
    /*
    * Custom Resource
    *
    * to custom resource classes
    */
    'resources' => [
        'post' => [
            'table' => [
                'class' => PostTable::class,
                'filters' => PostFilters::class,
                'actions' => PostActions::class,
                'bulkActions' => PostBulkActions::class,
                'headerActions' => PostHeaderActions::class,
            ],
            'form' => [
                'class' => PostForm::class,
            ],
            'infolist' => [
                'class' => PostInfoList::class,
            ],
        ],
        'category' => [
            'table' => [
                'class' => CategoryTable::class,
                'filters' => CategoryFilters::class,
                'actions' => CategoryActions::class,
                'bulkActions' => CategoryBulkActions::class,
            ],
            'form' => [
                'class' => CategoryForm::class,
            ],
        ],
    ],
];
