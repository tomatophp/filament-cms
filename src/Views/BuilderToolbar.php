<?php

namespace TomatoPHP\FilamentCms\Views;

use Illuminate\View\Component;
use Illuminate\View\View;
use TomatoPHP\FilamentCms\Models\Post;
use TomatoPHP\TomatoThemes\Services\Abstract\Section;

class BuilderToolbar extends Component
{

    public function __construct(
        public Post $page,
        public bool $allowLayout=false
    )
    {
        //
    }

    public function render(): View
    {
       return view('filament-cms::themes.builder-toolbar');
    }
}
