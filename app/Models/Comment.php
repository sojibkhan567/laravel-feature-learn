<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    protected $guarded = [];

    /**
     * Get the post that owns the Comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    // get all comment replies
    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

    // get reply user info
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
