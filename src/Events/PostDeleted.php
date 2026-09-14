<?php

namespace TomatoPHP\FilamentCms\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PostDeleted implements ShouldBroadcast, ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use InteractsWithSockets;
    use Queueable;
    use SerializesModels;

    public function __construct(public array $data) {}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('cms'),
        ];
    }
}
