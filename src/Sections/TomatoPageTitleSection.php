<?php

namespace TomatoPHP\FilamentCms\Sections;

use TomatoPHP\FilamentCms\Services\Abstract\Section;

class TomatoPageTitleSection extends Section
{
    public ?string $label = null;
    public ?string $group = "pages";
    public ?string $icon = "bx bx-bold";
    public ?string $description = "add a title for a page and some informations about current page";

    public function label(): string
    {
        return __('Page Title');
    }

    public function form(): string
    {
        return 'tomato-sections::sections.forms.page-header';
    }

    public function section(): string
    {
        return 'tomato-sections::sections.pages.page-header';
    }

    public function config(): array
    {
        return [];
    }
}
