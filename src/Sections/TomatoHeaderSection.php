<?php

namespace TomatoPHP\FilamentCms\Sections;

use TomatoPHP\FilamentCms\Services\Abstract\Section;

class TomatoHeaderSection extends Section
{
    public ?string $label = null;
    public ?string $group = "headers";
    public ?string $icon = "bx bx-menu";
    public ?string $description = "main header for any page as a layout header";

    public function label(): string
    {
        return __('Header');
    }

    public function form(): string
    {
        return 'tomato-sections::sections.forms.header';
    }

    public function section(): string
    {
        return 'tomato-sections::sections.header';
    }

    public function config(): array
    {
        return [];
    }
}
