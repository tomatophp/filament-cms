<?php

namespace TomatoPHP\FilamentCms\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FormOption extends Model
{
    use HasTranslations;

    public $translatable = [
        'label',
        'hint',
        'placeholder',
        'required_message'
    ];

    protected $fillable = [
        'form_id',
        'type',
        'label',
        'name',
        'placeholder',
        'required_message',
        'hint',
        'default',
        'has_options',
        'has_validation',
        'is_required',
        'is_multi',
        'created_at',
        'updated_at',
        'is_reactive',
        'reactive_field',
        'reactive_where',
        'is_from_table',
        'table_name',
        'options',
        'validation',
        'meta',
        'order',
    ];

    protected $casts = [
        'options' => "array",
        'validation' => "array",
        'lable' => "array",
        'hint'=> "array",
        'placeholder'=> "array",
        'required_message'=> "array",
        'has_options' => "boolean",
        'has_validation' => "boolean",
        'is_required'=> "boolean",
        'is_multi'=> "boolean",
        'is_reactive'=> "boolean",
        'is_from_table'=> "boolean"
    ];

}
