<?php
// app/Models/Discussion.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discussion extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'category',
        'author_name',
        'likes_count',
        'comments_count'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Cek apakah given author_name sudah me-like discussion ini.
     */
    public function isLikedBy(string $authorName): bool
    {
        return $this->likes()
                    ->where('author_name', $authorName)
                    ->exists();
    }
}
