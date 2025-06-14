<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type',
    ];

    /**
     * Polymorphic relation ke Discussion atau Comment.
     */
    public function likeable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * User yang melakukan like.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
