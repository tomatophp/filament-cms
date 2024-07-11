<?php

namespace TomatoPHP\FilamentCms\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property integer $id
 * @property integer $form_id
 * @property string $model_type
 * @property integer $model_id
 * @property string $service_type
 * @property integer $service_id
 * @property string $description
 * @property string $date
 * @property string $time
 * @property string $status
 * @property mixed $payload
 * @property string $created_at
 * @property string $updated_at
 * @property Form $form
 */
class FormRequest extends Model implements HasMedia
{
    use InteractsWithMedia;

    /**
     * @var array
     */
    protected $fillable = [
        'form_id',
        'model_type',
        'model_id',
        'service_type',
        'service_id',
        'description',
        'date',
        'time',
        'status',
        'payload',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        "payload" => "array"
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function form()
    {
        return $this->belongsTo('TomatoPHP\FilamentCms\Models\Form');
    }

    public function formRequestsMetas(){
        return $this->hasMany(FormRequestMeta::class, 'form_request_id');
    }

    public function meta(string $key, string|null $value=null): Model|string|null
    {
        if($value){
            return $this->formRequestsMetas()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
        else {
            return $this->formRequestsMetas()->where('key', $key)->first()?->value;
        }
    }

    public function modelable()
    {
        return $this->morphTo();
    }

    public function serviceable()
    {
        return $this->morphTo();
    }
}
