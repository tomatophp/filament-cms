<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Actions;

use Filament\Actions;
use Illuminate\Support\Facades\Event;
use TomatoPHP\FilamentCms\Events\PostDeleted;
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\Action;
use TomatoPHP\FilamentCms\Models\Post;

class DeleteAction extends Action
{
    public static function make(): Actions\Action
    {
        return Actions\DeleteAction::make()
            ->before(fn (Post $record) => Event::dispatch(new PostDeleted($record->toArray())));
    }
}
