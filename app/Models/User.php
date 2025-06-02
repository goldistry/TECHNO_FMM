<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Authenticatable meng-extend Model
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable // Pastikan ini benar
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string> // Tipe array yang lebih umum
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'coins', // Tambahkan ini
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
            'coins' => 'integer', // Opsional: Casting tipe data 'coins' ke integer
        ];
    }

    /**
     * Get the coins attribute, return default value if column doesn't exist
     */
    public function getCoinsAttribute($value)
    {
        // Jika kolom coins belum ada di database, return default value
        return $value ?? 100;
    }

    /**
     * Set the coins attribute
     */
    public function setCoinsAttribute($value)
    {
        // Hanya set jika kolom ada di database
        if (Schema::hasColumn('users', 'coins')) {
            $this->attributes['coins'] = $value;
        }
    }
}
