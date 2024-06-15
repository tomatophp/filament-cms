<?php

namespace TomatoPHP\FilamentCms\Models;


use TomatoPHP\TomatoCrm\Models\Account;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $user_type
 * @property integer $content_id
 * @property string $content_type
 * @property string $comment
 * @property float $rate
 * @property boolean $is_active
 * @property string $created_at
 * @property string $updated_at
 */
class Comment extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'user_type',
        'content_id',
        'content_type',
        'comment',
        'rate',
        'is_active',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->morphTo('user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content()
    {
        return $this->morphTo('content');
    }
}
