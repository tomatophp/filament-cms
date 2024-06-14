<?php

namespace TomatoPHP\FilamentCms\Services;

use TomatoPHP\FilamentCms\Browser\Actions\CreateBrowser;
use TomatoPHP\FilamentCms\Browser\Chrome;
use Facebook\WebDriver\WebDriverBy;
use Illuminate\Support\Facades\Log;
use Laravel\Dusk\Browser;
use TomatoPHP\FilamentCms\Models\Portfolio;

class Behance
{
    /**
     * @var Chrome|null
     */
    private Chrome|null $dusk;


    public function __construct(
        private string $username,
        private string $type='web',
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

        $this->dusk->browse(function (Browser $browser){
            try {
                $browser->visit('https://www.behance.net/' . $this->username);
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

                try {
                    foreach($projectsList as $project){
                        $browser->visit($project['url']);
                        $projectImages = $browser->script("
                            let projectBody = document.querySelectorAll('#project-canvas')[0];
                            let images = [];
                            let keywords = '';
                            let keywordsContent = document.querySelector('meta[name=keywords]');
                            if(keywordsContent){
                                keywordsContent.content;
                            }
                            let description = '';
                            let descriptionContent = document.querySelector('meta[name=description]');
                            if(descriptionContent){
                                description = descriptionContent.content;
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

                            return {
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

                        $newProject = new Portfolio();
                        $newProject->title = [
                            "en"=> $project['name']
                        ];
                        $newProject->views = $project['views'];
                        $newProject->keywords = [
                            "en" => $project['keywords']
                        ];
                        $newProject->short_description = [
                            "en" => $project['description']
                        ];
                        $body = "";
                        foreach($project['texts'] as $text){
                            $body .= $text;
                        }
                        $newProject->body = [
                            "en"=> $body
                        ];
                        $newProject->activated = true;
                        $newProject->service_id = config('tomato-cms.behance_service_id');
                        $newProject->save();

                        $newProject->addMediaFromUrl($project['cover'])->toMediaCollection('feature');
                        foreach($project['images'] as $image){
                            $newProject->addMediaFromUrl($image)->toMediaCollection('images');
                        }

                        $browser->pause(2000);

                    }
                }catch (\Exception $e) {
                    Log::error($e);
                }

            }catch (\Exception $e){
                Log::error($e);
            }
        });

    }
}
