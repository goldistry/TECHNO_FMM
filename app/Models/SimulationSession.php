<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulationSession extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'overall_summary_id', // Pastikan ini ada di $fillable
        'selected_major',
        'simulation_data', // Pastikan ini ada di $fillable
        'status',
        'final_outcome',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'simulation_data' => 'array', // Casting kolom JSON ke array
        'user_answers_context' => 'array',
    ];

    /**
     * Mendapatkan semua respons untuk sesi simulasi ini.
     */
    public function responses()
    {
        return $this->hasMany(SimulationResponse::class);
    }
    
    /**
     * Mendapatkan user yang memiliki sesi ini.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}