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

you can check docs of this package on [Docs](https://docs.tomatophp.com/plugins/laravel-package-generator)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security

Please see [SECURITY](SECURITY.md) for more information about security.

## Credits

- [Tomatophp](mailto:info@3x1.io)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
