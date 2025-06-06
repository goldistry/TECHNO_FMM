<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'label',
        'description',
        'icon_identifier',
        'cost_per_question',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('order');
    }

    public function userAssessments()
    {
        return $this->hasMany(UserCategoryAssessment::class);
    }
}