<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('simulation_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('selected_major');
            $table->text('ai_summary_context')->nullable();
            $table->json('user_answers_context')->nullable();
            $table->string('status')->default('started'); // e.g., started, completed, abandoned
            $table->text('final_outcome')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('simulation_sessions');
    }
};