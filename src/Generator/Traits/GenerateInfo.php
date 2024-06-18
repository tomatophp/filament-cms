<?php

namespace TomatoPHP\FilamentCms\Generator\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Nwidart\Modules\Facades\Module;

trait GenerateInfo
{
    /**
     * @return void
     */
    private function generateInfo(): void
    {
        if(Module::find($this->themeName)){
            $modulePath = module_path($this->themeName) .'/module.json';
            $module = json_decode(File::get($modulePath));
            $module->title = [];
            $module->title['ar'] = $this->themeTitle;
            $module->title['en'] = $this->themeTitle;
            $module->title['gr'] = $this->themeTitle;
            $module->title['sp'] = $this->themeTitle;
            $module->description = [];
            $module->description['ar'] = $this->themeDescription;
            $module->description['en'] = $this->themeDescription;
            $module->description['gr'] = $this->themeDescription;
            $module->description['sp'] = $this->themeDescription;
            $module->placeholder = "placeholder.webp";
            $module->type = "theme";
            $module->color = "#F01E19";
            $module->icon = "heroicon-s-swatch";
            $module->version = "v1.0.0";

            File::put($modulePath, json_encode($module, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
        }

    }
}
