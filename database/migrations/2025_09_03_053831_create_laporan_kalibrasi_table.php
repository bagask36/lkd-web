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
        Schema::create('laporan_kalibrasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_alat');
            $table->string('merk');
            $table->string('no_seri');
            $table->date('tgl_kalibrasi');
            $table->date('tgl_next_kalibrasi');
            $table->text('hasil');
            $table->string('teknisi');
            $table->string('file_path')->nullable(); // Kolom untuk menyimpan path file
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_kalibrasi');
    }
};