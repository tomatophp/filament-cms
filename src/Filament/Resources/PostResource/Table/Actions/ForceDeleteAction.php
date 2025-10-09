<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Actions;

use Filament\Actions;
use Illuminate\Support\Facades\Event;
use TomatoPHP\FilamentCms\Events\PostDeleted;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Action;
use TomatoPHP\FilamentCms\Models\Post;

class ForceDeleteAction extends Action
{
    public static function make(): Actions\Action
    {
        return Actions\ForceDeleteAction::make()
            ->before(fn (Post $record) => Event::dispatch(new PostDeleted($record->toArray())))
            ->iconButton()
            ->tooltip(__('filament-actions::force-delete.single.label'));
    }
}
