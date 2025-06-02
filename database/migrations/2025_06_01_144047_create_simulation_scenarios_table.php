<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Table untuk menyimpan sesi simulasi dinamis berdasarkan AI output
        Schema::create('simulation_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('session_id')->unique();
            $table->json('ai_recommendations'); // Rekomendasi dari AI (dinamis)
            $table->json('user_answers'); // Jawaban user dari kategori sebelumnya
            $table->json('simulation_questions')->nullable(); // Pertanyaan yang di-generate dinamis
            $table->json('user_responses')->nullable(); // Jawaban simulasi user
            $table->string('selected_major')->nullable(); // Jurusan yang dipilih
            $table->json('analysis_result')->nullable(); // Hasil analisis reflektif
            $table->enum('phase', ['prompt', 'initial', 'confirmation', 'deep', 'analysis', 'completed'])->default('prompt');
            $table->integer('current_question')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['session_id', 'phase']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulation_sessions');
    }
};
