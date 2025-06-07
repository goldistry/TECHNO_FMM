<?php

// app/Models/Comment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'discussion_id',
        'parent_id',
        'author_name',
        'content',
        'likes_count'
    ];

    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Cek apakah given author_name sudah me-like comment ini.
     */
    public function isLikedBy(string $authorName): bool
    {
        return $this->likes()
                    ->where('author_name', $authorName)
                    ->exists();
    }
}
