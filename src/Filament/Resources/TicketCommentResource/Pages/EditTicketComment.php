<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\TicketCommentResource\Pages;

use TomatoPHP\FilamentCms\Filament\Resources\TicketCommentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTicketComment extends EditRecord
{
    protected static string $resource = TicketCommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
