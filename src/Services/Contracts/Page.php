<?php

namespace TomatoPHP\FilamentCms\Services\Contracts;

use Illuminate\Support\Facades\Cookie;

class Page
{
    public ?string $title = null;
    public ?string $slug = null;
    public ?string $body = null;
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
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
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

    public function title(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function slug(string $slug): static
    {
        $this->slug = $slug;
        return $this;
    }

    public function body(string $body): static
    {
        $this->body = $body;
        return $this;
    }

    public function lock(string $lock): static
    {
        $this->lock = $lock;
        return $this;
    }
}
