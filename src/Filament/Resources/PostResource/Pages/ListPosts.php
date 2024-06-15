<?php

namespace TomatoPHP\FilamentCms\Filament\Resources\PostResource\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Notifications\Notification;
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
    use ListRecords\Concerns\Translatable;

    #[Reactive]
    public ?string $activeLocale = null;

    public static function getTranslatableLocales(): array
    {
        return ['en', 'ar'];
    }

    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        $options = [];
        $icons = [];
        $colors = [];

        if(filament('filament-cms')->allowGitHubImport){
            $options["open-source"] = trans('filament-cms::messages.content.posts.import.github_type');
            $icons["open-source"] = "heroicon-o-code-bracket-square";
            $colors["open-source"] = "success";
        }
        if(filament('filament-cms')->allowBehanceImport) {
            $options["portfolio"] = trans('filament-cms::messages.content.posts.import.behance_type');
            $icons["portfolio"] = "heroicon-o-photo";
            $colors["portfolio"] = "warning";
        }

        if(config('filament-cms.youtube_key') && filament('filament-cms')->allowYoutubeImport){
            $options["video"] = trans('filament-cms::messages.content.posts.import.youtube_type');
            $icons["video"] = "heroicon-o-video-camera";
            $colors["video"] = "primary";
        }

        return [
            Actions\Action::make('import_from_url')
                ->hidden(!filament('filament-cms')->allowUrlImport)
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
                    TextInput::make('url')
                        ->label(trans('filament-cms::messages.content.posts.import.url'))
                        ->url()
                        ->required(),
                    TextInput::make('redirect_url')
                        ->label(trans('filament-cms::messages.content.posts.import.redirect_url'))
                        ->url(),
                ])
                ->action(function (array $data){
                    if($data['type'] === 'open-source' && $data['url']){
                        dispatch(new GitHubMetaGetterJob(
                            url: $data['url'],
                            redirect: $data['redirect_url'],
                            userId: auth()->user()->id,
                            userType: get_class(auth()->user()),
                            panel: filament()->getCurrentPanel()->getId()
                        ));
                    }

                    if($data['type'] === 'video' && $data['url']){
                        dispatch(new YoutubeMetaGetterJob(
                            url: $data['url'],
                            redirect: $data['redirect_url'],
                            userId:auth()->user()->id,
                            userType:get_class(auth()->user()),
                            panel: filament()->getCurrentPanel()->getId()
                        ));
                    }

                    if($data['type'] === 'portfolio' && $data['url']){
                        dispatch(new BehanceMetaGetterJob(
                            url: $data['url'],
                            userId: auth()->user()->id,
                            userType: get_class(auth()->user()),
                            panel: filament()->getCurrentPanel()->getId()
                        ));
                    }

                    Notification::make()
                        ->title(trans('filament-cms::messages.content.posts.import.notifications.title'))
                        ->body(trans('filament-cms::messages.content.posts.import.notifications.description'))
                        ->success()
                        ->send();
                }),
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make()
        ];
    }
}
