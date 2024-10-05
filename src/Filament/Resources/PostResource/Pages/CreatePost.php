<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Pages;

use Illuminate\Support\Facades\Event;
use TomatoPHP\FilamentCms\Events\PostCreated;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use TomatoPHP\FilamentCms\Jobs\GitHubMetaGetterJob;
use TomatoPHP\FilamentCms\Jobs\YoutubeMetaGetterJob;
use TomatoPHP\FilamentCms\Models\Post;

class CreatePost extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make()
        ];
    }

    public function afterCreate()
    {
        Event::dispatch(new PostCreated($this->getRecord()->toArray()));
    }
}
