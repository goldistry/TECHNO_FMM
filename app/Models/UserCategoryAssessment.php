<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCategoryAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'questions_data',
        'summary_text',
        'cost_incurred',
        'completed_at',
    ];

    protected $casts = [
        'questions_data' => 'array', // Otomatis cast JSON ke array dan sebaliknya
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}