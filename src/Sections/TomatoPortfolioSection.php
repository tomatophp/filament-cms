<?php

namespace TomatoPHP\FilamentCms\Sections;

use TomatoPHP\FilamentCms\Services\Abstract\Section;

class TomatoPortfolioSection extends Section
{
    public ?string $label = null;
    public ?string $group = "cms";
    public ?string $icon = "bx bx-image";
    public ?string $description = "a protfolio selected sections to show your best projects";

    public function label(): string
    {
        return __('Portfolio Section');
    }

    public function form(): string
    {
        return 'tomato-sections::sections.forms.projects';
    }

    public function section(): string
    {
        return 'tomato-sections::sections.projects.projects';
    }

    public function config(): array
    {
        return [];
    }
}
