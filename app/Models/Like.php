<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'author_name',
        'likeable_id',
        'likeable_type'
    ];

    public function likeable()
    {
        return $this->morphTo();
    }
}