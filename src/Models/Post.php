<?php

namespace TomatoPHP\FilamentCms\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

/**
 * @property int $id
 * @property int $author_id
 * @property string $author_type
 * @property string $type
 * @property string $title
 * @property string $slug
 * @property string $short_description
 * @property string $keywords
 * @property string $body
 * @property bool $is_published
 * @property bool $is_trend
 * @property string $published_at
 * @property float $likes
 * @property float $views
 * @property string $meta_url
 * @property string $meta_redirect
 * @property array $meta
 * @property string $created_at
 * @property string $updated_at
 * @property Comment[] $comments
 * @property User $user
 * @property Category[] $categories
 */
class Post extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;
    use SoftDeletes;

    protected static function newFactory()
    {
        return \TomatoPHP\FilamentCms\Tests\Database\Factories\PostFactory::new();
    }

    public $translatable = [
        'title',
        'short_description',
        'keywords',
        'body',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_trend' => 'boolean',
        'likes' => 'float',
        'views' => 'float',
        'meta' => 'array',
        'published_at' => 'datetime',
    ];

    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'author_id',
        'author_type',
        'type',
        'title',
        'slug',
        'short_description',
        'keywords',
        'body',
        'is_published',
        'is_trend',
        'published_at',
        'likes',
        'views',
        'meta_redirect',
        'meta',
        'meta_url',
        'created_at',
        'updated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'content');
    }

    public function author()
    {
        return $this->morphTo('author');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'posts_has_category', 'post_id', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Category::class, 'posts_has_tags', 'post_id', 'tag_id');
    }

    public function postMeta()
    {
        return $this->hasMany('TomatoPHP\FilamentCms\Models\PostMeta');
    }

    /**
     * @param  string|null  $value
     * @return Model|string
     */
    public function meta(string $key, mixed $value = null): mixed
    {
        if ($value) {
            return $this->postMeta()->updateOrCreate(['key' => $key], ['value' => $value]);
        } else {
            return $this->postMeta()->where('key', $key)->first()?->value;
        }
    }
}
