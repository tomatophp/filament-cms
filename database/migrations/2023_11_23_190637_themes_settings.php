<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        if(config('filament-cms.features.theme-manager')){
            $this->migrator->add('themes.theme_name', 'main');
            $this->migrator->add('themes.theme_path', 'themes.main');
            $this->migrator->add('themes.theme_namespace', '');
            $this->migrator->add('themes.theme_main_color', '');
            $this->migrator->add('themes.theme_secandry_color', '');
            $this->migrator->add('themes.theme_sub_color', '');
            $this->migrator->add('themes.theme_css', '');
            $this->migrator->add('themes.theme_js', '');
            $this->migrator->add('themes.theme_header', '');
            $this->migrator->add('themes.theme_footer', '');
            $this->migrator->add('themes.theme_copyright', '');
        }
    }

    public function down(): void
    {
        if(config('filament-cms.features.theme-manager')) {
            $this->migrator->delete('themes.theme_name');
            $this->migrator->delete('themes.theme_path');
            $this->migrator->delete('themes.theme_namespace');
            $this->migrator->delete('themes.theme_main_color');
            $this->migrator->delete('themes.theme_secandry_color');
            $this->migrator->delete('themes.theme_sub_color');
            $this->migrator->delete('themes.theme_css');
            $this->migrator->delete('themes.theme_js');
            $this->migrator->delete('themes.theme_header');
            $this->migrator->delete('themes.theme_footer');
            $this->migrator->delete('themes.theme_copyright');
        }
    }
};
