<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SimulationSession extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'ai_recommendations',
        'user_answers',
        'simulation_questions',
        'user_responses',
        'selected_major',
        'analysis_result',
        'phase',
        'current_question'
    ];

    protected $casts = [
        'ai_recommendations' => 'array',
        'user_answers' => 'array',
        'simulation_questions' => 'array',
        'user_responses' => 'array',
        'analysis_result' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate unique session ID
     */
    public static function generateSessionId(): string
    {
        return 'sim_' . uniqid() . '_' . time();
    }

    /**
     * Check if simulation is completed
     */
    public function isCompleted(): bool
    {
        return $this->phase === 'completed';
    }

    /**
     * Get progress percentage
     */
    public function getProgressPercentage(): int
    {
        $phases = ['prompt', 'initial', 'confirmation', 'deep', 'analysis', 'completed'];
        $currentIndex = array_search($this->phase, $phases);
        return $currentIndex !== false ? (int)(($currentIndex / (count($phases) - 1)) * 100) : 0;
    }
}
