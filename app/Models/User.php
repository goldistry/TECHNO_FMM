<?php

namespace App\Models;

<<<<<<< HEAD
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens; // Jika menggunakan Sanctum

class User extends Authenticatable
{
    use HasFactory, Notifiable; // Sesuaikan Trait

>>>>>>> 0a7de8735cd3d3a6bef56ec649323bcd3b01ae43
    protected $fillable = [
        'name',
        'email',
        'password',
<<<<<<< HEAD
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
=======
        'coins', // Tambahkan 'coins' jika ingin bisa di-mass assign
    ];

>>>>>>> 0a7de8735cd3d3a6bef56ec649323bcd3b01ae43
    protected $hidden = [
        'password',
        'remember_token',
    ];

<<<<<<< HEAD
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
=======
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
>>>>>>> 0a7de8735cd3d3a6bef56ec649323bcd3b01ae43
