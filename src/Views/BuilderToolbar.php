<?php

namespace TomatoPHP\TomatoThemes\Views;

use Illuminate\View\Component;
use TomatoPHP\TomatoCms\Models\Page;
use TomatoPHP\TomatoThemes\Services\Abstract\Section;

class BuilderToolbar extends Component
{
    public function __construct(
        public Page $page
    )
    {
        //
    }

    public function render()
    {
       return view('tomato-themes::themes.builder-toolbar');
    }
}
