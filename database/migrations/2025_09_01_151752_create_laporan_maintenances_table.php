<?php

// database/migrations/xxxx_xx_xx_create_laporan_maintenance_table.php

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
        Schema::create('laporan_maintenance', function (Blueprint $table) {
            $table->id();
            $table->string('nama_alat');
            $table->string('merk');
            $table->string('no_seri');
            $table->string('tgl_maintenance');
            $table->string('tindakan');
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
        Schema::dropIfExists('laporan_maintenance');
    }
};