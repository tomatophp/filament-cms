<?php

namespace TomatoPHP\FilamentCms\Jobs;

use Filament\Notifications\Actions\Action;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
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
                    $post->save();

                    $post->meta('github_starts', $github['stargazers_count']);
                    $post->meta('github_watchers', $github['watchers_count']);
                    $post->meta('github_language', $github['language']);
                    $post->meta('github_forks', $github['forks_count']);
                    $post->meta('github_open_issues', $github['open_issues_count']);
                    $post->meta('github_default_branch', $github['default_branch']);
                    $post->meta('github_docs', $github['homepage']);
                }
            }
        }

    }

}
