<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Event;
use TomatoPHP\FilamentCms\Events\PostCreated;
use TomatoPHP\FilamentCms\Facades\FilamentCMS;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource;

use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;

class CreatePost extends CreateRecord
{

    use Translatable;

    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return array_merge(
            FilamentCMS::getPostActions(self::class),
            [
                LocaleSwitcher::make(),
            ]
        );
    }

    public function afterCreate()
    {
        Event::dispatch(new PostCreated($this->getRecord()->toArray()));
    }
}
