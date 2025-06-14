<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Discussion extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'category',
    ];

    /**
     * Siapa yang membuat diskusi ini.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Komentar level atas (parent_id = null).
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)
                    ->whereNull('parent_id');
    }

    /**
     * Semua like yang tertaut ke discussion ini.
     */
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Cek apakah user tertentu sudah like diskusi ini.
     */
    public function isLikedBy(User $user): bool
    {
        return $this->likes()
                    ->where('user_id', $user->id)
                    ->exists();
    }
}
