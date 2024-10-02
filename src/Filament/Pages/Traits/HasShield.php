<?php

namespace TomatoPHP\FilamentCms\Filament\Pages\Traits;

use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Facades\Filament;
use Illuminate\Support\Str;

trait HasShield
{
    public function booted(): void
    {
        if(filament('filament-cms')->isShieldAllowed()){
            $this->beforeBooted();

            if (! static::canAccess()) {

                Notification::make()
                    ->title(__('filament-shield::filament-shield.forbidden'))
                    ->warning()
                    ->send();

                $this->beforeShieldRedirects();

                redirect($this->getShieldRedirectPath());

                return;
            }

            if (method_exists(parent::class, 'booted')) {
                parent::booted();
            }

            $this->afterBooted();
        }
    }

    protected function beforeBooted(): void
    {
    }

    protected function afterBooted(): void
    {
    }

    protected function beforeShieldRedirects(): void
    {
    }

    protected function getShieldRedirectPath(): string
    {
        return Filament::getUrl();
    }

    protected static function getPermissionName(): string
    {
        return Str::of(class_basename(static::class))
            ->prepend(
                Str::of(Utils::getPagePermissionPrefix())
                    ->append('_')
                    ->toString()
            )
            ->toString();
    }

    public static function canAccess(): bool
    {
        if(filament('filament-cms')->isShieldAllowed()){
            return Filament::auth()->user()->can(static::getPermissionName());
        }
        else {
            return true;
        }
    }
}
