![Screenshot](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/fadymondy-tomato-cms.jpg)

# Filament CMS Builder

[![Latest Stable Version](https://poser.pugx.org/tomatophp/filament-cms/version.svg)](https://packagist.org/packages/tomatophp/filament-cms)
[![License](https://poser.pugx.org/tomatophp/filament-cms/license.svg)](https://packagist.org/packages/tomatophp/filament-cms)
[![Downloads](https://poser.pugx.org/tomatophp/filament-cms/d/total.svg)](https://packagist.org/packages/tomatophp/filament-cms)
[![Dependabot Updates](https://github.com/tomatophp/filament-cms/actions/workflows/dependabot/dependabot-updates/badge.svg)](https://github.com/tomatophp/filament-cms/actions/workflows/dependabot/dependabot-updates)
[![PHP Code Styling](https://github.com/tomatophp/filament-cms/actions/workflows/fix-php-code-styling.yml/badge.svg)](https://github.com/tomatophp/filament-cms/actions/workflows/fix-php-code-styling.yml)
[![Tests](https://github.com/tomatophp/filament-cms/actions/workflows/tests.yml/badge.svg?branch=master)](https://github.com/tomatophp/filament-cms/actions/workflows/tests.yml)

Full CMS System with support of importing integrations and multi meta functions

## Requirements

| Package version | Filament | Laravel     | PHP  |
|-----------------|----------|-------------|------|
| 5.x             | 5.x      | 12.x, 13.x  | 8.2+ |
| 4.x             | 4.x      | 11.x, 12.x  | 8.2+ |

## Installation

> [!CAUTION]
> Don't update to v4.0 or later if you are using v1.0 or less because you will lose some features but you can update and use this features from integrated packages.

> [!NOTE]
> The package creates `categories`, `posts` and related tables. If your app already has a `categories` table or a Filament resource on `/admin/categories`, rename yours before installing.


```bash
composer require tomatophp/filament-cms
```

after installing your package, please run this command

```bash
php artisan filament-cms:install
```

finally register the plugins on `/app/Providers/Filament/AdminPanelProvider.php`. The post resource is translatable, so it needs the `lara-zeus/spatie-translatable` plugin next to it.

```php
->plugin(
    \LaraZeus\SpatieTranslatable\SpatieTranslatablePlugin::make()
        ->defaultLocales(['en', 'ar'])
)
->plugin(
    \TomatoPHP\FilamentCms\FilamentCMSPlugin::make()
        ->useCategory()
        ->usePost()
        ->allowExport()
        ->allowImport()
)
```

## Screenshots

![Posts List](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/posts-list.png)
![Posts List Dark](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/posts-list-dark.png)
![Posts Create](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/create-post.png)
![Posts Create Dark](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/create-post-dark.png)
![Posts View](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/view-post.png)
![Posts View Dark](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/view-post-dark.png)
![Category List](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/category-list.png)
![Category List Dark](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/category-list-dark.png)
![Category Create](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/create-category.png)
![Category Create Dark](https://raw.githubusercontent.com/tomatophp/filament-cms/master/arts/create-category-dark.png)

## Features

- [x] Content Manager
- [x] Content Comments & Ratings
- [x] Multi Imports Integrations
- [x] Content Import & Export

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

## Add More Author Types

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

## Use Post-Events

sometimes you need to add some custom logic to your post like send email or notify user you can use the post events to do this, and the supported events is:

```php
\TomatoPHP\FilamentCms\Events\PostCreated::class
\TomatoPHP\FilamentCms\Events\PostUpdated::class
\TomatoPHP\FilamentCms\Events\PostDeleted::class
```

## Extend Post Resource

The Post resource is built with a modular architecture that allows you to easily extend and customize forms, tables, and infolists by registering custom components.

### Register Custom Form Components

Add custom form fields to the Post resource form in your `AppServiceProvider` `boot()` method:

```php
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\PostForm;
use Filament\Forms\Components\TextInput;

public function boot()
{
    PostForm::register([
        TextInput::make('custom_field')
            ->label('Custom Field')
            ->required(),
    ]);
}
```

### Register Custom Table Columns

Add custom columns to the Post resource table:

```php
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\PostTable;
use Filament\Tables\Columns\TextColumn;

public function boot()
{
    PostTable::register([
        TextColumn::make('custom_field')
            ->label('Custom Field')
            ->sortable()
            ->searchable(),
    ]);
}
```

### Register Custom Table Actions

Add custom row actions to the Post resource table:

```php
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\PostActions;
use Filament\Tables\Actions\Action;

public function boot()
{
    PostActions::register([
        Action::make('custom_action')
            ->label('Custom Action')
            ->icon('heroicon-o-bolt')
            ->action(function ($record) {
                // Your custom action logic
            }),
    ]);
}
```

### Register Custom Bulk Actions

Add custom bulk actions to the Post resource table:

```php
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\PostBulkActions;
use Filament\Tables\Actions\BulkAction;

public function boot()
{
    PostBulkActions::register([
        BulkAction::make('custom_bulk_action')
            ->label('Custom Bulk Action')
            ->icon('heroicon-o-bolt')
            ->action(function ($records) {
                // Your custom bulk action logic
            }),
    ]);
}
```

### Register Custom Table Filters

Add custom filters to the Post resource table:

```php
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\PostFilters;
use Filament\Tables\Filters\Filter;

public function boot()
{
    PostFilters::register([
        Filter::make('custom_filter')
            ->form([
                // Your filter form fields
            ])
            ->query(function ($query, array $data) {
                // Your filter query logic
            }),
    ]);
}
```

### Register Custom InfoList Entries

Add custom entries to the Post resource infolist (view page):

```php
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\PostInfoList;
use Filament\Infolists\Components\TextEntry;

public function boot()
{
    PostInfoList::register([
        TextEntry::make('custom_field')
            ->label('Custom Field'),
    ]);
}
```

## Extend Category Resource

The Category resource follows the same modular architecture pattern as the Post resource.

### Register Custom Form Components

Add custom form fields to the Category resource form:

```php
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Form\CategoryForm;
use Filament\Forms\Components\TextInput;

public function boot()
{
    CategoryForm::register([
        TextInput::make('custom_field')
            ->label('Custom Field')
            ->required(),
    ]);
}
```

### Register Custom Table Columns

Add custom columns to the Category resource table:

```php
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\CategoryTable;
use Filament\Tables\Columns\TextColumn;

public function boot()
{
    CategoryTable::register([
        TextColumn::make('custom_field')
            ->label('Custom Field')
            ->sortable(),
    ]);
}
```

### Register Custom Table Actions

Add custom row actions to the Category resource table:

```php
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\CategoryActions;
use Filament\Tables\Actions\Action;

public function boot()
{
    CategoryActions::register([
        Action::make('custom_action')
            ->label('Custom Action')
            ->icon('heroicon-o-bolt')
            ->action(function ($record) {
                // Your custom action logic
            }),
    ]);
}
```

### Register Custom Bulk Actions

Add custom bulk actions to the Category resource table:

```php
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\CategoryBulkActions;
use Filament\Tables\Actions\BulkAction;

public function boot()
{
    CategoryBulkActions::register([
        BulkAction::make('custom_bulk_action')
            ->label('Custom Bulk Action')
            ->icon('heroicon-o-bolt')
            ->action(function ($records) {
                // Your custom bulk action logic
            }),
    ]);
}
```

### Register Custom Table Filters

Add custom filters to the Category resource table:

```php
use TomatoPHP\FilamentCms\Filament\Resources\CategoryResource\Table\CategoryFilters;
use Filament\Tables\Filters\Filter;

public function boot()
{
    CategoryFilters::register([
        Filter::make('custom_filter')
            ->form([
                // Your filter form fields
            ])
            ->query(function ($query, array $data) {
                // Your filter query logic
            }),
    ]);
}
```

### Create Custom Modular Components

You can also create your own modular components by extending the base classes:

#### Custom Form Component

```php
namespace App\Filament\Components\Post;

use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\Component;
use Filament\Forms\Components\TextInput;

class CustomFieldComponent extends Component
{
    public static function make(): \Filament\Forms\Components\Field | \Filament\Schemas\Components\Component
    {
        return TextInput::make('custom_field')
            ->label('Custom Field')
            ->required();
    }
}
```

Then register it:

```php
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Form\PostForm;
use App\Filament\Components\Post\CustomFieldComponent;

public function boot()
{
    PostForm::register([
        CustomFieldComponent::make(),
    ]);
}
```

#### Custom Table Column

```php
namespace App\Filament\Columns\Post;

use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\Column;
use Filament\Tables\Columns\TextColumn;

class CustomColumn extends Column
{
    public static function make(): \Filament\Tables\Columns\Column
    {
        return TextColumn::make('custom_field')
            ->label('Custom Field')
            ->sortable()
            ->searchable();
    }
}
```

Then register it:

```php
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\Table\PostTable;
use App\Filament\Columns\Post\CustomColumn;

public function boot()
{
    PostTable::register([
        CustomColumn::make(),
    ]);
}
```

#### Custom InfoList Entry

```php
namespace App\Filament\Entries\Post;

use TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\Entry;
use Filament\Infolists\Components\TextEntry;

class CustomEntry extends Entry
{
    public static function make(): \Filament\Infolists\Components\Entry
    {
        return TextEntry::make('custom_field')
            ->label('Custom Field');
    }
}
```

Then register it:

```php
use TomatoPHP\FilamentCms\Filament\Resources\PostResource\InfoList\PostInfoList;
use App\Filament\Entries\Post\CustomEntry;

public function boot()
{
    PostInfoList::register([
        CustomEntry::make(),
    ]);
}
```

## Integrate more Import Actions

you can integrate more import actions by using the `FilamentCMS::registerImportAction()` method on your AppServiceProvider `boot()` method like this

```php

use TomatoPHP\FilamentCms\Facade\FilamentCMS;
use Filament\Actions\Action;

public function boot()
{
      FilamentCMS::registerImportAction(Action::make('import'));
}
```

## Publish Assets

you can publish a config file by use this command

```bash
php artisan vendor:publish --tag="filament-cms-config"
```

you can publish a view file by using this command

```bash
php artisan vendor:publish --tag="filament-cms-views"
```

you can publish a language file by using this command

```bash
php artisan vendor:publish --tag="filament-cms-lang"
```

you can publish the migration file by using this command

```bash
php artisan vendor:publish --tag="filament-cms-migrations"
```

## Testing

if you like to run `PEST` testing just use this command

```bash
composer test
```

## Code Style

if you like to fix the code style just use this command

```bash
composer format
```

## PHPStan

if you like to check the code by `PHPStan` just use this command

```bash
composer analyse
```

## Other Filament Packages

Check out our [Awesome TomatoPHP](https://github.com/tomatophp/awesome)
