<?php

namespace TomatoPHP\FilamentCms\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BehanceMetaGetterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public ?string $username=null,
        public ?string $url=null,
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
        if($this->username || $this->url){
            $be = new \TomatoPHP\FilamentCms\Services\Behance(
                username: $this->username,
                url: $this->url,
                userId: $this->userId,
                userType: $this->userType,
                panel: $this->panel,
            );
            $be->run();
        }
    }
}
