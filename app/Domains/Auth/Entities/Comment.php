<?php

namespace App\Domains\Auth\Entities;

use App\Core\Abstracts\Entity;
use App\Domains\Auth\Entities\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Entity
{
    /*
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable  = [
        'user_id',
        'commentable_type',
        'commentable_id',
        'message',
    ];

    /**
     * Get the owning commentable model.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * user Relationship.
     *
     * @return belongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
