<?php

namespace TomatoPHP\FilamentCms\Generator\Traits;

use Illuminate\Support\Str;

trait GenerateReadMe
{
    /**
     * @return void
     */
    private function generateReadMe(): void
    {
        //Generate Readme.md file
        $this->generateStubs(
            $this->stubPath . 'readme.stub',
            base_path("Modules") . '/'. $this->themeName . '/README.md',
            [
                "name" => $this->themeName,
                "description" => $this->themeDescription,
            ],
            [
                base_path("Modules"),
                base_path("Modules") . "/". $this->themeName,
            ]
        );
    }
}
