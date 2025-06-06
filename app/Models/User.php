<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens; // Jika menggunakan Sanctum

class User extends Authenticatable
{
    use HasFactory, Notifiable; // Sesuaikan Trait

    protected $fillable = [
        'name',
        'email',
        'password',
        'coins', // Tambahkan 'coins' jika ingin bisa di-mass assign
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'coins' => 'integer', // Cast ke integer
    ];

    public function categoryAssessments()
    {
        return $this->hasMany(UserCategoryAssessment::class);
    }

    public function overallSummaries()
    {
        return $this->hasMany(UserOverallSummary::class);
    }

    public function simulationSessions()
    {
        return $this->hasMany(SimulationSession::class);
    }
}