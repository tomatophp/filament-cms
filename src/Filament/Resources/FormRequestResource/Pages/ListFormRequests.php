<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\FormRequestResource\Pages;

use TomatoPHP\FilamentCms\Filament\Resources\FormRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormRequests extends ListRecords
{
    protected static string $resource = FormRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
