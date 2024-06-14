<?php

namespace TomatoPHP\FilamentCms\Services\Contracts;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

/**
 *
 * Class CmsType
 * @package TomatoPHP\FilamentCms\Services\Contracts
 * @property string $key
 * @property string $label
 * @property string $icon
 * @property string $color
 * @method static make(string $key)
 * @method key(string $key)
 * @method label(string $label)
 * @method icon(string $icon)
 * @method color(string $color)
 *
 */
class CmsType
{
    /**
     * @var string
     */
    public string $key;
    /**
     * @var string
     */
    public string $label;
    /**
     * @var string
     */
    public ?string $icon=null;
    /**
     * @var string
     */
    public ?string $color=null;
    /**
     * @var array
     */
    public array $sub=[];

    /**
     * @param string $key
     * @return void
     */
    public static function make(string $key):self
    {
        return (new self)->key($key)->label(Str::of($key)->title()->toString());
    }

    /**
     * @param string $key
     * @return $this
     */
    public function key(string $key): self
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @param string $label
     * @return $this
     */
    public function label(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @param string $icon
     * @return $this
     */
    public function icon(string $icon): self
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @param string $color
     * @return $this
     */
    public function color(string $color): self
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @param array $sub
     * @return $this
     */
    public function sub(array $sub): self
    {
        $this->sub = $sub;
        return $this;
    }

    /**
     * @return Collection
     */
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
