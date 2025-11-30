<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_kalibrasi_sets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('laporan_kalibrasi_id');
            $table->double('nilai_setting');
            $table->longText('nilai_pengukuran');
            $table->double('rata_rata')->nullable();
            $table->double('standar_deviasi')->nullable();
            $table->double('u_a_value')->nullable();
            $table->double('nilai_koreksi')->nullable();
            $table->timestamps();

            $table->foreign('laporan_kalibrasi_id')
                ->references('id')
                ->on('laporan_kalibrasis')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_kalibrasi_sets');
    }
};

