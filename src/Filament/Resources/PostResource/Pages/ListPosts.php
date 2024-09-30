<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Pages;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Notifications\Notification;
use TomatoPHP\FilamentApi\Traits\InteractWithAPI;
use TomatoPHP\FilamentCms\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use TomatoPHP\FilamentCms\Jobs\BehanceMetaGetterJob;
use TomatoPHP\FilamentCms\Jobs\GitHubMetaGetterJob;
use TomatoPHP\FilamentCms\Jobs\YoutubeMetaGetterJob;
use TomatoPHP\FilamentCms\Models\Post;
use TomatoPHP\FilamentCms\Services\FilamentCMSTypes;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        $options = [];
        $icons = [];
        $colors = [];

        if(filament('filament-cms')::$allowGitHubImport){
            $options["open-source"] = trans('filament-cms::messages.content.posts.import.github_type');
            $icons["open-source"] = "heroicon-o-code-bracket-square";
            $colors["open-source"] = "success";
        }
        if(filament('filament-cms')::$allowBehanceImport) {
            $options["portfolio"] = trans('filament-cms::messages.content.posts.import.behance_type');
            $icons["portfolio"] = "heroicon-o-photo";
            $colors["portfolio"] = "warning";
        }

        if(config('filament-cms.youtube_key') && filament('filament-cms')::$allowYoutubeImport){
            $options["video"] = trans('filament-cms::messages.content.posts.import.youtube_type');
            $icons["video"] = "heroicon-o-video-camera";
            $colors["video"] = "primary";
        }

        return [
            Actions\Action::make('import_from_url')
                ->hidden(!filament('filament-cms')::$allowUrlImport)
                ->label(trans('filament-cms::messages.content.posts.import.button'))
                ->icon('heroicon-o-inbox-arrow-down')
                ->form([
                    ToggleButtons::make('type')
                        ->label(trans('filament-cms::messages.content.posts.sections.type.columns.type'))
                        ->live()
                        ->options($options)
                        ->icons($icons)
                        ->colors($colors)
                        ->default('open-source')
                        ->inline()
                        ->columnSpanFull()
                        ->hiddenLabel()
                        ->required(),
                    KeyValue::make('urls')
                        ->required()
                        ->keyLabel(trans('filament-cms::messages.content.posts.import.url'))
                        ->valueLabel(trans('filament-cms::messages.content.posts.import.redirect_url')),
                ])
                ->action(function (array $data){
                    if($data['type'] === 'open-source' && count($data['urls'])){
                        foreach ($data['urls'] as $url=>$redirect){
                            dispatch(new GitHubMetaGetterJob(
                                url: $url,
                                redirect: $redirect,
                                userId: auth()->user()->id,
                                userType: get_class(auth()->user()),
                                panel: filament()->getCurrentPanel()->getId()
                            ));
                        }
                    }

                    if($data['type'] === 'video' && count($data['urls'])){
                        foreach ($data['urls'] as $url=>$redirect) {
                            dispatch(new YoutubeMetaGetterJob(
                                url: $url,
                                redirect: $redirect,
                                userId: auth()->user()->id,
                                userType: get_class(auth()->user()),
                                panel: filament()->getCurrentPanel()->getId()
                            ));
                        }
                    }

                    if($data['type'] === 'portfolio' && count($data['urls'])){
                        foreach ($data['urls'] as $url=>$redirect) {
                            dispatch(new BehanceMetaGetterJob(
                                url: $url,
                                userId: auth()->user()->id,
                                userType: get_class(auth()->user()),
                                panel: filament()->getCurrentPanel()->getId()
                            ));
                        }
                    }

                    Notification::make()
                        ->title(trans('filament-cms::messages.content.posts.import.notifications.title'))
                        ->body(trans('filament-cms::messages.content.posts.import.notifications.description'))
                        ->success()
                        ->send();
                }),
            Actions\CreateAction::make(),
        ];
    }
}
