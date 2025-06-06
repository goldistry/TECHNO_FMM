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
        Schema::table('simulation_responses', function (Blueprint $table) {
            // Ubah kolom agar bisa menerima nilai NULL
            $table->text('user_choice_text')->nullable()->change();
            $table->string('user_choice_value')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('simulation_responses', function (Blueprint $table) {
            // Kembalikan seperti semula jika di-rollback
            $table->text('user_choice_text')->nullable(false)->change();
            $table->string('user_choice_value')->nullable(false)->change();
        });
    }
};