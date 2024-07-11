<?php

namespace TomatoPHP\FilamentCms\Services;

use Carbon\Carbon;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;
use TomatoPHP\FilamentCms\Models\Form;
use TomatoPHP\FilamentCms\Models\FormRequest;

class FilamentCMSFormBuilder
{
    public string $key;
    public Form $form;

    public static function make(string $key): static
    {
        return (new static)->key($key);
    }

    public function key(string $key): static
    {
        $this->key = $key;
        $this->form = Form::query()->where('key', $this->key)->orWhere('id', (int)$this->key)->first();
        return $this;
    }

    public function build(): array
    {
        $schema = [];
        $form = $this->form;
        if($form){
            $fields = $form->fields()->orderBy('order')->get();

            foreach ($fields as $key=>$field){
                $getFiledBuilder = FilamentCMSFormFields::getOptions()->where('name', $field->type)->first();
                if($getFiledBuilder){
                    $messages = [];
                    $title = Str::of($field->name)->title()->toString();
                    $fieldBuild = $getFiledBuilder->className::make($field->name);
                    if($field->label){
                        $fieldBuild->label($field->label);
                    }
                    if($field->hint){
                        $fieldBuild->hint($field->hint);
                    }
                    if($field->placeholder){
                        $fieldBuild->placeholder($field->placeholder);
                    }
                    if($field->is_required){
                        $fieldBuild->required();
                        $messages['required'] = $field->required_message[app()->getLocale()]??null;
                    }
                    if($field->default){
                        $fieldBuild->default($field->default);
                    }
                    if($field->is_multi){
                        $fieldBuild->multiple();
                    }
                    if($field->type === 'number'){
                        $fieldBuild->numeric();
                    }
                    if($field->type === 'email'){
                        $fieldBuild->email();
                    }
                    if($field->type === 'tel'){
                        $fieldBuild->tel();
                    }
                    if($field->type === 'url'){
                        $fieldBuild->url();
                    }
                    if($field->type === 'password'){
                        $fieldBuild->password();
                    }
//                    if($field->is_reactive){
//                        $fieldBuild->live();
//                    }
                    if($field->has_options){
                        $fieldBuild->options(collect($field->options)->map(function ($item){
                            $item['label'] = $item['label'][app()->getLocale()]??null;
                            return $item;
                        })->pluck('label', 'value')->toArray());
                    }
                    if($field->has_validation){
                        $rules = [];
                        foreach ($field->validation as $rule){
                            $messages[$rule['rule']] = $rule['message'][app()->getLocale()]??null;
                            $rules[] = $rule['rule'];
                        }
                        $fieldBuild->rules($rules);
                    }
                    if(count($messages)){
                        $fieldBuild->validationMessages($messages);
                    }
                    if($field->sub_form){
                        $fieldBuild->schema(static::make($field->sub_form)->build());
                    }
                    if($field->is_relation){
                        $fieldBuild->searchable();
                        if(str($field->relation_name)->contains('\\')){
                            $fieldBuild->options($field->relation_name::all()->pluck($field->relation_column, 'id')->toArray());
                        }
                        else {
                            $fieldBuild->relationship($field->relation_name, $field->relation_column);
                        }
                    }
                    $schema[] = $fieldBuild;
                }

            }
        }

        return $schema;
    }

    public function send(array $data): void
    {
        if(count($data)){
            $formRequest = new FormRequest();
            $formRequest->form_id = $this->form->id;
            $formRequest->status = 'pending';
            $formRequest->payload = $data;
            $formRequest->description = "Created From Form Preview";
            $formRequest->date = Carbon::now()->toDateString();
            $formRequest->time = Carbon::now()->toTimeString();
            $formRequest->save();

            Notification::make()
                ->title('Form Preview')
                ->body('Form Preview has been created successfully')
                ->success()
                ->send();
        }
        else {
            Notification::make()
                ->title('Form Preview')
                ->body('Form Empty!')
                ->danger()
                ->send();
        }
    }
}
