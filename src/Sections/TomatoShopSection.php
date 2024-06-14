<?php

namespace TomatoPHP\FilamentCms\Sections;

use TomatoPHP\FilamentCms\Services\Abstract\Section;

class TomatoShopSection extends Section
{
    public ?string $label = null;
    public ?string $group = "ecommerce";
    public ?string $icon = "bx bx-store";
    public ?string $description = "a full shop index with products and filters";

    public function label(): string
    {
        return __('Shop');
    }

    public function form(): string
    {
        return 'tomato-sections::sections.forms.shop';
    }

    public function section(): string
    {
        return 'tomato-sections::sections.shop.shop';
    }

    public function config(): array
    {
        return [];
    }
}
