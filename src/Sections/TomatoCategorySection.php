<?php

namespace TomatoPHP\FilamentCms\Sections;

use TomatoPHP\FilamentCms\Services\Abstract\Section;

class TomatoCategorySection extends Section
{
    public ?string $label = null;
    public ?string $group = "cms";
    public ?string $icon = "bx bx-category";
    public ?string $description = "show category with images";

    public function label(): string
    {
        return __('Category');
    }

    public function form(): string
    {
        return 'tomato-sections::sections.forms.category';
    }

    public function section(): string
    {
        return 'tomato-sections::sections.shop.category';
    }

    public function config(): array
    {
        return [];
    }
}
