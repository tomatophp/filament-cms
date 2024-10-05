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
use TomatoPHP\FilamentCms\Models\Post;

class YoutubeMetaGetterJob implements ShouldQueue
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
        $user = $this->userType::find($this->userId);
        if(config('filament-cms.youtube_key')){
            $videoID = Str::of($this->url)->replace('https://www.youtube.com/watch?v=', '')->replace('https://youtu.be/', '')->toString();
            $youtube = Http::get('https://www.googleapis.com/youtube/v3/videos?part=player&id='.$videoID.'&key='.config('filament-cms.youtube_key').'&part=snippet,contentDetails,statistics,status')->json();

            if(isset($youtube['items']) && count($youtube['items'])){
                $checkIfPostExists = Post::query()->withTrashed()->where('slug', $videoID)->first();
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
                    "ar" => $youtube['items'][0]['snippet']['title'],
                    "en" => $youtube['items'][0]['snippet']['title']
                ];
                $post->body = [
                    "ar" => $youtube['items'][0]['player']['embedHtml'] ."\n". $youtube['items'][0]['snippet']['description'],
                    "en" => $youtube['items'][0]['player']['embedHtml'] ."\n". $youtube['items'][0]['snippet']['description'],
                ];
                $post->short_description = [
                    "ar" => Str::of($youtube['items'][0]['snippet']['description'])->limit(100)->toString(),
                    "en" => Str::of($youtube['items'][0]['snippet']['description'])->limit(100)->toString()
                ];
                $post->slug = $videoID;
                $post->meta = $youtube;
                $post->meta_url = $this->url;
                $post->type = 'video';
                $post->is_published = true;
                $post->keywords = implode(',', $youtube['items'][0]['snippet']['tags']);
                $post->published_at = now();
                $post->author_type = $this->userType;
                $post->author_id = $this->userId;
                $post->save();

                $post->meta('youtube_views', $youtube['items'][0]['statistics']['viewCount']);
                $post->meta('youtube_likes', $youtube['items'][0]['statistics']['likeCount']);
                $post->meta('youtube_comments', $youtube['items'][0]['statistics']['commentCount']);

                $post->addMediaFromUrl($youtube['items'][0]['snippet']['thumbnails']['maxres']['url'])->toMediaCollection('feature_image');

                Event::dispatch(new PostCreated($post->toArray()));

                Notification::make()
                    ->title(trans('filament-cms::messages.content.posts.import.youtube.notifications.title'))
                    ->body(trans('filament-cms::messages.content.posts.import.youtube.notifications.description', ['name' => $post->title]))
                    ->success()
                    ->actions([
                        Action::make('view')
                            ->label(trans('filament-cms::messages.content.posts.import.youtube.notifications.view'))
                            ->url($this->panel. '/posts/'.$post->id.'/edit')
                            ->icon('heroicon-o-eye')
                    ])
                    ->sendToDatabase($user);
            }
            else {
                Notification::make()
                    ->title(trans('filament-cms::messages.content.posts.import.youtube.notifications.failed_title'))
                    ->body(trans('filament-cms::messages.content.posts.import.youtube.notifications.failed_description', ['name' => $this->url]))
                    ->danger()
                    ->sendToDatabase($user);
            }

        }
    }
}
