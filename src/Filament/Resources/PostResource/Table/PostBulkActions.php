<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table;

use Filament\Actions;
use Filament\Forms;
use Filament\Notifications\Notification;
use Illuminate\Support\Collection;
use TomatoPHP\FilamentCms\Models\Category;

class PostBulkActions
{
    protected static array $actions = [];

    public static function make(): array
    {
        return [
            Actions\BulkActionGroup::make(self::getActions()),
        ];
    }

    private static function getDefaultActions(): array
    {
        return [
            Actions\DeleteBulkAction::make(),
            Actions\ForceDeleteBulkAction::make(),
            Actions\RestoreBulkAction::make(),
            Actions\BulkAction::make('category')
                ->label(trans('filament-cms::messages.content.posts.sections.status.columns.categories'))
                ->icon('heroicon-o-rectangle-stack')
                ->form([
                    Forms\Components\Select::make('categories')
                        ->label(trans('filament-cms::messages.content.posts.sections.status.columns.categories'))
                        ->searchable()
                        ->multiple()
                        ->options(Category::query()->where('for', 'post')->where('type', 'category')->pluck('name', 'id')->toArray()),
                ])
                ->action(function (Collection $records, array $data) {
                    $records->each(fn ($record) => $record->categories()->sync($data['categories']));

                    Notification::make()
                        ->title('Success')
                        ->body('Posts categories has been changed')
                        ->success()
                        ->send();
                })
                ->deselectRecordsAfterCompletion(),
            Actions\BulkAction::make('publish')
                ->requiresConfirmation()
                ->label(trans('filament-cms::messages.content.posts.sections.status.columns.is_published'))
                ->icon('heroicon-o-check-circle')
                ->action(function (Collection $records) {
                    $records->each(fn ($record) => $record->update(['is_published' => ! $record->is_published]));

                    Notification::make()
                        ->title('Posts Published')
                        ->body('The selected posts have been published.')
                        ->success()
                        ->send();
                })
                ->deselectRecordsAfterCompletion(),
            Actions\BulkAction::make('trend')
                ->requiresConfirmation()
                ->label(trans('filament-cms::messages.content.posts.sections.status.columns.is_trend'))
                ->icon('heroicon-o-arrow-trending-up')
                ->action(function (Collection $records) {
                    $records->each(fn ($record) => $record->update(['is_trend' => ! $record->is_trend]));

                    Notification::make()
                        ->title('Posts Trended')
                        ->body('The selected posts have been trended.')
                        ->success()
                        ->send();
                })
                ->deselectRecordsAfterCompletion(),
        ];
    }

    private static function getActions(): array
    {
        return array_merge(self::getDefaultActions(), self::$actions);
    }

    public static function register(\Filament\Actions\Action | array $action): void
    {
        if (is_array($action)) {
            foreach ($action as $item) {
                if ($item instanceof \Filament\Actions\Action) {
                    self::$actions[] = $item;
                }
            }
        } else {
            self::$actions[] = $action;
        }
    }
}
