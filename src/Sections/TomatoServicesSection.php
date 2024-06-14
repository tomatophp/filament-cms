<?php

namespace TomatoPHP\FilamentCms\Sections;

use TomatoPHP\FilamentCms\Services\Abstract\Section;

class TomatoServicesSection extends Section
{
    public ?string $label = null;
    public ?string $group = "cms";
    public ?string $icon = "bx bx-cog";
    public ?string $description = "show selected services as a section";

    public function label(): string
    {
        return __('Services');
    }

    public function form(): string
    {
        return 'tomato-sections::sections.forms.services';
    }

    public function section(): string
    {
        return 'tomato-sections::sections.cms.services';
    }

    public function config(): array
    {
        return [];
    }
}
