<?php

namespace TomatoPHP\FilamentCms\Settings;

use Spatie\LaravelSettings\Settings;

class ThemesSettings extends Settings
{
    public ?string $theme_name=null;
    public ?string $theme_path=null;
    public ?string $theme_namespace=null;
    public ?string $theme_main_color=null;
    public ?string $theme_secandry_color=null;
    public ?string $theme_sub_color=null;
    public ?string $theme_css=null;
    public ?string $theme_js=null;
    public ?string $theme_header=null;
    public ?string $theme_footer=null;
    public ?string $theme_copyright=null;

    public static function group(): string
    {
        return 'themes';
    }
}
