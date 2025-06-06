<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulationResponse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'simulation_session_id',
        'step_number',
        'scenario_text',
        'user_choice_text',
        'user_choice_value',
        'ai_feedback',
    ];

    /**
     * Mendapatkan sesi simulasi yang memiliki respons ini.
     */
    public function session()
    {
        return $this->belongsTo(SimulationSession::class, 'simulation_session_id');
    }
}