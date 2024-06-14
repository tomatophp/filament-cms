<?php

namespace TomatoPHP\FilamentCms\Sections;

use TomatoPHP\FilamentCms\Services\Abstract\Section;

class TomatoProductsSection extends Section
{
    public ?string $label = null;
    public ?string $group = "ecommerce";
    public ?string $icon = "bx bx-cart";
    public ?string $description = "show selected products with title and descrption";

    public function label(): string
    {
        return __('Products');
    }

    public function form(): string
    {
        return 'tomato-sections::sections.forms.products-section';
    }

    public function section(): string
    {
        return 'tomato-sections::sections.shop.products-section';
    }

    public function config(): array
    {
        return [];
    }
}
