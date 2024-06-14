<?php

namespace TomatoPHP\FilamentCms\Sections;

use TomatoPHP\FilamentCms\Services\Abstract\Section;

class TomatoAboutFeaturesSection extends Section
{
    public ?string $label = null;
    public ?string $group = "cms";
    public ?string $icon = "bx bx-cheese";
    public ?string $description = "show blocks of feature with main title and section and button";

    public function label(): string
    {
        return __('Features Blocks');
    }

    public function form(): string
    {
        return 'tomato-sections::sections.forms.about-features';
    }

    public function section(): string
    {
        return 'tomato-sections::sections.pages.about-features';
    }

    public function config(): array
    {
        return [];
    }
}
