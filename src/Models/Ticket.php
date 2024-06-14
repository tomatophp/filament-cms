<?php

namespace TomatoPHP\FilamentCms\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $type_id
 * @property string $accountable_type
 * @property integer $accountable_id
 * @property string $name
 * @property string $phone
 * @property string $subject
 * @property string $code
 * @property string $message
 * @property string $last_update
 * @property boolean $is_closed
 * @property string $created_at
 * @property string $updated_at
 * @property TicketComment[] $ticketComments
 * @property Type $type
 */
class Ticket extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['type_id', 'accountable_type', 'accountable_id', 'name', 'phone', 'subject', 'code', 'message', 'last_update', 'is_closed', 'created_at', 'updated_at'];

    protected $casts = [
        'is_closed' => 'boolean'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticketComments()
    {
        return $this->hasMany('TomatoPHP\FilamentCms\Models\TicketComment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo('TomatoPHP\FilamentCms\Models\Type');
    }

    public function accountable(){
        return $this->morphTo();
    }
}
