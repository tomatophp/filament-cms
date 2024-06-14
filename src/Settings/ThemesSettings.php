<?php

namespace TomatoPHP\FilamentCms\Settings;

use Spatie\LaravelSettings\Settings;

class ThemesSettings extends Settings
{
    public string $theme_name;
    public string $theme_path;
    public string $theme_namespace;
    public string $theme_main_color;
    public string $theme_secandry_color;
    public string $theme_sub_color;
    public string $theme_css;
    public string $theme_js;
    public string $theme_header;
    public string $theme_footer;
    public string $theme_copyright;

    public static function group(): string
    {
        return 'themes';
    }
}
