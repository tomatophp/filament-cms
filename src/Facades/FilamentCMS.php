<?php

namespace TomatoPHP\FilamentCms\Facades;

use Illuminate\Support\Facades\Facade;
use TomatoPHP\FilamentCms\Services\FilamentCMSAuthors;
use TomatoPHP\FilamentCms\Services\FilamentCMSThemes;
use TomatoPHP\FilamentCms\Services\FilamentCMSTypes;
use TomatoPHP\FilamentCms\Services\FilamentThemesServices;
use TomatoPHP\TomatoCms\Services\Page;
use TomatoPHP\TomatoCms\Services\Section;


/**
 * @method FilamentCMSAuthors authors()
 * @method FilamentCMSTypes types()
 * @method FilamentCMSThemes themes()
 */
class FilamentCMS extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'filament-cms';
    }
}
