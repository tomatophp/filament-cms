<?php

namespace TomatoPHP\FilamentCms\Sections;

use TomatoPHP\FilamentCms\Services\Abstract\Section;

class TomatoPortfolioIndex extends Section
{
    public ?string $label = null;
    public ?string $group = "cms";
    public ?string $icon = "bx bxs-landscape";
    public ?string $description = "a protfolio index to show all projects with crud and filters";

    public function label(): string
    {
        return __('Portfolio');
    }

    public function form(): string
    {
        return 'tomato-sections::sections.forms.projects-index';
    }

    public function section(): string
    {
        return 'tomato-sections::sections.projects.projects-index';
    }

    public function config(): array
    {
        return [];
    }
}
