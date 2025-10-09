<?php

namespace TomatoPHP\FilamentCms\Services\Contracts;

class CmsAuthor
{
    public string $name;

    public string $model;

    /**
     * @return Author
     */
    public static function make(string $name): self
    {
        return (new self)->name($name);
    }

    /**
     * @return $this
     */
    public function name(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return $this
     */
    public function model(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'model' => $this->model,
        ];
    }
}
