<?php

namespace TomatoPHP\FilamentCms\Services;

use Illuminate\Support\Str;
use TomatoPHP\ConsoleHelpers\Traits\HandleStub;

class GenerateSection
{
    use HandleStub;

    private string $sectionTitle;
    private string $sectionName;
    private string $stubPath;
    private string $key;

    public function __construct(
        public string $section,
        public string $view,
        public string|bool|null $moduleName=null,
    )
    {
        $this->sectionTitle = Str::of($this->section)->replace('-', ' ')->replace('_', ' ')->title()->toString();
        $this->sectionName = Str::of($this->section)->camel()->ucfirst()->toString();
        $this->key = Str::of($this->section)->replace('-', '_')->replace(' ', '_')->toString();
        $this->stubPath = __DIR__ ."/../../stubs";
    }

    public function generate(){
        $this->generateStubs(
            from: $this->stubPath . "/section.stub",
            to: $this->moduleName ? module_path($this->moduleName) . "/Sections/{$this->sectionName}Section.php" : app_path("/Sections/{$this->sectionName}Section.php"),
            replacements:  [
                "name" => $this->sectionName,
                "title" => $this->sectionTitle,
                "key" => $this->key,
                "view" => $this->view,
                "namespace" => $this->moduleName ? "namespace Modules\\{$this->moduleName}\\Sections;" : "namespace App\\Sections;",
            ],
            directory: [
                $this->moduleName ? module_path($this->moduleName) . "/Sections" :  app_path("/Sections")
            ]
        );
    }
}
