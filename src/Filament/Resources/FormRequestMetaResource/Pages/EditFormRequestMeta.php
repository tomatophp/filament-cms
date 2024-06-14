<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\FormRequestMetaResource\Pages;

use TomatoPHP\FilamentCms\Filament\Resources\FormRequestMetaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormRequestMeta extends EditRecord
{
    protected static string $resource = FormRequestMetaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
