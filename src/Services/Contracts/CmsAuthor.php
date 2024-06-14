<?php

namespace TomatoPHP\FilamentCms\Services\Contracts;

class CmsAuthor
{
    /**
     * @var string
     */
    public string $name;
    /**
     * @var string
     */
    public string $model;

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
     * @param string $model
     * @return $this
     */
    public function model(string $model): self
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'model' => $this->model
        ];
    }
}
