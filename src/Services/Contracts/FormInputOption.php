<?php

namespace TomatoPHP\FilamentCms\Services\Contracts;

use Illuminate\Support\Facades\Cookie;

class FormInputOption
{
    public ?string $value = null;
    public ?string $label_ar = null;
    public ?string $label_en = null;

    public function __construct()
    {
        // decrypt
        try {
            $decryptedString = \Crypt::decrypt(Cookie::get('lang'), false);
            $lang = json_decode(explode('|', $decryptedString)[1]);
            app()->setLocale($lang->id ?? config('app.locale'));
        }catch (\Exception $exception) {}
    }

    public function toArray():array
    {
        return [
            'value' => $this->value,
            'label_ar' => $this->label_ar,
            'label_en' => $this->label_en,
        ];
    }


    /**
     * @return static
     */
    public static function make(): static
    {
        return (new static);
    }

    public function value(string $value): static
    {
        $this->value = $value;
        return $this;
    }

    public function label_ar(string $label_ar): static
    {
        $this->label_ar = $label_ar;
        return $this;
    }

    public function label_en(string $label_en): static
    {
        $this->label_en = $label_en;
        return $this;
    }
}
