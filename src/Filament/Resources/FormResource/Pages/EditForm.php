<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\FormResource\Pages;

use TomatoPHP\FilamentCms\Filament\Resources\FormResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditForm extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = FormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make()
        ];
    }
}
