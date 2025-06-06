<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('simulation_sessions', function (Blueprint $table) {
            // 1. Hapus kolom lama yang tidak relevan lagi
            $table->dropColumn('ai_summary_context');
            $table->dropColumn('user_answers_context');

            // 2. Tambahkan kolom baru yang dibutuhkan
            // Menautkan ke hasil rekomendasi final
            $table->foreignId('overall_summary_id')->nullable()->after('selected_major')->constrained('user_overall_summaries')->onDelete('set null');
            
            // Menyimpan seluruh pohon cerita JSON dari AI
            $table->json('simulation_data')->nullable()->after('overall_summary_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('simulation_sessions', function (Blueprint $table) {
            // 1. Hapus kolom baru jika migrasi di-rollback
            $table->dropForeign(['overall_summary_id']);
            $table->dropColumn(['overall_summary_id', 'simulation_data']);

            // 2. Kembalikan kolom lama
            $table->text('ai_summary_context')->nullable();
            $table->json('user_answers_context')->nullable();
        });
    }
};