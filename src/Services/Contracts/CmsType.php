<?php

namespace TomatoPHP\FilamentCms\Services\Contracts;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Class CmsType
 *
 * @property string $key
 * @property string $label
 * @property string $icon
 * @property string $color
 *
 * @method static make(string $key)
 * @method key(string $key)
 * @method label(string $label)
 * @method icon(string $icon)
 * @method color(string $color)
 */
class CmsType
{
    public string $key;

    public string $label;

    public ?string $icon = null;

    public ?string $color = null;

    public array $sub = [];

    /**
     * @return void
     */
    public static function make(string $key): self
    {
        return (new self)->key($key)->label(Str::of($key)->title()->toString());
    }

    /**
     * @return $this
     */
    public function key(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return $this
     */
    public function label(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return $this
     */
    public function icon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return $this
     */
    public function color(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return $this
     */
    public function sub(array $sub): self
    {
        $this->sub = $sub;

        return $this;
    }

    public function getSub(): Collection
    {
        return collect($this->sub);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'key' => $this->key,
            'label' => $this->label,
            'icon' => $this->icon,
            'color' => $this->color,
            'sub' => $this->sub,
        ];
    }
}
