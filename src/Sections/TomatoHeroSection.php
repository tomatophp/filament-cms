<?php

namespace TomatoPHP\FilamentCms\Sections;

use TomatoPHP\FilamentCms\Services\Abstract\Section;

class TomatoHeroSection extends Section
{
    public ?string $label = null;
    public ?string $group = "pages";
    public ?string $icon = "bx bx-home";
    public ?string $description = "hero section for homepage ecommerce";

    public function label(): string
    {
        return __('Hero');
    }

    public function form(): string
    {
        return 'tomato-sections::sections.forms.hero';
    }

    public function section(): string
    {
        return 'tomato-sections::sections.pages.hero';
    }

    public function config(): array
    {
        return [];
    }
}
