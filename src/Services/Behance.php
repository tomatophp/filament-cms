<?php

namespace TomatoPHP\FilamentCms\Services;

use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use TomatoPHP\FilamentCms\Browser\Actions\CreateBrowser;
use TomatoPHP\FilamentCms\Browser\Chrome;
use Facebook\WebDriver\WebDriverBy;
use Illuminate\Support\Facades\Log;
use Laravel\Dusk\Browser;
use TomatoPHP\FilamentCms\Events\PostCreated;
use TomatoPHP\FilamentCms\Models\Portfolio;
use TomatoPHP\FilamentCms\Models\Post;

class Behance
{
    /**
     * @var Chrome|null
     */
    private Chrome|null $dusk;


    public function __construct(
        private ?string $username=null,
        private ?string $url=null,
        public ?int $userId=null,
        public ?string $userType=null,
        public ?string $panel=null,
        private ?string $type='web',
    )
    {
        $browser = new CreateBrowser($this->type);
        $this->dusk = $browser->dusk();
    }

    /**
     * @return void
     * @throws \Throwable
     */
    public function run(): void
    {
        $data = [
            "userType" => $this->userType,
            "userId" => $this->userId,
            "username" => $this->username,
            "url" => $this->url,
        ];
        $this->dusk->browse(function (Browser $browser) use ($data){
            try {
                $projectsList = [];
                $user = $data['userType']::find($data['userId']);
                if($data['username']){
                    $browser->visit('https://www.behance.net/' . $data['username']);
                    $browser->pause(2000);
                    $count = 1200;
                    for($i=0;$i<6; $i++){
                        $browser->script('window.scrollTo(0, '.$count.');');
                        $browser->pause(2000);
                        $count+=1200;
                    }
                    $browser->pause(2000);

                    $projectsList = $browser->script("
                        let projectArray = document.querySelectorAll('.ProjectCoverNeue-root-B1h');
                        let projectListArray= [];
                        for(let i=0; i<projectArray.length; i++){
                            let project = {
                                name: projectArray[i].querySelectorAll('a')[1].innerText,
                                views: projectArray[i].querySelectorAll('.Stats-stats-Q1s')[0].querySelectorAll('span')[1].innerText,
                                cover: projectArray[i].querySelectorAll('.Cover-content-yv3 picture img')[0].src,
                                url: projectArray[i].querySelectorAll('a')[0].href,
                            }

                            projectListArray.push(project);
                        }
                        return projectListArray;
                    ")[0];
                }
                if(count($projectsList)){
                    try {
                        foreach($projectsList as $project){
                            $this->getProjectByURL($browser,$project['url'], $data);
                        }
                    }catch (\Exception $e) {
                        Log::error($e);

                        Notification::make()
                            ->title('Behance Portfolio import failed')
                            ->body('Behance Portfolio import failed')
                            ->error()
                            ->sendToDatabase($user);
                    }
                }
                else {
                    try {
                        $this->getProjectByURL($browser,$data['url'], $data);
                    }catch (\Exception $e) {
                        Log::error($e);

                        Notification::make()
                            ->title(trans('filament-cms::messages.content.posts.import.behance.notifications.failed_title'))
                            ->body(trans('filament-cms::messages.content.posts.import.behance.notifications.failed_description'))
                            ->danger()
                            ->sendToDatabase($user);
                    }
                }

                $browser->driver->quit();
                Notification::make()
                    ->title(trans('filament-cms::messages.content.posts.import.behance.notifications.title'))
                    ->body(trans('filament-cms::messages.content.posts.import.behance.notifications.description', ['name' => $data['url']]))
                    ->success()
                    ->sendToDatabase($user);

            }catch (\Exception $e){
                Log::error($e);

                Notification::make()
                    ->title(trans('filament-cms::messages.content.posts.import.behance.notifications.failed_title'))
                    ->body(trans('filament-cms::messages.content.posts.import.behance.notifications.failed_description'))
                    ->danger()
                    ->sendToDatabase($user);
            }
        });

    }

    private function getProjectByURL(Browser $browser,string $url, array $data=[])
    {
        try {
            $browser->visit($url);
            $browser->waitFor("#project-canvas");
            $projectImages = $browser->script("
                            let projectBody = document.querySelectorAll('#project-canvas')[0];
                            let images = [];
                            let keywords = '';
                            let keywordsContent = document.querySelector('meta[name=keywords]');
                            if(keywordsContent){
                                keywords = keywordsContent.content;
                            }
                            let description = '';
                            let descriptionContent = document.querySelector('meta[name=description]');
                            if(descriptionContent){
                                description = descriptionContent.content;
                            }

                            let cover = '';
                            let coverContent = document.querySelector('meta[name=\"twitter:image\"]');
                            if(coverContent){
                                cover = coverContent.content;
                            }

                            let imagesArray = [];
                            let textArray = [];
                            if(projectBody){
                                images = projectBody.querySelectorAll('img')
                                for(let i=0; i<images.length; i++){
                                    imagesArray.push(images[i].src)
                                }
                                let texts = projectBody.querySelectorAll('.main-text');
                                for(let r=0; r<texts.length; r++){
                                    textArray.push(texts[r].innerText)
                                }
                            }


                            let countersContent = document.querySelector('.e2e-Project-infoSection').querySelectorAll('div');
                            let likes = null;
                            let views = null;
                            let comments = null;
                            let title = null;
                            if(countersContent){
                                title = countersContent[0].innerHTML;
                                likes = countersContent[1].querySelectorAll('div')[0].querySelector('span').innerHTML;
                                views = countersContent[1].querySelectorAll('div')[1].querySelector('span').innerHTML;
                                comments = countersContent[1].querySelectorAll('div')[2].querySelector('span').innerHTML;
                            }

                            return {
                                cover: cover,
                                title: title,
                                likes: likes,
                                views: views,
                                comments: comments,
                                images: imagesArray,
                                texts: textArray,
                                keywords: keywords,
                                description: description
                            }

                    ")[0];

            $project['images'] = $projectImages['images']??[];
            $project['texts'] = $projectImages['texts']??[];
            $project['keywords'] = $projectImages['keywords'];
            $project['description'] = $projectImages['description'];
            $project['name'] = $projectImages['title'];
            $project['views'] = $projectImages['views'];
            $project['likes'] = $projectImages['likes'];
            $project['comments'] = $projectImages['comments'];
            $project['cover'] = $projectImages['cover'];


            $getSlug = Str::of($this->url)->remove('https://www.behance.net/gallery/')->replace('/', '-')->toString();
            $checkIfPostExists = Post::query()->withTrashed()->where('slug', $getSlug)->first();
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
                "en"=> $project['name'],
                "ar"=> $project['name'],
            ];
            $post->views = (int)$project['views'];
            $post->keywords = [
                "ar" => $project['keywords'],
                "en" => $project['keywords']
            ];
            $post->short_description = [
                "ar" => $project['description'],
                "en" => $project['description'],
            ];
            $body = "";
            foreach($project['texts'] as $text){
                $body .= $text;
            }
            $post->body = [
                "ar"=> $body,
                "en"=> $body
            ];
            $post->is_published = true;
            $post->published_at = now();
            $post->type = 'portfolio';
            $post->slug = $getSlug;
            $post->author_type = $data['userType'];
            $post->author_id = $data['userId'];
            $post->save();

            $post->meta('likes', $project['likes']);
            $post->meta('comments', $project['comments']);
            $post->meta('views', $project['views']);

            $post->addMediaFromUrl($project['cover'])->toMediaCollection('feature_image');
            foreach($project['images'] as $image){
                $post->addMediaFromUrl($image)->toMediaCollection('images');
            }

            Event::dispatch(new PostCreated($post->toArray()));


            $browser->pause(2000);
        }catch (\Exception $e){
            Log::error($e);
        }
    }
}
