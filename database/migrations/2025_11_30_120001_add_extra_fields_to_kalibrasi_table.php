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
        Schema::table('kalibrasi', function (Blueprint $table) {
            $table->string('merek')->nullable()->after('nama_alat');
            $table->string('model_tipe')->nullable()->after('merek');
            $table->string('no_seri')->nullable()->after('model_tipe');
            $table->string('no_order')->nullable()->after('no_seri');
            $table->string('nama_pemilik')->nullable()->after('no_order');
            $table->text('alamat_pemilik')->nullable()->after('nama_pemilik');
            $table->string('nama_ruang')->nullable()->after('alamat_pemilik');
            $table->string('lokasi_kalibrasi')->nullable()->after('nama_ruang');
            $table->text('hasil')->nullable()->after('lokasi_kalibrasi');
            $table->text('metode_kerja')->nullable()->after('hasil');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kalibrasi', function (Blueprint $table) {
            $table->dropColumn([
                'merek',
                'model_tipe',
                'no_seri',
                'no_order',
                'nama_pemilik',
                'alamat_pemilik',
                'nama_ruang',
                'lokasi_kalibrasi',
                'hasil',
                'metode_kerja',
            ]);
        });
    }
};

