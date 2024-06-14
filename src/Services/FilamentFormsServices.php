<?php

namespace TomatoPHP\FilamentCms\Services;

use TomatoPHP\FilamentCms\Services\Contracts\Form;

class FilamentFormsServices
{
    public array $forms = [];

    public function register(Form $form){
        $this->forms[] = $form;
    }

    public function getForms(): array
    {
        return $this->forms;
    }

    public function build(): void
    {
        foreach ($this->forms as $form){
            $checkIfFormExists = \TomatoPHP\FilamentCms\Models\Form::where('key', $form->key)->first();
            if(!$checkIfFormExists){
                $newForm = \TomatoPHP\FilamentCms\Models\Form::create($form->toArray());
                $newForm->fields()->createMany($form->inputs);
            }
        }
    }
}
