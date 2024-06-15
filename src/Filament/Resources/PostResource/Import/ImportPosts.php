<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Import;

use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Models\Import;
use TomatoPHP\FilamentCms\Models\Post;

class ImportPosts extends Importer
{
    protected static ?string $model = Post::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('title')
                ->label(trans('filament-cms::messages.content.posts.sections.post.columns.title'))
                ->rules(['required', 'max:255']),
            ImportColumn::make('short_description')
                ->label(trans('filament-cms::messages.content.posts.sections.seo.columns.short_description'))
                ->rules(['nullable', 'max:255']),
            ImportColumn::make('slug')
                ->label(trans('filament-cms::messages.content.posts.sections.post.columns.slug'))
                ->rules(['required', 'max:255', 'unique:posts,slug']),
            ImportColumn::make('type')
                ->label(trans('filament-cms::messages.content.posts.sections.status.columns.type'))
                ->rules(['required', 'max:255']),
            ImportColumn::make('body')
                ->label(trans('filament-cms::messages.content.posts.sections.post.columns.body'))
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): ?Post
    {
        return Post::firstOrNew([
            'title' => $this->data['title'],
            'short_description' => $this->data['short_description'],
            'slug' => $this->data['slug'],
            'type' => $this->data['type'],
            'body' => $this->data['body']
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your post import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
