<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\Components;

use Filament\Forms;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\Component;

class BodySection extends Component
{
    public static function make(): \Filament\Schemas\Components\Component
    {
        return Forms\Components\MarkdownEditor::make('body')
            ->label(trans('filament-cms::messages.content.posts.sections.post.columns.body'))
            ->toolbarButtons([
                'attachFiles',
                'blockquote',
                'bold',
                'bulletList',
                'codeBlock',
                'heading',
                'italic',
                'link',
                'orderedList',
                'redo',
                'strike',
                'table',
                'undo',
            ])
            ->columnSpanFull();
    }
}
