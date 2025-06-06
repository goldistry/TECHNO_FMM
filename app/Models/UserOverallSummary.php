<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOverallSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'summary_text',
        'context_data',
        'cost_incurred',
    ];

    protected $casts = [
        'context_data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}