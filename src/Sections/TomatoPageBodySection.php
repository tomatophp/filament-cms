<?php

namespace TomatoPHP\FilamentCms\Sections;

use TomatoPHP\FilamentCms\Services\Abstract\Section;

class TomatoPageBodySection extends Section
{
    public ?string $label = null;
    public ?string $group = "pages";
    public ?string $icon = "bx bx-text";
    public ?string $description = "use to get the body of the page inside your page builder";

    public function label(): string
    {
        return __('Page Body');
    }

    public function form(): string
    {
        return '';
    }

    public function section(): string
    {
        return 'tomato-sections::sections.pages.page-body';
    }

    public function config(): array
    {
        return [];
    }
}
