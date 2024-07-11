<?php

namespace TomatoPHP\FilamentCms\Services\Contracts;

use Filament\Forms\Components\TextInput;

class CmsFormFieldType
{
    /**
     * @var string
     */
    public string $name;
    /**
     * @var string
     */
    public string $label;

    /**
     * @var string
     */
    public string $color = 'primary';

    /**
     * @var string
     */
    public string $icon = 'heroicon-s-bars-3-center-left';

    public string $className = TextInput::class;

    /**
     * @param string $name
     * @return Author
     */
    public static function make(string $name): self
    {
        return (new self)->name($name);
    }

    /**
     * @param string $name
     * @return $this
     */
    public function name(string $name): self
    {
        $this->name = $name;
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
     * @param string $color
     * @return $this
     */
    public function color(string $color): self
    {
        $this->color = $color;
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
     * @param string $className
     * @return $this
     */
    public function className(string $className): self
    {
        $this->className = $className;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'label' => $this->label,
            'color' => $this->color,
            'icon' => $this->icon,
            'className' => $this->className,
        ];
    }
}
