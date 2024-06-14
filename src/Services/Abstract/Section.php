<?php


namespace TomatoPHP\FilamentCms\Services\Abstract;

use Illuminate\Support\Collection;

abstract class Section
{
    public ?string $label = null;
    public ?string $group = "sections";
    public ?string $icon = "";
    public ?string $description = "";

    public function section(): string
    {
        return '';
    }

    public function form(): string
    {
        return '';
    }

    public function config(): array
    {
        return [];
    }

    public function toCollection(): Collection
    {
        return collect([
            'key' => $this->section(),
            'label' => $this->label(),
            'group' => $this->group,
            'icon' => $this->icon,
            'description' => $this->description,
            'section' => $this->section(),
            'form' => $this->form(),
            'config' => $this->config(),
        ]);
    }
}
