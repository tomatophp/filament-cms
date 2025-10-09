<?php

namespace TomatoPHP\FilamentCms\Traits;

trait HasPosts
{
    public function posts()
    {
        return $this->morphMany(\TomatoPHP\FilamentCms\Models\Post::class, 'authorable');
    }
}
