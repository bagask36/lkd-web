<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('laporan_kalibrasis', function (Blueprint $table) {
        $table->double('rata_rata')->nullable()->after('u_a_value');
        $table->double('standar_deviasi')->nullable()->after('rata_rata');
        $table->double('nilai_koreksi')->nullable()->after('standar_deviasi');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_kalibrasis', function (Blueprint $table) {
            //
        });
    }
};
