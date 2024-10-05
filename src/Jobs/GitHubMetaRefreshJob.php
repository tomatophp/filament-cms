<?php

namespace TomatoPHP\FilamentCms\Jobs;

use Filament\Notifications\Actions\Action;
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

class GitHubMetaRefreshJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $posts = Post::query()->where('type', 'open-source')->whereNotNull('meta_url')->get();
        foreach ($posts as $post){
            $user = $post->author_type::find($post->author_id);
            $repo = Str::of($post->meta_url)->remove('https://github.com/', '')->remove('https://www.github.com/','')->toString();
            $github = Http::get('https://api.github.com/repos/' . $repo)->json();
            if(isset($github['id'])){
                $gitReadme  = Http::get('https://raw.githubusercontent.com/'.$repo.'/'.$github['default_branch'].'/README.md')->body();
                $packgiest = Http::get('https://packagist.org/packages/'.$github['full_name'].'.json')->json();
                if($gitReadme){
                    $post->body = [
                        "ar" => $gitReadme,
                        "en" => $gitReadme
                    ];
                    $post->short_description = [
                        "ar" => $github['description'],
                        "en" => $github['description']
                    ];
                    $post->meta = $github;
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


                    Event::dispatch(new PostUpdated($post->toArray()));
                }
            }
        }

    }

}
