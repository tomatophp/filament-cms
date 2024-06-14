<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostMetaResource\Pages;

use TomatoPHP\FilamentCms\Filament\Resources\PostMetaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPostMetas extends ListRecords
{
    protected static string $resource = PostMetaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
