<?php

namespace TomatoPHP\FilamentCms\Filament\Pages;

use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\File;
use Filament\Pages\Actions\ButtonAction;
use Nwidart\Modules\Facades\Module;
use TomatoPHP\FilamentCms\Models\Theme;
use TomatoPHP\FilamentCms\Settings\ThemesSettings;

class Themes extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-swatch';

    protected static string $view = 'filament-cms::pages.themes';

    public function getTitle(): string
    {
        return  "Themes";
    }

    public static function getNavigationLabel(): string
    {
        return "Themes";
    }

    public static function getNavigationGroup(): ?string
    {
        return "Content";
    }

    public function disableAction(): Action
    {
        return Action::make('disable')
            ->iconButton()
            ->icon('heroicon-s-x-circle')
            ->color('danger')
            ->tooltip(trans('filament-plugins::messages.plugins.actions.disable'))
            ->requiresConfirmation()
            ->action(function (array $arguments) {
                $module = Module::find($arguments['item']['module_name']);
                $module?->disable();

                $setting = new ThemesSettings();
                $setting->theme_name = null;
                $setting->save();

                Notification::make()
                    ->title(trans('filament-plugins::messages.plugins.notifications.disabled.title'))
                    ->body(trans('filament-plugins::messages.plugins.notifications.disabled.body'))
                    ->success()
                    ->send();

                $this->js('window.location.reload()');
            });
    }

    public function deleteAction(): Action
    {
        return Action::make('delete')
            ->iconButton()
            ->icon('heroicon-s-trash')
            ->color('danger')
            ->tooltip(trans('filament-plugins::messages.plugins.actions.delete'))
            ->requiresConfirmation()
            ->action(function (array $arguments) {
                $module = Module::find($arguments['item']['module_name']);
                $module?->delete();

                Notification::make()
                    ->title(trans('filament-plugins::messages.plugins.notifications.deleted.title'))
                    ->body(trans('filament-plugins::messages.plugins.notifications.deleted.body'))
                    ->success()
                    ->send();

                $this->js('window.location.reload()');
            });
    }


    public function activeAction(): Action
    {
        return Action::make('active')
            ->iconButton()
            ->icon('heroicon-s-check-circle')
            ->tooltip(trans('filament-plugins::messages.plugins.actions.active'))
            ->color('success')
            ->requiresConfirmation()
            ->action(function (array $arguments) {
                if(!class_exists(json_decode($arguments['item']['providers'])[0])){
                    Notification::make()
                        ->title(trans('filament-plugins::messages.plugins.notifications.autoload.title'))
                        ->body(trans('filament-plugins::messages.plugins.notifications.autoload.body'))
                        ->danger()
                        ->send();
                    return;
                }
                $module = Module::find($arguments['item']['module_name']);
                $module?->enable();

                $themes = Theme::all();
                foreach ($themes as $theme){
                    if($theme->module_name != $arguments['item']['module_name']) {
                        $module = Module::find($theme->module_name);
                        $module?->disable();
                    }
                }

                $setting = new ThemesSettings();
                $setting->theme_name = $arguments['item']['module_name'];
                $setting->save();

                Notification::make()
                    ->title(trans('filament-plugins::messages.plugins.notifications.enabled.title'))
                    ->body(trans('filament-plugins::messages.plugins.notifications.enabled.body'))
                    ->success()
                    ->send();

                $this->js('window.location.reload()');

            });
    }



    public function table(Table $table): Table
    {
        return $table
            ->query(Theme::query())
            ->content(function () {
                return view('filament-cms::pages.table');
            })
            ->columns([
                TextColumn::make('name')
                    ->label(trans('filament-plugins::messages.plugins.form.name'))
                    ->searchable(),
            ]);
    }
}
