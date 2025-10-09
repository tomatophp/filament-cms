<?php

return [
    /*
    * Custom Resource
    *
    * to custom resource classes
    */
    'resources' => [
        'post' => [
            'table' => [
                'class' => \TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\PostTable::class,
                'filters' => \TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\PostFilters::class,
                'actions' => \TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\PostActions::class,
                'bulkActions' => \TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\PostBulkActions::class,
                'headerActions' => \TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\PostHeaderActions::class,
            ],
            'form' => [
                'class' => \TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\PostForm::class,
            ],
            'infolist' => [
                'class' => \TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\PostInfoList::class,
            ],
        ],
        'category' => [
            'table' => [
                'class' => \TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\CategoryTable::class,
                'filters' => \TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\CategoryFilters::class,
                'actions' => \TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\CategoryActions::class,
                'bulkActions' => \TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\CategoryBulkActions::class
            ],
            'form' => [
                'class' => \TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Form\CategoryForm::class,
            ]
        ]
    ],
];
