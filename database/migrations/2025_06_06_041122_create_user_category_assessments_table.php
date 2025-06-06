<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_category_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->json('questions_data'); // Stores questions and answers
            $table->text('summary_text')->nullable();
            $table->integer('cost_incurred')->unsigned();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            // Optional: if a user can attempt a category multiple times, remove unique or add attempt_number
            // $table->unique(['user_id', 'category_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_category_assessments');
    }
};