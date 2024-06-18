<?php

namespace TomatoPHP\FilamentCms\Services\Contracts;

use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;

class Section
{
    public ?string $label = null;
    public ?string $type = 'section';
    public ?string $key = null;
    public ?string $view = null;
    public ?array $form = [];
    public ?bool $hasForm = false;
    public ?string $color = null;
    public ?string $icon = null;
    public ?bool $lock = false;

    public static function make(string $key):self
    {
        return (new self())->key($key);
    }

    public function toArray(): array
    {
        return [
            'hasForm' => $this->hasForm,
            'type' => $this->type,
            'label' => $this->label,
            'key' => $this->key,
            'view' => $this->view,
            'color' => $this->color,
            'icon' => $this->icon,
            'form' => $this->form,
            'lock' => $this->lock,
        ];
    }

    public function label(string $label): static
    {
        $this->label = $label;
        return $this;
    }


    public function type(string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function form(array $form): static
    {
        $this->form = $form;
        $this->hasForm = true;
        return $this;
    }

    public function key(string $key): static
    {
        $this->key = $key;
        return $this;
    }

    public function view(string $view): static
    {
        if(view()->exists($view)){
            $this->view = $view;
        }
        else {
            throw new \Exception("View not found");
        }

        return $this;
    }

    public function color(string $color): static
    {
        $this->color = $color;
        return $this;
    }

    public function icon(string $icon): static
    {
        $this->icon = $icon;
        return $this;
    }

    public function lock(string $lock): static
    {
        $this->lock = $lock;
        return $this;
    }
}
