<?php

namespace TomatoPHP\FilamentCms\Sections;

use TomatoPHP\FilamentCms\Services\Abstract\Section;

class TomatoTestimonialsSection extends Section
{
    public ?string $label = null;
    public ?string $group = "cms";
    public ?string $icon = "bx bx-comment";
    public ?string $description = "a testimonials slider section to show selected testimonials";

    public function label(): string
    {
        return __('Testimonials');
    }

    public function form(): string
    {
        return 'tomato-sections::sections.forms.testimonials';
    }

    public function section(): string
    {
        return 'tomato-sections::sections.cms.testimonials';
    }

    public function config(): array
    {
        return [];
    }
}
