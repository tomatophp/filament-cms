<?php

namespace TomatoPHP\FilamentCms\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use TomatoPHP\FilamentEcommerce\Models\Product;

/**
 * @property integer $id
 * @property integer $parent_id
 * @property string $for
 * @property string $type
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $icon
 * @property string $color
 * @property boolean $is_active
 * @property boolean $show_in_menu
 * @property string $created_at
 * @property string $updated_at
 * @property Categorable[] $categorables
 * @property Category $category
 * @property CategoriesMeta[] $categoriesMetas
 * @property Content[] $contents
 */
class Category extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasTranslations;
    use SoftDeletes;

    public $translatable = [
        'name',
        'description'
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'type',
        'for',
        'parent_id',
        'name',
        'slug',
        'description',
        'icon',
        'color',
        'is_active',
        'show_in_menu',
        'created_at',
        'updated_at'
    ];


    protected $casts = [
        'is_active' => 'boolean',
        'show_in_menu' => 'boolean',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function children()
    {
        return $this->hasMany('TomatoPHP\FilamentCms\Models\Category', 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('TomatoPHP\FilamentCms\Models\Category', 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoriesMetas()
    {
        return $this->hasMany('TomatoPHP\FilamentCms\Models\CategoriesMeta');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'posts_has_category', 'category_id', 'post_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
