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
        Schema::create('majors', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('short_desc');
            $table->text('full_desc');
            $table->text('img');
            $table->string('video_url')->nullable();
            $table->string('category')->nullable(); 
            $table->json('required_skills')->nullable();
            $table->json('career_prospects')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('majors');
    }
};
