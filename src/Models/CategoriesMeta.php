<?php

namespace TomatoPHP\FilamentCms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $category_id
 * @property int $model_id
 * @property string $model_type
 * @property string $key
 * @property mixed $value
 * @property string $created_at
 * @property string $updated_at
 * @property Category $category
 */
class CategoriesMeta extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['category_id', 'model_id', 'model_type', 'key', 'value', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('TomatoPHP\FilamentCms\Models\Category');
    }
}
