<?php

namespace TomatoPHP\FilamentCms\Sections;

use TomatoPHP\FilamentCms\Services\Abstract\Section;

class TomatoBlogSection extends Section
{
    public ?string $label = null;
    public ?string $group = "blog";
    public ?string $icon = "bx bx-repost";
    public ?string $description = "show selected posts as a section";

    public function label(): string
    {
        return __('Blog Section');
    }

    public function form(): string
    {
        return 'tomato-sections::sections.forms.post';
    }

    public function section(): string
    {
        return 'tomato-sections::sections.blog.post';
    }

    public function config(): array
    {
        return [];
    }
}
