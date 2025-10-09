<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Event;
use TomatoPHP\FilamentCms\Events\PostDeleted;
use TomatoPHP\FilamentCms\Facades\FilamentCMS;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource;
use TomatoPHP\FilamentCms\Models\Post;

class ViewPost extends ViewRecord
{

    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return FilamentCMS::getPostActions(self::class);
    }
}
