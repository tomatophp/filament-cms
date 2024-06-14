<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostMetaResource\Pages;

use TomatoPHP\FilamentCms\Filament\Resources\PostMetaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPostMeta extends EditRecord
{
    protected static string $resource = PostMetaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
