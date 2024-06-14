<?php

use Illuminate\Support\Facades\File;
use TomatoPHP\TomatoThemes\Models\Section;

if(!function_exists('theme_assets')) {
    /**
     * @param string|null $path
     * @return string
     */
    function theme_assets(string $path = null): string
    {
        return asset('storage/themes/' . setting('theme_name') . '/' . $path);
    }
}

if(!function_exists('theme_setting')) {
    /**
     * @param string $key
     * @return mixed
     */
    function theme_setting(string $key): mixed
    {
        if(!File::exists(base_path('Themes'))){
            return false;
        }
        if(!File::exists(base_path('Themes') .'/'.setting('theme_path')) ){
            return false;
        }
        $info = json_decode(File::get(base_path('Themes').'/'.setting('theme_path') . "/info.json"), false);
        if(isset($info->settings->{$key})){
            return $info->settings->{$key}->value;
        }

        $settingClass = new \TomatoPHP\FilamentCms\Settings\ThemesSettings();

        if(isset($settingClass->{'theme_'.$key})){
            return $settingClass->{'theme_'.$key};
        }

        return false;
    }
}

if(!function_exists('section')){
    function section($key){
        $section = \TomatoPHP\FilamentCms\Facades\FilamentThemes::find($key);

        return $section;
    }
}

