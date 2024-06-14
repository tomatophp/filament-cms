<?php

namespace TomatoPHP\FilamentCms\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $username
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $be = new \TomatoPHP\FilamentCms\Services\Behance($this->username);
        $be->run();
    }
}
