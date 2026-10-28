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
            $table->unsignedBigInteger('kalibrasi_id')->nullable()->after('id');
            $table->foreign('kalibrasi_id')->references('id')->on('kalibrasi')->onDelete('set null');
            $table->unique('kalibrasi_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_kalibrasis', function (Blueprint $table) {
            $table->dropUnique(['kalibrasi_id']);
            $table->dropForeign(['kalibrasi_id']);
            $table->dropColumn('kalibrasi_id');
        });
    }
};

