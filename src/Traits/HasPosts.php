<?php

namespace TomatoPHP\FilamentCms\Traits;

use TomatoPHP\FilamentCms\Models\Post;

trait HasPosts
{
    public function posts()
    {
        return $this->morphMany(Post::class, 'authorable');
    }
}
