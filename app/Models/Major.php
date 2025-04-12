<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Major extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'short_desc',
        'full_desc',
        'img',
        'video_url'
    ];

}
