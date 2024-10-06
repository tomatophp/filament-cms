<?php

namespace TomatoPHP\FilamentCms\Filament\Resources;

use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Support\Facades\Event;
use TomatoPHP\FilamentCms\Events\PostDeleted;
use TomatoPHP\FilamentCms\Infolists\Components\MarkdownEntry;
use App\Models\User;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Livewire;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Pages;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\RelationManagers;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Export;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Import;
use TomatoPHP\FilamentCms\Models\Category;
use TomatoPHP\FilamentCms\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use TomatoPHP\FilamentCms\Services\FilamentCMSAuthors;
use TomatoPHP\FilamentCms\Services\FilamentCMSTypes;
use TomatoPHP\FilamentCms\Services\FilamentPostAuthors;
use TomatoPHP\FilamentCms\Services\FilamentPostTypes;

class PostResource extends Resource
{
    use Translatable;

    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil';

    public static function getNavigationGroup(): ?string
    {
        return trans('filament-cms::messages.content.group');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('filament-cms::messages.content.posts.title');
    }

    public static function getLabel(): ?string
    {
        return trans('filament-cms::messages.content.posts.single');
    }

    public static function getNavigationLabel(): string
    {
        return trans('filament-cms::messages.content.posts.title');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make([
                    'default' => 1,
                    'sm' => 1,
                    'md' => 6,
                    'lg' => 12,
                ])
                    ->schema([
                        Forms\Components\Section::make(trans('filament-cms::messages.content.posts.sections.type.title'))
                            ->schema([
                                Forms\Components\ToggleButtons::make('type')
                                    ->label(trans('filament-cms::messages.content.posts.sections.type.columns.type'))
                                    ->live()
                                    ->options(FilamentCMSTypes::getOptions()->pluck('label', 'key')->toArray())
                                    ->icons(FilamentCMSTypes::getOptions()->pluck('icon', 'key')->toArray())
                                    ->colors(FilamentCMSTypes::getOptions()->pluck('color', 'key')->toArray())
                                    ->default('post')
                                    ->inline()
                                    ->columnSpanFull()
                                    ->hiddenLabel()
                                    ->required()
                            ])
                            ->columnSpanFull(),
                        Forms\Components\Grid::make()
                            ->schema(
                                [
                                    Forms\Components\Section::make(trans('filament-cms::messages.content.posts.sections.post.title'))
                                        ->description(trans('filament-cms::messages.content.posts.sections.post.description'))
                                        ->schema([
                                            Forms\Components\TextInput::make('title')
                                                ->label(trans('filament-cms::messages.content.posts.sections.post.columns.title'))
                                                ->afterStateUpdated( function(Forms\Get $get, Forms\Set $set){
                                                    if($get('type') !== 'open-source'){
                                                        $set('slug', Str::of($get('title'))->replace(' ', '-')->lower()->toString());
                                                    }
                                                })
                                                ->lazy()
                                                ->required(),
                                            Forms\Components\TextInput::make('slug')
                                                ->label(trans('filament-cms::messages.content.posts.sections.post.columns.slug'))
                                                ->required()
                                                ->maxLength(255),
                                            Forms\Components\MarkdownEditor::make('body')
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
                                                ->columnSpanFull(),
                                        ])
                                        ->columns(2),
                                    Forms\Components\Section::make(trans('filament-cms::messages.content.posts.sections.seo.title'))
                                        ->description(trans('filament-cms::messages.content.posts.sections.seo.description'))
                                        ->schema([
                                            Forms\Components\TextInput::make('short_description')->label(trans('filament-cms::messages.content.posts.sections.seo.columns.short_description')),
                                            Forms\Components\Textarea::make('keywords')->autosize()->label(trans('filament-cms::messages.content.posts.sections.seo.columns.keywords')),
                                        ])
                                ]
                            )
                            ->columnSpan([
                                'sm' => 1,
                                'md' => 4,
                                'lg' => 8,
                            ]),
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Section::make(trans('filament-cms::messages.content.posts.sections.status.title'))
                                    ->description(trans('filament-cms::messages.content.posts.sections.status.description'))
                                    ->schema([
                                        Forms\Components\Select::make('categories')
                                            ->hidden(fn(Forms\Get $get)=> in_array($get('type'), ['page', 'builder']))
                                            ->relationship('categories', 'name')
                                            ->label(trans('filament-cms::messages.content.posts.sections.status.columns.categories'))
                                            ->createOptionForm([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Name')
                                                    ->required()
                                            ])
                                            ->createOptionUsing(function(array $data){
                                                $category = Category::query()->create([
                                                    'name' => $data['name'],
                                                    'slug' => Str::of($data['name'])->replace(' ', '-')->lower()->toString(),
                                                    'for' => 'post',
                                                    'type' => 'category'
                                                ]);

                                                return $category->id;
                                            })
                                            ->editOptionForm([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Name')
                                                    ->required()
                                            ])
                                            ->searchable()
                                            ->multiple()
                                            ->preload()
                                            ->options(fn(Forms\Get $get)=> Category::where('for', $get('type'))->where('type', 'category')->pluck('name', 'id')->toArray()),
                                        Forms\Components\Select::make('tags')
                                            ->hidden(fn(Forms\Get $get)=> $get('type') !== 'post')
                                            ->label(trans('filament-cms::messages.content.posts.sections.status.columns.tags'))
                                            ->searchable()
                                            ->multiple()
                                            ->preload()
                                            ->relationship('tags', 'name')
                                            ->createOptionForm([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Name')
                                                    ->required()
                                            ])
                                            ->createOptionUsing(function(array $data){
                                                $category = Category::query()->create([
                                                    'name' => $data['name'],
                                                    'slug' => Str::of($data['name'])->replace(' ', '-')->lower()->toString(),
                                                    'for' => 'post',
                                                    'type' => 'tag'
                                                ]);

                                                return $category->id;
                                            })
                                            ->editOptionForm([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Name')
                                                    ->required()
                                            ])
                                            ->options(Category::where('for', 'post')->where('type', 'tag')->pluck('name', 'id')->toArray()),
                                        Forms\Components\Toggle::make('is_published')
                                            ->label(trans('filament-cms::messages.content.posts.sections.status.columns.is_published'))
                                            ->default(true)
                                            ->required(),
                                        Forms\Components\Toggle::make('is_trend')
                                            ->hidden(fn(Forms\Get $get)=> in_array($get('type'), ['page', 'builder']))
                                            ->label(trans('filament-cms::messages.content.posts.sections.status.columns.is_trend'))
                                            ->required(),
                                        Forms\Components\DateTimePicker::make('published_at')
                                            ->hidden(fn(Forms\Get $get)=> in_array($get('type'), ['page', 'builder']))
                                            ->label(trans('filament-cms::messages.content.posts.sections.status.columns.published_at'))
                                            ->default(now()->format('Y-m-d H:i:s')),
                                    ]),
                                Forms\Components\Section::make(trans('filament-cms::messages.content.posts.sections.images.title'))
                                    ->description(trans('filament-cms::messages.content.posts.sections.images.description'))
                                    ->schema([
                                        Forms\Components\SpatieMediaLibraryFileUpload::make('feature_image')
                                            ->label(trans('filament-cms::messages.content.posts.sections.images.columns.feature_image'))
                                            ->collection('feature_image')
                                            ->image()
                                            ->maxFiles(1)
                                            ->maxSize(2048)
                                            ->maxWidth(1920),
                                        Forms\Components\SpatieMediaLibraryFileUpload::make('cover_image')
                                            ->label(trans('filament-cms::messages.content.posts.sections.images.columns.cover_image'))
                                            ->collection('cover_image')
                                            ->image()
                                            ->maxFiles(1)
                                            ->maxSize(2048)
                                            ->maxWidth(1920),
                                        Forms\Components\SpatieMediaLibraryFileUpload::make('images')
                                            ->label(trans('filament-cms::messages.content.posts.sections.images.columns.images'))
                                            ->collection('images')
                                            ->multiple()
                                            ->image()
                                            ->maxSize(2048)
                                            ->maxWidth(1920),
                                    ]),
                                Forms\Components\Section::make(trans('filament-cms::messages.content.posts.sections.author.title'))
                                    ->description(trans('filament-cms::messages.content.posts.sections.author.description'))
                                    ->schema([
                                        Forms\Components\Select::make('author_type')
                                            ->label(trans('filament-cms::messages.content.posts.sections.author.columns.author_type'))
                                            ->options(count(FilamentCMSAuthors::getOptions()) ? FilamentCMSAuthors::getOptions()->pluck('name', 'model')->toArray() : [User::class => 'Users'])
                                            ->afterStateUpdated(fn(Forms\Get $get, Forms\Set $set)=> $set('author_id', null))
                                            ->preload()
                                            ->live()
                                            ->searchable(),
                                        Forms\Components\Select::make('author_id')
                                            ->label(trans('filament-cms::messages.content.posts.sections.author.columns.author'))
                                            ->options(fn(Forms\Get $get)=> $get('author_type') ? $get('author_type')::pluck('name', 'id')->toArray() : [])
                                            ->searchable(),
                                    ]),
                                Forms\Components\Section::make(trans('filament-cms::messages.content.posts.sections.meta.title'))
                                    ->visible(fn($record)=> $record && !empty($record->meta_url))
                                    ->description(trans('filament-cms::messages.content.posts.sections.meta.description'))
                                    ->schema([
                                        Forms\Components\TextInput::make('github_starts')
                                            ->disabled()
                                            ->numeric()
                                            ->label(trans('filament-cms::messages.content.posts.sections.meta.columns.github_starts')),
                                        Forms\Components\TextInput::make('github_watchers')
                                            ->disabled()
                                            ->numeric()
                                            ->label(trans('filament-cms::messages.content.posts.sections.meta.columns.github_watchers')),
                                        Forms\Components\TextInput::make('github_forks')
                                            ->disabled()
                                            ->numeric()
                                            ->label(trans('filament-cms::messages.content.posts.sections.meta.columns.github_forks')),
                                        Forms\Components\TextInput::make('downloads_total')
                                            ->disabled()
                                            ->numeric()
                                            ->label(trans('filament-cms::messages.content.posts.sections.meta.columns.downloads_total')),
                                        Forms\Components\TextInput::make('downloads_monthly')
                                            ->disabled()
                                            ->numeric()
                                            ->label(trans('filament-cms::messages.content.posts.sections.meta.columns.downloads_monthly')),
                                        Forms\Components\TextInput::make('downloads_daily')
                                            ->disabled()
                                            ->numeric()
                                            ->label(trans('filament-cms::messages.content.posts.sections.meta.columns.downloads_daily')),
                                    ]),
                            ])
                            ->columnSpan([
                                'sm' => 1,
                                'md' => 2,
                                'lg' => 4,
                            ]),
                    ])

            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make(trans('filament-cms::messages.content.posts.sections.post.title'))
                ->description(trans('filament-cms::messages.content.posts.sections.post.description'))
                ->schema([
                    TextEntry::make('title')
                        ->hiddenLabel()
                        ->size(TextEntrySize::Large),
                    ImageEntry::make('feature_image')
                        ->hiddenLabel()
                        ->default(fn($record) => $record->getFirstMediaUrl('feature_image')),
                    MarkdownEntry::make('body')
                        ->markdown()
                        ->hiddenLabel(),
                ]),
            Grid::make([
                'sm' => 1,
                'md' => 2,
                'lg' => 4,
            ])->schema([
                Section::make(trans('filament-cms::messages.content.posts.sections.status.title'))
                    ->description(trans('filament-cms::messages.content.posts.sections.status.description'))
                    ->schema([
                        TextEntry::make('author.name')
                            ->label(trans('filament-cms::messages.content.posts.sections.author.columns.author'))
                            ->default(fn(Post $post)=> $post->author?->name),
                        TextEntry::make('type')
                            ->label(trans('filament-cms::messages.content.posts.sections.status.columns.type'))
                            ->state(function (Post $post){
                                return FilamentCMSTypes::getOptions()->where('key', $post->type)->first()?->label;
                            })
                            ->color(function (Post $post){
                                return FilamentCMSTypes::getOptions()->where('key', $post->type)->first()?->color;
                            })
                            ->icon(function (Post $post){
                                return FilamentCMSTypes::getOptions()->where('key', $post->type)->first()?->icon;
                            })
                            ->badge()
                    ])->columnSpan(2),
                Section::make(trans('filament-cms::messages.content.posts.sections.seo.title'))
                    ->description(trans('filament-cms::messages.content.posts.sections.seo.description'))
                    ->schema([
                        TextEntry::make('short_description')
                            ->label(trans('filament-cms::messages.content.posts.sections.seo.columns.short_description')),
                        TextEntry::make('keywords')
                            ->label(trans('filament-cms::messages.content.posts.sections.seo.columns.keywords')),
                    ])->columnSpan(2),
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        $importActions = [];
        if(filament('filament-cms')::$allowImport){
            $importActions[] = Tables\Actions\ImportAction::make()->importer(Import\ImportPosts::class);
        }
        if(filament('filament-cms')::$allowExport){
            $importActions[] = Tables\Actions\ExportAction::make()->exporter(Export\ExportPosts::class);
        }
        $table = $table
            ->headerActions($importActions)
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('feature_image')
                    ->label(trans('filament-cms::messages.content.posts.sections.images.columns.feature_image'))
                    ->defaultImageUrl(fn(Post $post)=> 'https://ui-avatars.com/api/?name='.Str::of($post->slug)->replace('-','+').'&color=FFFFFF&background=020617')
                    ->square()
                    ->toggleable()
                    ->collection('feature_image'),
                Tables\Columns\TextColumn::make('title')
                    ->label(trans('filament-cms::messages.content.posts.sections.post.columns.title'))
                    ->description(fn(Post $post)=> Str::of($post->short_description)->limit(50))
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->sortable()
                    ->label(trans('filament-cms::messages.content.posts.sections.status.columns.type'))
                    ->toggleable()
                    ->state(function (Post $post){
                        return FilamentCMSTypes::getOptions()->where('key', $post->type)->first()?->label;
                    })
                    ->color(function (Post $post){
                        return FilamentCMSTypes::getOptions()->where('key', $post->type)->first()?->color;
                    })
                    ->icon(function (Post $post){
                        return FilamentCMSTypes::getOptions()->where('key', $post->type)->first()?->icon;
                    })
                    ->badge()
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('is_published')
                    ->toggleable()
                    ->sortable()
                    ->label(trans('filament-cms::messages.content.posts.sections.status.columns.is_published'))
                    ->onColor('success'),
                Tables\Columns\ToggleColumn::make('is_trend')
                    ->toggleable()
                    ->sortable()
                    ->label(trans('filament-cms::messages.content.posts.sections.status.columns.is_trend'))
                    ->onColor('success'),
                Tables\Columns\TextColumn::make('published_at')
                    ->toggleable()
                    ->label(trans('filament-cms::messages.content.posts.sections.status.columns.published_at'))
                    ->description(fn(Post $post)=> $post->published_at?->diffForHumans())
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('likes')
                    ->toggleable()
                    ->label(trans('filament-cms::messages.content.posts.sections.status.columns.likes'))
                    ->badge()
                    ->color('danger')
                    ->icon('heroicon-s-heart')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('views')
                    ->toggleable()
                    ->label(trans('filament-cms::messages.content.posts.sections.status.columns.views'))
                    ->color('info')
                    ->icon('heroicon-s-arrow-trending-up')
                    ->badge()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('type')
                    ->form([
                        Forms\Components\Select::make('type')
                            ->options(FilamentCMSTypes::getOptions()->pluck('label', 'key')->toArray())
                            ->label('Type')
                            ->searchable(),
                    ])
                    ->query(function (Builder $query, array $data){
                        return $query
                            ->when(
                                $data['type'],
                                fn (Builder $query, $type): Builder => $query->where('type', '>=', $type),
                            );
                    }),
                Tables\Filters\Filter::make('author_id')
                    ->label('Author')
                    ->form([
                        Forms\Components\Select::make('author_type')
                            ->label('Author Type')
                            ->options(count(FilamentCMSAuthors::getOptions()) ? FilamentCMSAuthors::getOptions()->pluck('name', 'model')->toArray() : [User::class => 'Users'])
                            ->afterStateUpdated( fn(Forms\Get $get, Forms\Set $set)=> $set('author_id', null))
                            ->live()
                            ->searchable(),
                        Forms\Components\Select::make('author_id')
                            ->label('Author')
                            ->hidden(fn(Forms\Get $get)=> !$get('author_type'))
                            ->disabled(fn(Forms\Get $get)=> !$get('author_type'))
                            ->options(fn(Forms\Get $get)=> $get('author_type') ? $get('author_type')::pluck('name', 'id')->toArray() : [])
                            ->searchable(),
                    ])
                    ->query(function (Builder $query, array $data){
                        return $query
                            ->when(
                                $data['author_type'],
                                fn (Builder $query, $type): Builder => $query->where('author_type', $type),
                            )
                            ->when(
                                $data['author_id'],
                                fn (Builder $query, $id): Builder => $query->where('author_id', $id),
                            );
                    }),

                Tables\Filters\Filter::make('published_at')
                    ->form([
                        Forms\Components\DatePicker::make('published_at')
                            ->label('Published At'),
                    ])
                    ->query(function (Builder $query, array $data){
                        return $query
                            ->when(
                                $data['published_at'],
                                fn (Builder $query, $publishedAt): Builder => $query->whereDate('published_at', $publishedAt),
                            );
                    }),
                Tables\Filters\Filter::make('is_published')
                    ->form([
                        Forms\Components\Toggle::make('is_published')
                            ->label('Published'),
                    ])
                    ->query(function (Builder $query, array $data){
                        return $query
                            ->when(
                                $data['is_published'],
                                fn (Builder $query, $isPublished): Builder => $query->where('is_published', (bool)$isPublished),
                            );
                    }),
                Tables\Filters\Filter::make('is_trend')
                    ->form([
                        Forms\Components\Toggle::make('is_trend')
                            ->label('Trend'),
                    ])
                    ->query(function (Builder $query, array $data){
                        return $query
                            ->when(
                                $data['is_trend'],
                                fn (Builder $query, $isTrend): Builder => $query->where('is_trend', (bool)$isTrend),
                            );
                    }),

                Tables\Filters\TrashedFilter::make()
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->iconButton()
                    ->tooltip(__('filament-actions::view.single.label')),
                Tables\Actions\EditAction::make()
                    ->iconButton()
                    ->tooltip(__('filament-actions::edit.single.label')),
                Tables\Actions\DeleteAction::make()
                    ->before(fn(Post $record) => Event::dispatch(new PostDeleted($record->toArray())))
                    ->iconButton()
                    ->tooltip(__('filament-actions::delete.single.label')),
                Tables\Actions\ForceDeleteAction::make()
                    ->before(fn(Post $record) => Event::dispatch(new PostDeleted($record->toArray())))
                    ->iconButton()
                    ->tooltip(__('filament-actions::force-delete.single.label')),
                Tables\Actions\RestoreAction::make()
                    ->iconButton()
                    ->tooltip(__('filament-actions::restore.single.label')),
            ])
            ->defaultSort('created_at', 'desc')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\BulkAction::make('category')
                        ->label(trans('filament-cms::messages.content.posts.sections.status.columns.categories'))
                        ->icon('heroicon-o-rectangle-stack')
                        ->form([
                            Forms\Components\Select::make('categories')
                                ->label(trans('filament-cms::messages.content.posts.sections.status.columns.categories'))
                                ->searchable()
                                ->multiple()
                                ->options(Category::query()->where('for', "post")->where('type', 'category')->pluck('name', 'id')->toArray()),
                        ])
                        ->action(function(Collection $records, array $data){
                            $records->each(fn($record) => $record->categories()->sync($data['categories']));

                            Notification::make()
                                ->title('Success')
                                ->body('Posts categories has been changed')
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\BulkAction::make('publish')
                        ->requiresConfirmation()
                        ->label(trans('filament-cms::messages.content.posts.sections.status.columns.is_published'))
                        ->icon('heroicon-o-check-circle')
                        ->action(function(Collection $records){
                            $records->each(fn($record) => $record->update(['is_published' => !$record->is_published]));

                            Notification::make()
                                ->title('Posts Published')
                                ->body('The selected posts have been published.')
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\BulkAction::make('trend')
                        ->requiresConfirmation()
                        ->label(trans('filament-cms::messages.content.posts.sections.status.columns.is_trend'))
                        ->icon('heroicon-o-arrow-trending-up')
                        ->action(function(Collection $records){
                            $records->each(fn($record) => $record->update(['is_trend' => !$record->is_trend]));
                            Notification::make()
                                ->title('Posts Trended')
                                ->body('The selected posts have been trended.')
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion()
                ]),
            ]);

        if(filament('filament-cms')::$usePageBuilder){
            return $table->recordUrl(fn(Post $record): string => $record->type === 'builder' ? url($record->slug) : Pages\ViewPost::getUrl([$record->id]));
        }

        return $table->recordUrl(fn(Post $record): string => Pages\ViewPost::getUrl([$record->id]));
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PostCommentsRelation::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}/show'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
