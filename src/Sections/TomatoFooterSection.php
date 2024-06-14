<?php

namespace TomatoPHP\FilamentCms\Sections;

use TomatoPHP\FilamentCms\Services\Abstract\Section;

class TomatoFooterSection extends Section
{
    public ?string $label = null;
    public ?string $group = "footers";
    public ?string $icon = "bx bx-copyright";
    public ?string $description = "main footer for any page as a layout footer";

    public function label(): string
    {
        return __('Footer');
    }

    public function form(): string
    {
        return 'tomato-sections::sections.forms.footer';
    }

    public function section(): string
    {
        return 'tomato-sections::sections.footer';
    }

    public function config(): array
    {
        return [];
    }
}
