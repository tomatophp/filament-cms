<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Pages;

use Filament\Resources\Pages\ViewRecord;
use TomatoPHP\FilamentCms\Facades\FilamentCMS;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource;

class ViewPost extends ViewRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return FilamentCMS::getPostActions(self::class);
    }
}
