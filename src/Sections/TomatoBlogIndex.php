<?php

namespace TomatoPHP\FilamentCms\Sections;

use TomatoPHP\FilamentCms\Services\Abstract\Section;

class TomatoBlogIndex extends Section
{
    public ?string $label = null;
    public ?string $group = "blog";
    public ?string $icon = "bx bx-paperclip";
    public ?string $description = "show blog index posts with any type of posts";

    public function label(): string
    {
        return __('Blog');
    }

    public function form(): string
    {
        return 'tomato-sections::sections.forms.blog';
    }

    public function section(): string
    {
        return 'tomato-sections::sections.blog.blog';
    }

    public function config(): array
    {
        return [];
    }
}
