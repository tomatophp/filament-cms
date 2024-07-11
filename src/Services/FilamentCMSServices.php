<?php

namespace TomatoPHP\FilamentCms\Services;

use TomatoPHP\FilamentCms\Services\Contracts\Page;
use TomatoPHP\FilamentCms\Services\Contracts\Section;
use TomatoPHP\FilamentCms\Models\Form;

class FilamentCMSServices
{
    public function types(): FilamentCmsTypes
    {
        return new FilamentCmsTypes();
    }

    public function authors(): FilamentCMSAuthors
    {
        return new FilamentCMSAuthors();
    }

    public function themes(): FilamentCMSThemes
    {
        return new FilamentCMSThemes();
    }

    public function formFields(): FilamentCMSFormFields
    {
        return new FilamentCMSFormFields();
    }
}
