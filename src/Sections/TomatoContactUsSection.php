<?php

namespace TomatoPHP\FilamentCms\Sections;

use TomatoPHP\FilamentCms\Services\Abstract\Section;

class TomatoContactUsSection extends Section
{
    public ?string $label = null;
    public ?string $group = "support";
    public ?string $icon = "bx bx-phone";
    public ?string $description = "show up a contact form with contact informations from you app settings";

    public function label(): string
    {
        return __('Contact Us');
    }

    public function form(): string
    {
        return 'tomato-sections::sections.forms.contact';
    }

    public function section(): string
    {
        return 'tomato-sections::sections.pages.contact';
    }

    public function config(): array
    {
        return [];
    }
}
