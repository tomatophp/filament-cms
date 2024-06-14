<?php

namespace TomatoPHP\FilamentCms\Sections;

use TomatoPHP\FilamentCms\Services\Abstract\Section;

class TomatoFAQSection extends Section
{
    public ?string $label = null;
    public ?string $group = "support";
    public ?string $icon = "bx bx-question-mark";
    public ?string $description = "show all FAQ questions with pagination";

    public function label(): string
    {
        return __('FAQ');
    }

    public function form(): string
    {
        return 'tomato-sections::sections.forms.faq';
    }

    public function section(): string
    {
        return 'tomato-sections::sections.pages.faq';
    }

    public function config(): array
    {
        return [];
    }
}
