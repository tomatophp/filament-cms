<?php

namespace TomatoPHP\FilamentCms\Services\Contracts;

use Illuminate\Support\Facades\Cookie;

class Section
{
    public ?string $type = null;
    public ?string $key = null;
    public ?string $view = null;
    public ?string $form = null;
    public ?int $form_id = null;
    public ?string $color = null;
    public ?string $icon = null;
    public ?bool $lock = false;


    public function __construct()
    {
        // decrypt
        try {
            $decryptedString = \Crypt::decrypt(Cookie::get('lang'), false);
            $lang = json_decode(explode('|', $decryptedString)[1]);
            app()->setLocale($lang->id ?? config('app.locale'));
        }catch (\Exception $exception) {}
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'key' => $this->key,
            'view' => $this->view,
            'form' => $this->form,
            'color' => $this->color,
            'icon' => $this->icon,
            'form_id' => $this->form_id,
            'lock' => $this->lock,
        ];
    }


    /**
     * @return static
     */
    public static function make(): static
    {
        return (new static);
    }

    public function type(string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function form_id(string $form_id): static
    {
        $this->form_id = $form_id;
        return $this;
    }

    public function key(string $key): static
    {
        $this->key = $key;
        return $this;
    }

    public function view(string $view): static
    {
        $this->view = $view;
        return $this;
    }

    public function form(string $form): static
    {
        $this->form = $form;
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
