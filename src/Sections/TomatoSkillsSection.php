<?php

namespace TomatoPHP\FilamentCms\Sections;

use TomatoPHP\FilamentCms\Services\Abstract\Section;

class TomatoSkillsSection extends Section
{
    public ?string $label = null;
    public ?string $group = "cms";
    public ?string $icon = "bx bx-cross";
    public ?string $description = "a skills section to show all skills with icons";

    public function label(): string
    {
        return __('Skills');
    }

    public function form(): string
    {
        return 'tomato-sections::sections.forms.skills';
    }

    public function section(): string
    {
        return 'tomato-sections::sections.cms.skills';
    }

    public function config(): array
    {
        return [];
    }
}
