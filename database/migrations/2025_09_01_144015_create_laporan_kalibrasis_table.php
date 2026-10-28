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
    Schema::create('laporan_kalibrasis', function (Blueprint $table) {
        $table->id();
        $table->string('nama_alat');
        $table->string('merk');
        $table->string('no_seri');
        $table->date('tgl_kalibrasi');
        $table->date('tgl_next_kalibrasi');
        $table->string('hasil');
        $table->string('teknisi');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_kalibrasis');
    }
};
