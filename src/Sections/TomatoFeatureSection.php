<?php

namespace TomatoPHP\FilamentCms\Sections;

use TomatoPHP\FilamentCms\Services\Abstract\Section;

class TomatoFeatureSection extends Section
{
    public ?string $label = null;
    public ?string $group = "pages";
    public ?string $icon = "bx bx-rocket";
    public ?string $description = "a feature section between other sections to add ads on your page";

    public function label(): string
    {
        return __('Feature');
    }

    public function form(): string
    {
        return 'tomato-sections::sections.forms.feature';
    }

    public function section(): string
    {
        return 'tomato-sections::sections.pages.feature';
    }

    public function config(): array
    {
        return [];
    }
}
