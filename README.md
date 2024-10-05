![Screenshot](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/3x1io-tomato-cms.jpg)

# Filament CMS Builder

[![Latest Stable Version](https://poser.pugx.org/tomatophp/filament-cms/version.svg)](https://packagist.org/packages/tomatophp/filament-cms)
[![License](https://poser.pugx.org/tomatophp/filament-cms/license.svg)](https://packagist.org/packages/tomatophp/filament-cms)
[![Downloads](https://poser.pugx.org/tomatophp/filament-cms/d/total.svg)](https://packagist.org/packages/tomatophp/filament-cms)

Full CMS System with easy to use page builder & theme manager for FilamentPHP

## Installation

```bash
composer require tomatophp/filament-cms
```
after install your package please run this command

**NOTE** if you need to custom some feature please don't use this command and follow the next steps because this step run migration and you need to custom config before run migration.

```bash
php artisan filament-cms:install
```

finally register the plugin on `/app/Providers/Filament/AdminPanelProvider.php`

```php
->plugin(
    \TomatoPHP\FilamentCms\FilamentCMSPlugin::make()
        ->useCategory()
        ->usePost()
        ->allowExport()
        ->allowImport()
)
```

now please publish and migrate media table 

```bash
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="medialibrary-migrations"
php artisan migrate
```
## Screenshots

![Posts List](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/posts-list.png)
![Posts Create](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/create-post.png)
![Posts SEO](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/post-seo.png)
![Posts View](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/view-post.png)
![Category List](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/category-list.png)
![Category Create](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/create-category.png)
![Form List](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/form-list.png)
![Create Form](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/create-form.png)
![From Fields](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/form-fields.png)
![Create Field](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/create-field.png)
![Form Preview](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/preview-form.png)
![View Form Request](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/view-request.png)

## Features

- [x] Content Manager
- [x] Content Comments & Ratings
- [x] Youtube Meta Integration
- [x] Behanace Content Importer
- [x] GitHub Content Importer
- [x] Content Import & Export
- [x] Page Builder
- [x] Theme Manager
- [x] Form Builder
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

## Use Theme Manager

the theme manager is build with Laravel Modules so you need to install it first

**Note:** if you are install `tomatophp/filament-plugins` you don't need to install `nwidart/laravel-modules` because it's already installed

```bash
composer require nwidart/laravel-modules
```

now on your `composer.json` add to `psr-4` autoload

```json
{
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Modules\\": "Modules/"
        }
    }
}
```

now run this command to autoload themes

```bash
composer dump-autoload
```

and you need another package for caching and return themes as model we use `sushi` package

```bash
composer require calebporzio/sushi
```

now on your config `filament-cms`

```php
<?php

return [
    /*
     * ---------------------------------------------------
     * Allow Features
     * ---------------------------------------------------
     */
    "features" => [
        "theme-manager" => true,
    ],
];
```

now you need to active the settings table

```bash
php artisan vendor:publish --provider="Spatie\LaravelSettings\LaravelSettingsServiceProvider" --tag="migrations"
php artisan migrate
```

now you can use Theme manager to manage multi frontend themes on your app, on your panel provider `/app/Providers/Filament/AdminPanelProvider.php` add this method

```php
->plugin(\TomatoPHP\FilamentCms\FilamentCMSPlugin::make()->useThemeManager())
```

now you can access `/admin/themes` to manage your themes and you can create new theme use this command line

```bash
php artisan filament-cms:theme
```

you will find a new module with custom `module.json` file on your `Modules` directory

## Use Page Builder

the page builder make it very easy to custom your page and generate an autoloaded pages to build your website using `Sections` to start using it you need to add this method on your panel provider `/app/Providers/Filament/AdminPanelProvider.php`

```php
->plugin(\TomatoPHP\FilamentCms\FilamentCMSPlugin::make()->usePageBuilder())
```

first thing you need to create a Section on your AppServiceProvider `boot()` method

```php
use TomatoPHP\FilamentCms\Services\Contracts\Section;
use TomatoPHP\FilamentCms\Facades\FilamentCMS;
use Filament\Forms\Components\TextInput;

FilamentCMS::themes()->register([
    Section::make('hero')
        ->label('Hero Section')
        ->view('sections.pages.hero')
        ->form([
            TextInput::make('title')
                ->label('title'),
            TextInput::make('description')
                ->label('description'),
            TextInput::make('url')
                ->url()
                ->label('url'),
            TextInput::make('button')
                ->label('button'),
        ])
]);

```

**NOTE:** the section key must be unique 

after register your section you can start using page builder, you need to create a new route for your page like this

```php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $page = load_page('/');
    return view('welcome', compact('page'));
});

```

as you see you need to use `load_page` helper to load your page and pass it to your view, this method check if the page exists by `slug` and return the page data if page don't exists or deleted it will restore it or create it for you 

on your `welcome.blade.php` file you need to use this blade component 

```html
<x-tomato-builder-toolbar :page="$page" allow-layout/>
```

if you need to use Filament Layout to make it easy to active Livewire / Tailwind Style use `allow-layout` attribute if you need to use it without any style you can use it without this attribute

now if you open your page you will find the builder view like this

![Page Builder](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/page-builder.png)
![Page Builder Prview](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/page-builder-preview.png)

## Add Form Field Type

you can add more fields to the form builder by use this method on your provider.

```php
use TomatoPHP\FilamentCms\Services\FilamentCMSFormFields;
use TomatoPHP\FilamentCms\Services\Contracts\CmsFormFieldType;

FilamentCMSFormFields::register([
    CmsFormFieldType::make('code')
        ->className(CodeEditor::class)
        ->color('warning')
        ->icon('heroicon-s-code-bracket-square')
        ->label('Code Editor'),
]);
```

## Use Your Form Builder

after create your form you can use it by `key` like this

```php
use TomatoPHP\FilamentCms\Services\FilamentCMSFormBuilder;

FilamentCMSFormBuilder::make('xvssd')->build()
```

## Use Form Requests to Submit your form data

you can use form requests to submit your form data by use this method on your provider.

```php
use TomatoPHP\FilamentCms\Services\FilamentCMSFormBuilder;

FilamentCMSFormBuilder::make('xvssd')->send($data)
```

## Use Filament Shield

you can use the shield to protect your resource and allow user roles by install it first

```bash
composer require bezhansalleh/filament-shield
```

Add the Spatie\Permission\Traits\HasRoles trait to your User model(s):

```php
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;

    // ...
}
```
Publish the config file then setup your configuration:

```php
->plugin(\BezhanSalleh\FilamentShield\FilamentShieldPlugin::make())
```

Now run the following command to install shield:

```bash
php artisan shield:install
```

Now we can [publish the package assets]([https://github.com/bezhanSalleh/filament-shield](https://github.com/tomatophp/filament-users?tab=readme-ov-file#publish-assets)).

```bash
php artisan vendor:publish --tag="filament-users-config"
```

now you need to allow it on the plugin options

```php
->plugin(\TomatoPHP\FilamentCms\FilamentCMSPlugin::make()->allowShield())
```

for more information check the [Filament Shield](https://github.com/bezhanSalleh/filament-shield)

## Use Post Events

sometimes you need to add some custom logic to your post like send email or notify user you can use the post events to do this, and the supported events is:

```php
\TomatoPHP\FilamentCms\Events\PostCreated::class
\TomatoPHP\FilamentCms\Events\PostUpdated::class
\TomatoPHP\FilamentCms\Events\PostDeleted::class
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

## Other Filament Packages

Checkout our [Awesome TomatoPHP](https://github.com/tomatophp/awesome)
