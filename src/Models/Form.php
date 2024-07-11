<?php

namespace TomatoPHP\FilamentCms\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property string $key
 * @property string $endpoint
 * @property string $method
 * @property string $description
 * @property boolean $is_active
 * @property string $created_at
 * @property string $updated_at
 */
class Form extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'description'];

    /**
     * @var array
     */
    protected $fillable = [
        'type',
        'name',
        'key',
        'endpoint',
        'method',
        'description',
        'is_active',
        'created_at',
        'updated_at'
    ];


    protected $casts = [
        'is_active' => 'boolean',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fields()
    {
        return $this->hasMany(FormOption::class, 'form_id', 'id')->orderBy('order', 'asc');
    }

    public function requests()
    {
        return $this->hasMany(FormRequest::class, 'form_id', 'id');
    }
}
