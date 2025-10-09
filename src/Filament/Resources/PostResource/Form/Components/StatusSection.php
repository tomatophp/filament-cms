<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\Components;

use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Support\Str;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\Component;
use TomatoPHP\FilamentCms\Models\Category;

class StatusSection extends Component
{
    public static function make(): \Filament\Schemas\Components\Component
    {
        return Section::make(trans('filament-cms::messages.content.posts.sections.status.title'))
            ->description(trans('filament-cms::messages.content.posts.sections.status.description'))
            ->schema([
                Forms\Components\Select::make('categories')
                    ->hidden(fn (Get $get) => in_array($get('type'), ['page', 'builder']))
                    ->relationship('categories', 'name')
                    ->label(trans('filament-cms::messages.content.posts.sections.status.columns.categories'))
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->required(),
                    ])
                    ->createOptionUsing(function (array $data) {
                        $category = Category::query()->create([
                            'name' => $data['name'],
                            'slug' => Str::of($data['name'])->replace(' ', '-')->lower()->toString(),
                            'for' => 'post',
                            'type' => 'category',
                        ]);

                        return $category->id;
                    })
                    ->editOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->required(),
                    ])
                    ->searchable()
                    ->multiple()
                    ->preload()
                    ->options(fn (Get $get) => Category::where('for', $get('type'))->where('type', 'category')->pluck('name', 'id')->toArray()),
                Forms\Components\Select::make('tags')
                    ->hidden(fn (Get $get) => $get('type') !== 'post')
                    ->label(trans('filament-cms::messages.content.posts.sections.status.columns.tags'))
                    ->searchable()
                    ->multiple()
                    ->preload()
                    ->relationship('tags', 'name')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->required(),
                    ])
                    ->createOptionUsing(function (array $data) {
                        $category = Category::query()->create([
                            'name' => $data['name'],
                            'slug' => Str::of($data['name'])->replace(' ', '-')->lower()->toString(),
                            'for' => 'post',
                            'type' => 'tag',
                        ]);

                        return $category->id;
                    })
                    ->editOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->required(),
                    ])
                    ->options(Category::where('for', 'post')->where('type', 'tag')->pluck('name', 'id')->toArray()),
                Forms\Components\Toggle::make('is_published')
                    ->label(trans('filament-cms::messages.content.posts.sections.status.columns.is_published'))
                    ->default(true)
                    ->required(),
                Forms\Components\Toggle::make('is_trend')
                    ->hidden(fn (Get $get) => in_array($get('type'), ['page', 'builder']))
                    ->label(trans('filament-cms::messages.content.posts.sections.status.columns.is_trend'))
                    ->required(),
                Forms\Components\DateTimePicker::make('published_at')
                    ->hidden(fn (Get $get) => in_array($get('type'), ['page', 'builder']))
                    ->label(trans('filament-cms::messages.content.posts.sections.status.columns.published_at'))
                    ->default(now()->format('Y-m-d H:i:s')),
            ]);
    }
}
