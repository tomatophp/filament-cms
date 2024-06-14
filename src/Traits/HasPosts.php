<?php

namespace TomatoPHP\FilamentCms\Traits;

use TomatoPHP\FilamentCms\Services\FilamentPostAuthors;

trait HasPosts
{
    public function posts()
    {
        return $this->morphMany(\TomatoPHP\FilamentCms\Models\Post::class, 'authorable');
    }
}
