<?php

// Buat migrasi baru: php artisan make:migration create_simulation_responses_table
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('simulation_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('simulation_session_id')->constrained('simulation_sessions')->onDelete('cascade');
            $table->unsignedInteger('step_number');
            $table->text('scenario_text'); // Skenario yang diberikan ke pengguna
            $table->text('user_choice_text'); // Teks dari pilihan yang diambil pengguna
            $table->string('user_choice_value'); // Value dari pilihan (e.g., 'explore_campus')
            $table->text('ai_feedback')->nullable(); // Feedback singkat dari AI untuk pilihan tersebut
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('simulation_responses');
    }
};