<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\RelationManagers;

use App\Models\User;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use TomatoPHP\FilamentCms\Models\Comment;
use TomatoPHP\FilamentCms\Models\Post;
use TomatoPHP\FilamentCms\Services\FilamentCMSAuthors;

class PostCommentsRelation extends RelationManager
{
    protected static string $relationship = 'comments';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return trans('filament-cms::messages.content.comments.title');
    }

    /**
     * @return string|null
     */
    public static function getLabel(): ?string
    {
        return trans('filament-cms::messages.content.comments.title');
    }

    /**
     * @return string|null
     */
    public static function getModelLabel(): ?string
    {
        return trans('filament-cms::messages.content.comments.single');
    }


    /**
     * @return string|null
     */
    public static function getPluralLabel(): ?string
    {
        return trans('filament-cms::messages.content.comments.title');
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_type')
                    ->label(trans('filament-cms::messages.content.comments.columns.user_type'))
                    ->options(count(FilamentCMSAuthors::getOptions()) ? FilamentCMSAuthors::getOptions()->pluck('name', 'model')->toArray() : [User::class => 'Users'])
                    ->afterStateUpdated(fn(Forms\Get $get, Forms\Set $set)=> $set('user_id', null))
                    ->preload()
                    ->live()
                    ->searchable(),
                Forms\Components\Select::make('user_id')
                    ->label(trans('filament-cms::messages.content.comments.columns.user_id'))
                    ->options(fn(Forms\Get $get)=> $get('user_type') ? $get('user_type')::pluck('name', 'id')->toArray() : [])
                    ->searchable(),
                Forms\Components\Textarea::make('comment')
                    ->label(trans('filament-cms::messages.content.comments.columns.comment'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\ToggleButtons::make('rate')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                    ])
                    ->icons([
                        '1' => 'heroicon-s-star',
                        '2' => 'heroicon-s-star',
                        '3' => 'heroicon-s-star',
                        '4' => 'heroicon-s-star',
                        '5' => 'heroicon-s-star',
                    ])
                    ->inline()
                    ->label(trans('filament-cms::messages.content.comments.columns.rate'))
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Tables\Actions\CreateAction::make()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label(trans('filament-cms::messages.content.comments.columns.user_id')),
                Tables\Columns\TextColumn::make('comment')
                    ->label(trans('filament-cms::messages.content.comments.columns.comment'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('rate')
                    ->label(trans('filament-cms::messages.content.comments.columns.rate'))
                    ->view('filament-cms::components.tables.columns.rate')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label(trans('filament-cms::messages.content.comments.columns.is_active'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(trans('filament-cms::messages.content.comments.columns.created_at'))
                    ->description(fn(Comment $comment)=> $comment->created_at->diffForHumans())
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(trans('filament-cms::messages.content.comments.columns.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
            ])
            ->filters([
                Tables\Filters\Filter::make('user_id')
                    ->label(trans('filament-cms::messages.content.comments.columns.user_id'))
                    ->form([
                        Forms\Components\Select::make('user_type')
                            ->label(trans('filament-cms::messages.content.comments.columns.user_type'))
                            ->options(count(FilamentCMSAuthors::getOptions()) ? FilamentCMSAuthors::getOptions()->pluck('name', 'model')->toArray() : [User::class => 'Users'])
                            ->afterStateUpdated( fn(Forms\Get $get, Forms\Set $set)=> $set('user_id', null))
                            ->live()
                            ->searchable(),
                        Forms\Components\Select::make('user_id')
                            ->label(trans('filament-cms::messages.content.comments.columns.user_id'))
                            ->hidden(fn(Forms\Get $get)=> !$get('user_type'))
                            ->disabled(fn(Forms\Get $get)=> !$get('user_type'))
                            ->options(fn(Forms\Get $get)=> $get('user_type') ? $get('user_type')::pluck('name', 'id')->toArray() : [])
                            ->searchable(),
                    ])
                    ->query(function (Builder $query, array $data){
                        return $query
                            ->when(
                                $data['user_type'],
                                fn (Builder $query, $type): Builder => $query->where('user_type', $type),
                            )
                            ->when(
                                $data['user_id'],
                                fn (Builder $query, $id): Builder => $query->where('user_id', $id),
                            );
                    }),
            ]);
    }
}
