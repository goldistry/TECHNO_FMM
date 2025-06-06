<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // dalam file xxxx_xx_xx_xxxxxx_add_simulation_data_to_simulation_sessions_table.php

public function up()
{
    Schema::table('simulation_sessions', function (Blueprint $table) {
        // Tambahkan kolom JSON untuk menyimpan seluruh skenario dan pilihan
        // $table->json('simulation_data')->nullable()->after('status');
        // Ubah kolom final_outcome menjadi TEXT untuk menampung HTML yang lebih panjang
        $table->text('final_outcome')->nullable()->change();
    });
}

public function down()
{
    Schema::table('simulation_sessions', function (Blueprint $table) {
        // $table->dropColumn('simulation_data');
        $table->string('final_outcome')->nullable()->change();
    });
}
};
