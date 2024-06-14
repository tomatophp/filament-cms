<?php

namespace TomatoPHP\FilamentCms\Filament\Resources;

use TomatoPHP\FilamentCms\Filament\Resources\FormOptionResource\Pages;
use TomatoPHP\FilamentCms\Filament\Resources\FormOptionResource\RelationManagers;
use TomatoPHP\FilamentCms\Models\FormOption;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormOptionResource extends Resource
{
    protected static ?string $model = FormOption::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('form_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('type')
                    ->maxLength(255)
                    ->default('text'),
                Forms\Components\TextInput::make('label'),
                Forms\Components\TextInput::make('placeholder'),
                Forms\Components\TextInput::make('hint'),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('group')
                    ->maxLength(255),
                Forms\Components\TextInput::make('default'),
                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_required'),
                Forms\Components\Toggle::make('is_multi'),
                Forms\Components\TextInput::make('required_message'),
                Forms\Components\Toggle::make('is_reactive'),
                Forms\Components\TextInput::make('reactive_field')
                    ->maxLength(255),
                Forms\Components\TextInput::make('reactive_where')
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_relation'),
                Forms\Components\TextInput::make('relation_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('relation_column')
                    ->maxLength(255),
                Forms\Components\Toggle::make('has_options'),
                Forms\Components\TextInput::make('options'),
                Forms\Components\Toggle::make('has_validation'),
                Forms\Components\TextInput::make('validation'),
                Forms\Components\TextInput::make('meta'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('form_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('group')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_required')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_multi')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_reactive')
                    ->boolean(),
                Tables\Columns\TextColumn::make('reactive_field')
                    ->searchable(),
                Tables\Columns\TextColumn::make('reactive_where')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_relation')
                    ->boolean(),
                Tables\Columns\TextColumn::make('relation_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('relation_column')
                    ->searchable(),
                Tables\Columns\IconColumn::make('has_options')
                    ->boolean(),
                Tables\Columns\IconColumn::make('has_validation')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFormOptions::route('/'),
            'create' => Pages\CreateFormOption::route('/create'),
            'edit' => Pages\EditFormOption::route('/{record}/edit'),
        ];
    }
}
