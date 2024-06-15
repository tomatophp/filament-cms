![Screenshot](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/3x1io-tomato-cms.jpg)

# Filament CMS

[![Latest Stable Version](https://poser.pugx.org/tomatophp/filament-cms/version.svg)](https://packagist.org/packages/tomatophp/filament-cms)
[![PHP Version Require](http://poser.pugx.org/tomatophp/filament-cms/require/php)](https://packagist.org/packages/tomatophp/filament-cms)
[![License](https://poser.pugx.org/tomatophp/filament-cms/license.svg)](https://packagist.org/packages/tomatophp/filament-cms)
[![Downloads](https://poser.pugx.org/tomatophp/filament-cms/d/total.svg)](https://packagist.org/packages/tomatophp/filament-cms)

Full CMS System with easy to use page builder & theme manager for FilamentPHP

## Installation

```bash
composer require tomatophp/filament-cms
```
after install your package please run this command

```bash
php artisan filament-cms:install
```

finally register the plugin on `/app/Providers/Filament/AdminPanelProvider.php`

```php
->plugin(\TomatoPHP\FilamentCms\FilamentCMSPlugin::make())
```

## Screenshots

![Posts List](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/posts-list.png)
![Posts Create](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/create-post.png)
![Posts SEO](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/post-seo.png)
![Posts View](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/view-post.png)
![Category List](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/category-list.png)
![Category Create](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/create-category.png)

## Features

- [x] Content Manager
- [x] Content Comments & Ratings
- [x] Youtube Meta Integration
- [x] Behanace Content Importer
- [x] GitHub Content Importer
- [x] Content Import & Export
- [ ] Page Builder
- [ ] Theme Manager
- [ ] Form Builder
- [ ] Ticketing System
- [ ] REST API

## Allow Import From Youtube URL

you can allow import content from youtube by adding `YOUTUBE_KEY` to your `.env`

```dotenv
YOUTUBE_KEY=YOUR_YOUTUBE_KEY
```

now on your panel provider `/app/Providers/Filament/AdminPanelProvider.php` add this method

```php
->plugin(\TomatoPHP\FilamentCms\FilamentCMSPlugin::make()->allowYoutubeImport())
```

## Allow Import From Behanace URL 

first of all you need to install `dusk` as a main package to allow this feature

```bash
composer require laravel/dusk
```

now install dusk driver

```bash
php artisan dusk:install
```

now you need to allow behanace import on your panel provider `/app/Providers/Filament/AdminPanelProvider.php` add this method

```php
->plugin(\TomatoPHP\FilamentCms\FilamentCMSPlugin::make()->allowBehanceImport())
```

## Add Custom Type to CMS

you can add a custom type to the CMS by using Facade method on your AppServiceProvider `boot()` method 

```php
use TomatoPHP\FilamentCms\Facades\FilamentCMS;
use TomatoPHP\FilamentCms\Services\Contracts\CmsType;

public function boot()
{
    FilamentCMS::types()->register([
        CmsType::make('building')
            ->label('Buildings')
            ->icon('heroicon-o-home')
            ->color('danger')
    ]);
}

```

## Add More Authors Types

you can add more authors types by using Facade method on your AppServiceProvider `boot()` method 

```php
use TomatoPHP\FilamentCms\Facades\FilamentCMS;
use TomatoPHP\FilamentCms\Services\Contracts\CmsAuthor;

public function boot()
{
    FilamentCMS::authors()->register([
        CmsAuthor::make('Admin')
            ->model(\App\Models\User::class)
    ]);
}

```


## Publish Assets

you can publish config file by use this command

```bash
php artisan vendor:publish --tag="filament-cms-config"
```

you can publish views file by use this command

```bash
php artisan vendor:publish --tag="filament-cms-views"
```

you can publish languages file by use this command

```bash
php artisan vendor:publish --tag="filament-cms-lang"
```

you can publish migrations file by use this command

```bash
php artisan vendor:publish --tag="filament-cms-migrations"
```

## Support

you can join our discord server to get support [TomatoPHP](https://discord.gg/Xqmt35Uh)

## Docs

you can check docs of this package on [Docs](https://docs.tomatophp.com/filament/filament-cms)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security

Please see [SECURITY](SECURITY.md) for more information about security.

## Credits

- [Fady Mondy](https://wa.me/+201207860084)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
