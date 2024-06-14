![Screenshot](https://github.com/tomatophp/filament-cms/blob/master/arts/3x1io-tomato-cms.jpg)

# Filament CMS

[![Latest Stable Version](https://poser.pugx.org/tomatophp/filament-cms/version.svg)](https://packagist.org/packages/tomatophp/filament-cms)
[![PHP Version Require](http://poser.pugx.org/tomatophp/filament-cms/require/php)](https://packagist.org/packages/tomatophp/filament-cms)
[![License](https://poser.pugx.org/tomatophp/filament-cms/license.svg)](https://packagist.org/packages/tomatophp/filament-cms)
[![Downloads](https://poser.pugx.org/tomatophp/filament-cms/d/total.svg)](https://packagist.org/packages/tomatophp/filament-cms)

Full CMS System with easy to use page builder for FilamentPHP

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

![Posts List](https://github.com/tomatophp/filament-cms/blob/master/arts/posts-list.png)
![Posts Create](https://github.com/tomatophp/filament-cms/blob/master/arts/create-post.png)
![Posts SEO](https://github.com/tomatophp/filament-cms/blob/master/arts/post-seo.png)
![Posts View](https://github.com/tomatophp/filament-cms/blob/master/arts/view-post.png)
![Category List](https://github.com/tomatophp/filament-cms/blob/master/arts/category-list.png)
![Category Create](https://github.com/tomatophp/filament-cms/blob/master/arts/create-category.png)

## Features

- [x] Content Manager
- [ ] Content Comments & Ratings
- [ ] Youtube Meta Integration
- [ ] Behanace Content Importer
- [ ] GitHub Content Importer
- [ ] Page Builder
- [ ] Theme Manager
- [ ] Form Builder
- [ ] Ticketing System
- [ ] REST API

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
