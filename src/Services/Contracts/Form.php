<?php

namespace TomatoPHP\FilamentCms\Services\Contracts;

use Illuminate\Support\Facades\Cookie;

class Form
{
    public ?string $title = null;
    public ?string $description = null;
    public ?string $name = null;
    public ?string $key = null;
    public ?string $type='page';
    public ?string $method='POST';
    public ?string $endpoint='/';
    public ?array $inputs = [];

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
            'description' => $this->description,
            'name' => $this->name,
            'key' => $this->key,
            'type' => $this->type,
            'method' => $this->method,
            'endpoint' => $this->endpoint,
            'inputs' => $this->inputs,
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

    public function description(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function key(string $key): static
    {
        $this->key = $key;
        return $this;
    }

    public function name(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function method(string $method): static
    {
        $this->method = $method;
        return $this;
    }

    public function type(string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function endpoint(string $endpoint): static
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    public function inputs(array $inputs): static
    {
        $this->inputs = $inputs;
        return $this;
    }
}
