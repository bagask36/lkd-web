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
        Schema::table('laporan_kalibrasis', function (Blueprint $table) {
            $table->string('file_path')->nullable()->after('teknisi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_kalibrasi', function (Blueprint $table) {
            $table->dropColumn('file_path');
        });
    }
};