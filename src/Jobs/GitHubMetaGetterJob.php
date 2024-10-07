<?php

namespace TomatoPHP\FilamentCms\Jobs;

use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use TomatoPHP\FilamentCms\Events\PostCreated;
use TomatoPHP\FilamentCms\Events\PostUpdated;
use TomatoPHP\FilamentCms\Models\Post;

class GitHubMetaGetterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $url,
        public ?string $redirect=null,
        public ?int $userId=null,
        public ?string $userType=null,
        public ?string $panel=null,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try{
            $user = $this->userType::find($this->userId);
            $repo = Str::of($this->url)->remove('https://github.com/', '')->remove('https://www.github.com/','')->toString();
            $github = Http::get('https://api.github.com/repos/' . $repo)->json();
            if(isset($github['id'])){
                $gitReadme  = Http::get('https://raw.githubusercontent.com/'.$repo.'/'.$github['default_branch'].'/README.md')->body();
                $packgiest = Http::get('https://packagist.org/packages/'.$github['full_name'].'.json')->json();
                if($gitReadme){
                    $checkIfPostExists = Post::query()->withTrashed()->where('slug', str($github['full_name'])->explode('/')->last())->first();
                    if($checkIfPostExists){
                        if($checkIfPostExists->deleted_at){
                            $checkIfPostExists->restore();
                        }
                        $checkIfPostExists->clearMediaCollection('feature_image');
                        $post = $checkIfPostExists;
                    }
                    else {
                        $post = new Post();
                    }

                    $post->title = [
                        "ar" => $github['name'],
                        "en" => $github['name']
                    ];
                    $post->body = [
                        "ar" => $gitReadme,
                        "en" => $gitReadme
                    ];
                    $post->short_description = [
                        "ar" => $github['description'],
                        "en" => $github['description']
                    ];
                    $post->slug = str($github['full_name'])->explode('/')->last();
                    $post->meta = $github;
                    $post->meta_url = $this->url;
                    $post->type = 'open-source';
                    $post->is_published = true;
                    $post->published_at = now();
                    $post->author_type = $this->userType;
                    $post->author_id = $this->userId;
                    if(!isset($packgiest['status'])){
                        $post->keywords = [
                            'ar' => implode( ',', collect($packgiest['package']['versions'])->first()['keywords']),
                            'en' => implode( ',', collect($packgiest['package']['versions'])->first()['keywords'])
                        ];
                    }
                    $post->save();

                    if(!isset($packgiest['status'])){
                        $post->meta('downloads_total', $packgiest['package']['downloads']['total']);
                        $post->meta('downloads_monthly', $packgiest['package']['downloads']['monthly']);
                        $post->meta('downloads_daily', $packgiest['package']['downloads']['daily']);
                    }

                    $post->meta('github_starts', $github['stargazers_count']);
                    $post->meta('github_watchers', $github['watchers_count']);
                    $post->meta('github_language', $github['language']);
                    $post->meta('github_forks', $github['forks_count']);
                    $post->meta('github_open_issues', $github['open_issues_count']);
                    $post->meta('github_default_branch', $github['default_branch']);
                    $post->meta('github_docs', $github['homepage']);

                    $post->addMediaFromUrl($github['owner']['avatar_url'])->toMediaCollection('feature_image');


                    Event::dispatch(new PostCreated($post->toArray()));

                    Notification::make()
                        ->title(trans('filament-cms::messages.content.posts.import.github.notifications.title'))
                        ->body(trans('filament-cms::messages.content.posts.import.github.notifications.description', ['name'=> $github['full_name']]))
                        ->success()
                        ->actions([
                            Action::make('view')
                                ->label(trans('filament-cms::messages.content.posts.import.github.notifications.view'))
                                ->url($this->panel. '/posts/'.$post->id.'/edit')
                                ->icon('heroicon-o-eye')
                        ])
                        ->sendToDatabase($user);
                }
            }
            else {
                Notification::make()
                    ->title(trans('filament-cms::messages.content.posts.import.github.notifications.failed_title'))
                    ->body(trans('filament-cms::messages.content.posts.import.github.notifications.failed_description', ['name'=> $repo]))
                    ->danger()
                    ->sendToDatabase($user);
            }
        }catch (\Exception $e) {
            dd($e);
        }

    }
}
