<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Pages;

use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Event;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\EditRecord\Concerns\Translatable;
use TomatoPHP\FilamentCms\Events\PostUpdated;
use TomatoPHP\FilamentCms\Facades\FilamentCMS;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource;

class EditPost extends EditRecord
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

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['github_starts'] = $this->getRecord()->meta('github_starts');
        $data['github_watchers'] = $this->getRecord()->meta('github_watchers');
        $data['github_forks'] = $this->getRecord()->meta('github_forks');
        $data['downloads_total'] = $this->getRecord()->meta('downloads_total');
        $data['downloads_monthly'] = $this->getRecord()->meta('downloads_monthly');
        $data['downloads_daily'] = $this->getRecord()->meta('downloads_daily');

        return $data;
    }

    public function afterSave()
    {
        Event::dispatch(new PostUpdated($this->getRecord()->toArray()));
    }
}
